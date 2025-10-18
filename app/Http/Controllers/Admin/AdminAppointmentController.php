<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Cashflow;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminAppointmentController extends Controller
{
    public function index(Request $request)
    {
        $statusOptions = [
            'pendente' => 'Pendente',
            'confirmado' => 'Confirmado',
            'concluido' => 'Concluído',
            'cancelado' => 'Cancelado',
        ];

        $weekInput = $request->input('week');

        try {
            $baseDate = $weekInput ? Carbon::parse($weekInput) : Carbon::today();
        } catch (\Exception $exception) {
            $baseDate = Carbon::today();
        }

        $weekStart = $baseDate->copy()->startOfWeek(Carbon::MONDAY);
        $weekEnd = $weekStart->copy()->addDays(5);

        $appointmentsQuery = Appointment::with('service')
            ->whereBetween('appointment_date', [$weekStart->toDateString(), $weekEnd->toDateString()]);

        $statusFilter = $request->input('status');
        if ($statusFilter && array_key_exists($statusFilter, $statusOptions)) {
            $appointmentsQuery->where('status', $statusFilter);
        }

        $appointments = $appointmentsQuery
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        $appointmentsByDay = $appointments->groupBy(fn ($appointment) => $appointment->appointment_date->format('Y-m-d'));

        $statusPriority = [
            'pendente' => 0,
            'confirmado' => 1,
            'concluido' => 2,
            'cancelado' => 3,
        ];

        $appointmentsList = $appointments->sortBy(function ($appointment) use ($statusPriority) {
            $priority = $statusPriority[$appointment->status] ?? 99;

            return sprintf(
                '%02d-%s-%s',
                $priority,
                $appointment->appointment_date->format('Ymd'),
                $appointment->appointment_time
            );
        });

        $pendingAppointments = $appointments->where('status', 'pendente')
            ->sortBy(function ($appointment) {
                return sprintf(
                    '%s-%s',
                    $appointment->appointment_date->format('Ymd'),
                    $appointment->appointment_time
                );
            });

        $confirmedAppointments = $appointments->where('status', 'confirmado')
            ->sortBy(function ($appointment) {
                return sprintf(
                    '%s-%s',
                    $appointment->appointment_date->format('Ymd'),
                    $appointment->appointment_time
                );
            });

        $timeSlots = collect();
        for ($hour = 9; $hour <= 17; $hour++) {
            $timeSlots->push(sprintf('%02d:00', $hour));
            $timeSlots->push(sprintf('%02d:30', $hour));
        }
        $timeSlots->push('18:00');

        $weekDays = collect(range(0, 5))->map(fn ($offset) => $weekStart->copy()->addDays($offset));

        return view('admin.appointments.index', [
            'weekStart' => $weekStart,
            'weekEnd' => $weekEnd,
            'weekDays' => $weekDays,
            'appointments' => $appointments,
            'appointmentsByDay' => $appointmentsByDay,
            'appointmentsList' => $appointmentsList,
            'pendingAppointments' => $pendingAppointments,
            'confirmedAppointments' => $confirmedAppointments,
            'timeSlots' => $timeSlots,
            'statusFilter' => $statusFilter,
            'statusOptions' => $statusOptions,
            'previousWeek' => $weekStart->copy()->subWeek()->format('Y-m-d'),
            'nextWeek' => $weekStart->copy()->addWeek()->format('Y-m-d'),
            'currentWeek' => Carbon::today()->format('Y-m-d'),
        ]);
    }

    public function manage()
    {
        $pending = Appointment::with('service')
            ->where('status', 'pendente')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        $confirmed = Appointment::with('service')
            ->where('status', 'confirmado')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        return view('admin.appointments.manage', [
            'pendingAppointments' => $pending,
            'confirmedAppointments' => $confirmed,
        ]);
    }

    public function create()
    {
        $services = Service::active()->get();
        return view('admin.appointments.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'client_name' => ['required', 'string', 'max:255'],
            'client_phone' => ['nullable', 'string', 'max:20'],
            'client_email' => ['nullable', 'email', 'max:255'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required'],
            'status' => ['required', 'in:pendente,confirmado,concluido,cancelado'],
            'notes' => ['nullable', 'string'],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);

        Appointment::create($validated);

        return redirect()->route('admin.appointments.index')->with('success', 'Agendamento criado com sucesso!');
    }

    public function edit(Appointment $appointment)
    {
        $services = Service::active()->get();
        return view('admin.appointments.edit', compact('appointment', 'services'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'client_name' => ['required', 'string', 'max:255'],
            'client_phone' => ['required', 'string', 'max:20'],
            'client_email' => ['nullable', 'email', 'max:255'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required'],
            'status' => ['required', 'in:pendente,confirmado,concluido,cancelado'],
            'notes' => ['nullable', 'string'],
        ]);

        $previousStatus = $appointment->status;

        $appointment->update($validated);
        $appointment->load('service');

        if ($validated['status'] === 'concluido' && $previousStatus !== 'concluido') {
            Cashflow::create([
                'type' => 'entrada',
                'amount' => $appointment->service->price,
                'description' => 'Serviço: ' . $appointment->service->name . ' - Cliente: ' . $appointment->client_name,
                'transaction_date' => Carbon::today(),
                'category' => 'servico',
                'appointment_id' => $appointment->id,
            ]);
        }

        return redirect()->route('admin.appointments.index')->with('success', 'Agendamento atualizado com sucesso!');
    }

    public function confirm(Appointment $appointment)
    {
        if ($appointment->status === 'concluido' || $appointment->status === 'cancelado') {
            return redirect()->route('admin.appointments.index')
                ->with('error', 'Não é possível confirmar um agendamento concluído ou cancelado.');
        }

        $appointment->update(['status' => 'confirmado']);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Agendamento confirmado com sucesso!');
    }

    public function destroy(Appointment $appointment)
    {
        if ($appointment->status === 'concluido') {
            return redirect()->route('admin.appointments.index')
                ->with('error', 'Não é possível excluir um agendamento concluído.');
        }

        $appointment->delete();
        return redirect()->route('admin.appointments.index')->with('success', 'Agendamento excluído com sucesso!');
    }
}



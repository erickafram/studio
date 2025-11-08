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
        // Nova agenda estilo Trinks
        $selectedDate = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::today();
        $selectedMonth = $request->input('month') ? Carbon::parse($request->input('month')) : Carbon::today();
        
        $statusOptions = [
            'pendente' => 'Pendente',
            'confirmado' => 'Confirmado',
            'concluido' => 'Concluído',
            'cancelado' => 'Cancelado',
        ];

        // Filtros
        $statusFilter = $request->input('status');
        $professionalFilter = $request->input('professional');

        // Buscar agendamentos do dia selecionado
        $appointmentsQuery = Appointment::with('service')
            ->whereDate('appointment_date', $selectedDate->toDateString());

        if ($statusFilter && array_key_exists($statusFilter, $statusOptions)) {
            $appointmentsQuery->where('status', $statusFilter);
        }

        $appointments = $appointmentsQuery
            ->orderBy('appointment_time')
            ->get();

        // Horários disponíveis (9h às 18h, intervalos de 30min)
        $timeSlots = collect();
        for ($hour = 9; $hour <= 17; $hour++) {
            $timeSlots->push(sprintf('%02d:00', $hour));
            $timeSlots->push(sprintf('%02d:30', $hour));
        }
        $timeSlots->push('18:00');

        // Agrupar agendamentos por horário
        $appointmentsByTime = $appointments->groupBy(fn ($apt) => substr($apt->appointment_time, 0, 5));

        // Calendário do mês
        $monthStart = $selectedMonth->copy()->startOfMonth();
        $monthEnd = $selectedMonth->copy()->endOfMonth();
        
        // Buscar todos agendamentos do mês para marcar no calendário
        $monthAppointments = Appointment::whereBetween('appointment_date', [$monthStart, $monthEnd])
            ->get()
            ->groupBy(fn ($apt) => $apt->appointment_date->format('Y-m-d'));

        return view('admin.appointments.index', [
            'selectedDate' => $selectedDate,
            'selectedMonth' => $selectedMonth,
            'appointments' => $appointments,
            'appointmentsByTime' => $appointmentsByTime,
            'timeSlots' => $timeSlots,
            'statusFilter' => $statusFilter,
            'statusOptions' => $statusOptions,
            'monthAppointments' => $monthAppointments,
            'monthStart' => $monthStart,
            'monthEnd' => $monthEnd,
            'previousMonth' => $selectedMonth->copy()->subMonth()->format('Y-m-01'),
            'nextMonth' => $selectedMonth->copy()->addMonth()->format('Y-m-01'),
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



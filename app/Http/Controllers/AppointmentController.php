<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function create(Request $request)
    {
        $serviceId = $request->get('service_id');
        $services = Service::active()->get();
        $selectedService = $serviceId ? Service::find($serviceId) : null;

        return view('appointments.create', compact('services', 'selectedService'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'client_name' => ['required', 'string', 'max:255'],
            'client_phone' => ['required', 'string', 'max:20'],
            'client_email' => ['nullable', 'email', 'max:255'],
            'appointment_date' => ['required', 'date', 'after_or_equal:today'],
            'appointment_time' => ['required'],
            'notes' => ['nullable', 'string'],
        ]);

        $date = Carbon::parse($validated['appointment_date']);
        if ($date->isSunday()) {
            return back()->withErrors(['appointment_date' => 'Não trabalhamos aos domingos.'])->withInput();
        }

        $existingAppointment = Appointment::where('appointment_date', $validated['appointment_date'])
            ->where('appointment_time', $validated['appointment_time'])
            ->whereIn('status', ['pendente', 'confirmado'])
            ->exists();

        if ($existingAppointment) {
            return back()->withErrors(['appointment_time' => 'Este horário já está ocupado. Por favor, escolha outro horário.'])->withInput();
        }

        $normalizedPhone = $this->normalizePhone($validated['client_phone']);
        $formattedPhone = $this->formatPhone($normalizedPhone);
        $validated['client_phone'] = $formattedPhone ?? $validated['client_phone'];
        $validated['status'] = 'pendente';

        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        } else {
            $user = $this->findUserByContacts($normalizedPhone, $validated['client_email'] ?? null);

            if (!$user) {
                $user = User::create([
                    'name' => $validated['client_name'],
                    'email' => $validated['client_email'] ?? null,
                    'phone' => $formattedPhone ?? $validated['client_phone'],
                    'role' => 'cliente',
                    'password' => Hash::make(Str::random(10)),
                ]);
            } else {
                $updateData = ['name' => $validated['client_name']];
                if ($formattedPhone) {
                    $updateData['phone'] = $formattedPhone;
                }
                if (!empty($validated['client_email'])) {
                    $updateData['email'] = $validated['client_email'];
                }
                $user->update($updateData);
            }

            $validated['user_id'] = $user->id;
        }

        Appointment::create($validated);

        return redirect()->route('home')->with('success', 'Agendamento realizado com sucesso! Entraremos em contato para confirmação.');
    }

    public function getAvailableTimes(Request $request)
    {
        $date = $request->get('date');
        
        $allTimes = [];
        for ($hour = 9; $hour < 18; $hour++) {
            $allTimes[] = sprintf('%02d:00:00', $hour);
            $allTimes[] = sprintf('%02d:30:00', $hour);
        }

        $bookedTimes = Appointment::where('appointment_date', $date)
            ->whereIn('status', ['pendente', 'confirmado'])
            ->pluck('appointment_time')
            ->toArray();

        $availableTimes = array_diff($allTimes, $bookedTimes);

        return response()->json(array_values($availableTimes));
    }

    public function lookupClient(Request $request)
    {
        $phoneDigits = $this->normalizePhone($request->get('phone'));

        if (!$phoneDigits) {
            return response()->json(null);
        }

        $user = $this->findUserByContacts($phoneDigits, null);

        if (!$user) {
            return response()->json(null);
        }

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
        ]);
    }

    protected function normalizePhone(?string $phone): ?string
    {
        if (!$phone) {
            return null;
        }

        $digits = preg_replace('/\D/', '', $phone);

        return $digits ?: null;
    }

    protected function formatPhone(?string $digits): ?string
    {
        if (!$digits) {
            return null;
        }

        if (strlen($digits) === 11) {
            return sprintf('(%s) %s-%s', substr($digits, 0, 2), substr($digits, 2, 5), substr($digits, 7));
        }

        if (strlen($digits) === 10) {
            return sprintf('(%s) %s-%s', substr($digits, 0, 2), substr($digits, 2, 4), substr($digits, 6));
        }

        return $digits;
    }

    protected function phoneComparisonExpression(): string
    {
        return "REPLACE(REPLACE(REPLACE(REPLACE(phone, '(', ''), ')', ''), '-', ''), ' ', '')";
    }

    protected function findUserByContacts(?string $phoneDigits, ?string $email): ?User
    {
        $expression = $this->phoneComparisonExpression();

        return User::query()
            ->where(function ($query) use ($phoneDigits, $email, $expression) {
                if ($phoneDigits) {
                    $query->whereRaw("{$expression} = ?", [$phoneDigits]);
                }

                if ($email) {
                    $query->orWhere('email', $email);
                }
            })
            ->orderBy('created_at', 'desc')
            ->first();
    }
}




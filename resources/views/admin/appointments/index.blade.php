@extends('layouts.admin')

@section('page-title', 'Agenda Semanal de Atendimentos')

@section('content')
<div class="space-y-8">
    <!-- Ações e filtros -->
    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.appointments.create') }}" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#8B5CF6] to-[#6B46C1] px-5 py-2.5 text-sm font-semibold text-white shadow hover:shadow-lg hover:scale-105">
                <i class="fas fa-plus"></i>
                Novo Agendamento
            </a>
            <a href="{{ route('admin.appointments.manage') }}" class="inline-flex items-center gap-2 rounded-full border border-[#7C3AED] px-4 py-2 text-xs font-semibold text-[#7C3AED] hover:bg-[#F3E8FF]">
                <i class="fas fa-clipboard-check"></i>
                Confirmar / Finalizar agendamentos
            </a>
        </div>

        <form method="GET" class="flex flex-wrap items-center gap-3">
            <div class="flex items-center gap-2">
                <label for="week" class="text-xs font-semibold text-[#6B7280] uppercase">Semana</label>
                <input type="date" name="week" id="week" value="{{ request('week', $weekStart->format('Y-m-d')) }}" class="rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30">
            </div>
            <div class="flex items-center gap-2">
                <label for="status" class="text-xs font-semibold text-[#6B7280] uppercase">Status</label>
                <select name="status" id="status" class="rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30">
                    <option value="">Todos</option>
                    @foreach($statusOptions as $value => $label)
                        <option value="{{ $value }}" {{ $statusFilter === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-[#7C3AED] px-4 py-2 text-xs font-semibold text-[#7C3AED] hover:bg-[#F3E8FF]">
                <i class="fas fa-filter"></i>
                Aplicar filtros
            </button>
            @if(request()->hasAny(['status', 'week']))
                <a href="{{ route('admin.appointments.index') }}" class="text-xs font-semibold text-[#9CA3AF] hover:text-[#6B7280]">
                    Limpar filtros
                </a>
            @endif
        </form>
    </div>

    <!-- Calendário semanal -->
    <div class="rounded-3xl border border-[#8B5CF6]/50 bg-white p-6 shadow-lg shadow-[#8B5CF6]/20">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-[#7C3AED]">Agenda semanal</p>
                <h2 class="text-2xl font-semibold text-[#374151]">{{ $weekStart->format('d \d\e M') }} a {{ $weekEnd->format('d \d\e M \d\e Y') }}</h2>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                <div class="flex items-center gap-2 rounded-full border border-[#FBBF24]/50 bg-[#FEF3C7] px-3 py-2 text-[#B45309]">
                    <span class="h-3 w-3 rounded-full bg-[#FBBF24]"></span>
                    Pendente
                </div>
                <div class="flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-2 text-emerald-700">
                    <span class="h-3 w-3 rounded-full bg-emerald-400"></span>
                    Confirmado
                </div>
                <div class="flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700">
                    <span class="h-3 w-3 rounded-full bg-slate-400"></span>
                    Concluído
                </div>
                <div class="flex items-center gap-2 rounded-full border border-rose-200 bg-rose-50 px-3 py-2 text-rose-700">
                    <span class="h-3 w-3 rounded-full bg-rose-400"></span>
                    Cancelado
                </div>
            </div>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full border-separate border-spacing-0 text-sm">
                <thead>
                    <tr>
                        <th class="sticky left-0 z-20 w-28 bg-[#F3E8FF] px-4 py-3 text-left text-xs font-semibold uppercase text-[#6B7280]">Horário</th>
                        @foreach($weekDays as $day)
                            <th class="min-w-[180px] bg-[#F3E8FF] px-3 py-3 text-left text-xs font-semibold uppercase text-[#6B7280]">
                                <div class="flex flex-col">
                                    <span>{{ $day->locale('pt_BR')->dayName }}</span>
                                    <span class="text-[#9CA3AF] text-[11px]">{{ $day->format('d/m') }}</span>
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($timeSlots as $slot)
                        <tr>
                            <td class="sticky left-0 z-10 bg-white/90 px-4 py-4 text-[#6B7280] text-xs font-medium">{{ $slot }}</td>
                            @foreach($weekDays as $day)
                                @php
                                    $dateKey = $day->format('Y-m-d');
                                    $appointmentsForDay = $appointmentsByDay->get($dateKey, collect());
                                    $appointmentForSlot = $appointmentsForDay->first(function ($appointment) use ($slot) {
                                        return substr($appointment->appointment_time, 0, 5) === $slot;
                                    });
                                @endphp
                                <td class="px-3 py-3 align-top">
                                    @if($appointmentForSlot)
                                        @php
                                            $statusClasses = [
                                                'pendente' => 'border-[#FBBF24]/60 bg-[#FEF3C7] text-[#B45309]',
                                                'confirmado' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
                                                'concluido' => 'border-slate-200 bg-slate-50 text-slate-700',
                                                'cancelado' => 'border-rose-200 bg-rose-50 text-rose-700',
                                            ];
                                            $status = $appointmentForSlot->status;
                                        @endphp
                                        <div class="group rounded-2xl border px-3 py-3 text-xs shadow-sm transition hover:-translate-y-1 hover:shadow-md {{ $statusClasses[$status] ?? 'border-slate-200 bg-slate-50 text-slate-700' }}">
                                            <div class="flex items-center justify-between gap-2">
                                                <p class="font-semibold break-words">{{ $appointmentForSlot->client_name }}</p>
                                                <span class="text-[11px] uppercase tracking-wide">{{ ucfirst($status) }}</span>
                                            </div>
                                            <p class="mt-1 font-medium text-[#4B5563] break-words">{{ $appointmentForSlot->service->name }}</p>
                                            <p class="mt-1 text-[11px] text-[#6B7280] break-all">{{ $appointmentForSlot->client_phone }}</p>
                                            @if($appointmentForSlot->notes)
                                                <p class="mt-2 rounded-lg bg-white/70 px-2 py-1 text-[11px] text-[#6B7280] line-clamp-3">{{ $appointmentForSlot->notes }}</p>
                                            @endif
                                            <div class="mt-3 flex items-center justify-end text-[11px] text-[#7C3AED]">
                                                <a href="{{ route('admin.appointments.edit', $appointmentForSlot) }}" class="flex items-center gap-1 font-semibold">
                                                    <i class="fas fa-edit"></i>
                                                    Editar
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="rounded-2xl border border-dashed border-[#8B5CF6]/30 bg-[#F3E8FF]/30 px-3 py-4 text-center text-[11px] text-[#7C3AED]">
                                            <span>Disponível</span>
                                        </div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Lista e resumo -->
    <div class="grid gap-6 lg:grid-cols-5">
        <div class="lg:col-span-3 rounded-3xl border border-[#8B5CF6]/50 bg-white shadow-lg shadow-[#8B5CF6]/20">
            <div class="border-b border-[#8B5CF6]/20 px-6 py-4">
                <h3 class="text-lg font-semibold text-[#374151]">Lista de agendamentos ({{ $weekStart->format('d/m') }} a {{ $weekEnd->format('d/m') }})</h3>
                <p class="text-xs text-[#6B7280]">Agendamentos pendentes aparecem primeiro</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[#8B5CF6]/20 text-sm">
                    <thead class="bg-[#F3E8FF] text-[11px] uppercase tracking-wide text-[#8B5CF6]">
                        <tr>
                            <th class="px-6 py-3 text-left">Data</th>
                            <th class="px-6 py-3 text-left">Cliente</th>
                            <th class="px-6 py-3 text-left">Serviço</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#8B5CF6]/20">
                        @foreach($appointmentsList as $appointment)
                            <tr class="hover:bg-[#F3E8FF]/30">
                                <td class="px-6 py-4 text-[#374151]">
                                    <div class="font-semibold">{{ $appointment->appointment_date->format('d/m/Y') }}</div>
                                    <div class="text-[11px] text-[#6B7280] uppercase tracking-wide">{{ substr($appointment->appointment_time, 0, 5) }}</div>
                                </td>
                                <td class="px-6 py-4 text-[#374151]">
                                    <div class="font-semibold break-words">{{ $appointment->client_name }}</div>
                                    <div class="text-[11px] text-[#9CA3AF] break-all">{{ $appointment->client_phone }}</div>
                                </td>
                                <td class="px-6 py-4 text-[#6B7280] break-words">{{ $appointment->service->name }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusLabels = [
                                            'pendente' => 'bg-[#F3E8FF] text-[#8B5CF6]',
                                            'confirmado' => 'bg-emerald-100 text-emerald-800',
                                            'concluido' => 'bg-slate-100 text-slate-800',
                                            'cancelado' => 'bg-rose-100 text-rose-800',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $statusLabels[$appointment->status] ?? 'bg-slate-100 text-slate-800' }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <a href="{{ route('admin.appointments.edit', $appointment) }}" class="text-[#8B5CF6] hover:text-[#6B46C1] mr-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este agendamento?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if($appointmentsList->isEmpty())
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-[#9CA3AF] text-sm">
                                    Nenhum agendamento encontrado para esta semana.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="lg:col-span-2 rounded-3xl border border-[#8B5CF6]/50 bg-white p-6 shadow-lg shadow-[#8B5CF6]/20">
            <h3 class="text-lg font-semibold text-[#374151]">Resumo rápido</h3>
            <div class="mt-4 space-y-4 text-sm text-[#6B7280]">
                <div class="flex justify-between">
                    <span>Total na semana</span>
                    <span class="font-semibold text-[#374151]">{{ $appointments->count() }}</span>
                </div>
                @foreach($statusOptions as $statusValue => $statusLabel)
                    <div class="flex justify-between">
                        <span>{{ $statusLabel }}</span>
                        <span class="font-semibold text-[#374151]">{{ $appointments->where('status', $statusValue)->count() }}</span>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 rounded-2xl border border-dashed border-[#8B5CF6]/40 bg-[#F3E8FF]/70 p-4 text-xs text-[#7C3AED]">
                <p class="font-semibold">Dica</p>
                <p class="mt-2">Clique em um horário vazio no calendário para direcionar a criação de um novo agendamento.</p>
            </div>
        </div>
    </div>
</div>
@endsection



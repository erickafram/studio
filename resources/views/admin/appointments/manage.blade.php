@extends('layouts.admin')

@section('page-title', 'Confirmar e Finalizar Agendamentos')

@section('content')
<div class="space-y-10">
    <div class="bg-white rounded-3xl shadow-lg p-6 border border-[#8B5CF6]/40">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-[#374151] flex items-center gap-3">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-[#F3E8FF] text-[#7C3AED] text-lg">
                        <i class="fas fa-bell"></i>
                    </span>
                    Agendamentos pendentes de confirmação
                </h2>
                <p class="mt-2 text-xs text-[#9CA3AF]">Entre em contato com as clientes e confirme o horário ou ajuste as informações.</p>
            </div>
            <span class="rounded-full bg-[#F3E8FF] px-4 py-2 text-xs font-semibold text-[#7C3AED]">{{ $pendingAppointments->count() }} pendente(s)</span>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @forelse($pendingAppointments as $appointment)
                <div class="rounded-2xl border border-dashed border-[#8B5CF6]/40 bg-[#F3E8FF]/60 p-5 text-sm text-[#6B7280]">
                    <div class="flex items-center justify-between text-xs text-[#7C3AED] uppercase tracking-wide">
                        <span>{{ $appointment->appointment_date->format('d/m/Y') }} • {{ substr($appointment->appointment_time, 0, 5) }}</span>
                        <span>Pendente</span>
                    </div>
                    <h3 class="mt-3 text-base font-semibold text-[#374151] break-words">{{ $appointment->client_name }}</h3>
                    <p class="text-xs text-[#9CA3AF] break-words">{{ $appointment->service->name }}</p>
                    <p class="mt-3 text-xs text-[#6B7280] flex items-center gap-2 break-all"><i class="fas fa-phone"></i> {{ $appointment->client_phone }}</p>
                    @if($appointment->client_email)
                        <p class="mt-1 text-xs text-[#9CA3AF] break-all"><i class="fas fa-envelope mr-2"></i>{{ $appointment->client_email }}</p>
                    @endif
                    @if($appointment->notes)
                        <p class="mt-3 rounded-xl bg-white/80 px-3 py-2 text-xs text-[#9CA3AF] line-clamp-3">{{ $appointment->notes }}</p>
                    @endif
                    <div class="mt-4 flex flex-wrap items-center justify-end gap-2 text-xs">
                        <form action="{{ route('admin.appointments.confirm', $appointment) }}" method="POST" onsubmit="return confirm('Confirmar este agendamento?');">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-1 rounded-full border border-[#7C3AED] bg-[#7C3AED] px-3 py-1 text-white shadow hover:bg-[#6B46C1]">
                                <i class="fas fa-check"></i>
                                Confirmar
                            </button>
                        </form>
                        <a href="{{ route('admin.appointments.edit', $appointment) }}" class="inline-flex items-center gap-1 rounded-full border border-[#7C3AED] px-3 py-1 text-[#7C3AED] hover:bg-[#EDE9FE]">
                            <i class="fas fa-edit"></i>
                            Editar
                        </a>
                        <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" onsubmit="return confirm('Cancelar este agendamento?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1 rounded-full border border-rose-400 px-3 py-1 text-rose-600 hover:bg-rose-50">
                                <i class="fas fa-times"></i>
                                Cancelar
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-[#8B5CF6]/40 bg-white px-4 py-6 text-center text-xs text-[#9CA3AF]">
                    Nenhum agendamento pendente no momento. Tudo confirmado!
                </div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-lg p-6 border border-emerald-300/40">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-emerald-700 flex items-center gap-3">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 text-lg">
                        <i class="fas fa-money-check"></i>
                    </span>
                    Confirmados aguardando finalização
                </h2>
                <p class="mt-2 text-xs text-emerald-500">Finalize o atendimento e registre a entrada no caixa alterando o status para “concluído”.</p>
            </div>
            <span class="rounded-full bg-emerald-100 px-4 py-2 text-xs font-semibold text-emerald-600">{{ $confirmedAppointments->count() }} aguardando pagamento</span>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @forelse($confirmedAppointments as $appointment)
                <div class="rounded-2xl border border-emerald-300 bg-emerald-50 p-5 text-sm text-emerald-700">
                    <div class="flex items-center justify-between text-xs uppercase tracking-wide">
                        <span>{{ $appointment->appointment_date->format('d/m/Y') }} • {{ substr($appointment->appointment_time, 0, 5) }}</span>
                        <span class="text-emerald-600">Confirmado</span>
                    </div>
                    <h3 class="mt-3 text-base font-semibold text-emerald-800 break-words">{{ $appointment->client_name }}</h3>
                    <p class="text-xs text-emerald-600/90 break-words">{{ $appointment->service->name }}</p>
                    <p class="mt-3 text-xs text-emerald-600/90 flex items-center gap-2 break-all"><i class="fas fa-phone"></i> {{ $appointment->client_phone }}</p>
                    @if($appointment->notes)
                        <p class="mt-3 rounded-xl bg-white/80 px-3 py-2 text-xs text-emerald-600/90 line-clamp-3">{{ $appointment->notes }}</p>
                    @endif
                    <div class="mt-4 space-y-2 text-xs">
                        <form action="{{ route('admin.appointments.update', $appointment) }}" method="POST" onsubmit="return confirm('Marcar este agendamento como concluído e registrar pagamento?');">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="service_id" value="{{ $appointment->service_id }}">
                            <input type="hidden" name="client_name" value="{{ $appointment->client_name }}">
                            <input type="hidden" name="client_phone" value="{{ $appointment->client_phone }}">
                            <input type="hidden" name="client_email" value="{{ $appointment->client_email }}">
                            <input type="hidden" name="appointment_date" value="{{ $appointment->appointment_date->format('Y-m-d') }}">
                            <input type="hidden" name="appointment_time" value="{{ $appointment->appointment_time }}">
                            <input type="hidden" name="status" value="concluido">
                            <input type="hidden" name="notes" value="{{ $appointment->notes }}">
                            <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-full border border-emerald-500 bg-emerald-500 px-3 py-2 text-white shadow hover:bg-emerald-600">
                                <i class="fas fa-check-double"></i>
                                Finalizar atendimento (pago)
                            </button>
                        </form>
                        <a href="{{ route('admin.appointments.edit', $appointment) }}" class="inline-flex w-full items-center justify-center gap-2 rounded-full border border-emerald-400 px-3 py-2 text-emerald-600 hover:bg-emerald-100">
                            <i class="fas fa-edit"></i>
                            Ajustar informações
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-emerald-300 bg-white px-4 py-6 text-center text-xs text-emerald-500">
                    Não há agendamentos confirmados aguardando finalização.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection



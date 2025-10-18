@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Card: Receita Hoje -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                <i class="fas fa-dollar-sign text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-[#6B6B6B]">Receita Hoje</p>
                <p class="text-2xl font-bold text-[#3A3A3A]">R$ {{ number_format($todayRevenue, 2, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Card: Despesas Hoje -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                <i class="fas fa-money-bill-wave text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-[#6B6B6B]">Despesas Hoje</p>
                <p class="text-2xl font-bold text-[#3A3A3A]">R$ {{ number_format($todayExpenses, 2, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Card: Receita Mensal -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                <i class="fas fa-chart-line text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-600">Receita Mensal</p>
                <p class="text-2xl font-bold text-gray-800">R$ {{ number_format($monthRevenue, 2, ',', '.') }}</p>
                <p class="text-xs text-gray-500">Saídas: R$ {{ number_format($monthExpenses, 2, ',', '.') }}</p>
                <p class="text-xs font-semibold {{ $monthBalance >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                    Saldo: R$ {{ number_format($monthBalance, 2, ',', '.') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Card: Agendamentos Pendentes -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-[#E8B4D9] rounded-md p-3">
                <i class="fas fa-clock text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-[#6B6B6B]">Pendentes</p>
                <p class="text-2xl font-bold text-[#3A3A3A]">{{ $pendingAppointments }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Agendamentos de Hoje -->
<div class="bg-white rounded-lg shadow-lg border border-[#E8B4D9]/30 p-6 mb-6">
    <h3 class="text-xl font-bold text-[#3A3A3A] mb-4">
        <i class="fas fa-calendar-day text-[#D89FC4] mr-2"></i> Agendamentos de Hoje
    </h3>
    @if($todayAppointments->isEmpty())
        <p class="text-[#6B6B6B]">Nenhum agendamento para hoje.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#E8B4D9]/20">
                <thead class="bg-[#FAE8F5]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#6B6B6B] uppercase tracking-wider">Horário</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#6B6B6B] uppercase tracking-wider">Cliente</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#6B6B6B] uppercase tracking-wider">Serviço</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#6B6B6B] uppercase tracking-wider">Telefone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#6B6B6B] uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#E8B4D9]/20">
                    @foreach($todayAppointments as $appointment)
                        <tr class="hover:bg-[#FAE8F5]/30">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[#3A3A3A]">
                                {{ substr($appointment->appointment_time, 0, 5) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#3A3A3A]">
                                {{ $appointment->client_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#6B6B6B]">
                                {{ $appointment->service->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#6B6B6B]">
                                {{ $appointment->client_phone }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($appointment->status === 'pendente')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#FAE8F5] text-[#D89FC4]">
                                        Pendente
                                    </span>
                                @elseif($appointment->status === 'confirmado')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                        Confirmado
                                    </span>
                                @elseif($appointment->status === 'concluido')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Concluído
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Cancelado
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Próximos Agendamentos -->
    <div class="bg-white rounded-lg shadow-lg border border-[#E8B4D9]/30 p-6">
        <h3 class="text-xl font-bold text-[#3A3A3A] mb-4">
            <i class="fas fa-calendar-alt text-[#D89FC4] mr-2"></i> Próximos Agendamentos
        </h3>
        @if($upcomingAppointments->isEmpty())
            <p class="text-[#6B6B6B]">Nenhum agendamento próximo.</p>
        @else
            <div class="space-y-3">
                @foreach($upcomingAppointments as $appointment)
                    <div class="border-l-4 border-[#D89FC4] pl-4 py-2">
                        <p class="font-semibold text-[#3A3A3A]">{{ $appointment->client_name }}</p>
                        <p class="text-sm text-[#6B6B6B]">{{ $appointment->service->name }}</p>
                        <p class="text-sm text-[#9B9B9B]">
                            {{ $appointment->appointment_date->format('d/m/Y') }} às {{ substr($appointment->appointment_time, 0, 5) }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
        <a href="{{ route('admin.appointments.index') }}" class="mt-4 block text-center text-[#D89FC4] hover:text-[#C88AB3] font-semibold transition">
            Ver todos os agendamentos →
        </a>
    </div>

    <!-- Produtos com Estoque Baixo -->
    <div class="bg-white rounded-lg shadow-lg border border-[#E8B4D9]/30 p-6">
        <h3 class="text-xl font-bold text-[#3A3A3A] mb-4">
            <i class="fas fa-exclamation-triangle text-[#D89FC4] mr-2"></i> Estoque Baixo
        </h3>
        @if($lowStockItems->isEmpty())
            <p class="text-[#6B6B6B]">Todos os produtos estão com estoque adequado.</p>
        @else
            <div class="space-y-3">
                @foreach($lowStockItems as $item)
                    <div class="border-l-4 border-red-500 pl-4 py-2">
                        <p class="font-semibold text-[#3A3A3A]">{{ $item->product_name }}</p>
                        <p class="text-sm text-red-600">
                            Quantidade: {{ $item->quantity }} (Mínimo: {{ $item->minimum_quantity }})
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
        <a href="{{ route('admin.stock.index') }}" class="mt-4 block text-center text-[#D89FC4] hover:text-[#C88AB3] font-semibold transition">
            Gerenciar estoque →
        </a>
    </div>
</div>
@endsection



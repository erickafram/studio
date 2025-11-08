@extends('layouts.admin')

@section('page-title', 'Agenda de Atendimentos')

@section('content')
<div class="flex flex-col lg:flex-row gap-4 h-[calc(100vh-12rem)]" x-data="{ 
    selectedDate: '{{ $selectedDate->format('Y-m-d') }}',
    selectedMonth: '{{ $selectedMonth->format('Y-m') }}'
}">
    
    <!-- Sidebar Esquerda - Calendário + Filtros (Escondida no mobile) -->
    <div class="hidden lg:block lg:w-64 flex-shrink-0 space-y-4">
        
        <!-- Calendário Mensal -->
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-4">
            <!-- Header do Calendário -->
            <div class="flex items-center justify-between mb-4">
                <a href="?month={{ $previousMonth }}&date={{ $selectedDate->format('Y-m-d') }}&status={{ $statusFilter }}" 
                   class="p-2 hover:bg-gray-100 rounded-lg transition">
                    <i class="fas fa-chevron-left text-gray-600"></i>
                </a>
                <h3 class="text-sm font-bold text-gray-900">
                    {{ $selectedMonth->locale('pt_BR')->isoFormat('MMMM YYYY') }}
                </h3>
                <a href="?month={{ $nextMonth }}&date={{ $selectedDate->format('Y-m-d') }}&status={{ $statusFilter }}" 
                   class="p-2 hover:bg-gray-100 rounded-lg transition">
                    <i class="fas fa-chevron-right text-gray-600"></i>
                </a>
            </div>

            <!-- Dias da Semana -->
            <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 0.25rem; margin-bottom: 0.5rem;">
                @foreach(['D', 'S', 'T', 'Q', 'Q', 'S', 'S'] as $day)
                    <div style="text-align: center; font-size: 0.75rem; font-weight: 600; color: #6B7280;">{{ $day }}</div>
                @endforeach
            </div>

            <!-- Dias do Mês -->
            <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 0.25rem;">
                @php
                    $firstDayOfWeek = $monthStart->copy()->dayOfWeek;
                    $daysInMonth = $monthEnd->day;
                    
                    // Ajustar para começar na segunda-feira (0 = domingo, 1 = segunda)
                    $offset = $firstDayOfWeek == 0 ? 6 : $firstDayOfWeek - 1;
                @endphp

                @for($i = 0; $i < $offset; $i++)
                    <div style="aspect-ratio: 1;"></div>
                @endfor

                @for($day = 1; $day <= $daysInMonth; $day++)
                    @php
                        $date = $selectedMonth->copy()->day($day);
                        $dateStr = $date->format('Y-m-d');
                        $isToday = $date->isToday();
                        $isSelected = $dateStr === $selectedDate->format('Y-m-d');
                        $hasAppointments = isset($monthAppointments[$dateStr]);
                    @endphp
                    <a href="?date={{ $dateStr }}&month={{ $selectedMonth->format('Y-m-01') }}&status={{ $statusFilter }}"
                       style="aspect-ratio: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; 
                              border-radius: 0.5rem; font-size: 0.75rem; transition: all 0.2s; position: relative; text-decoration: none;
                              {{ $isSelected ? 'background-color: #9333ea; color: white; font-weight: bold;' : ($isToday ? 'background-color: #f3e8ff; color: #7e22ce; font-weight: 600;' : 'color: #374151;') }}"
                       onmouseover="if(!this.style.backgroundColor.includes('9333ea')) this.style.backgroundColor='#f3f4f6'"
                       onmouseout="if(!this.style.backgroundColor.includes('9333ea')) this.style.backgroundColor='{{ $isToday ? '#f3e8ff' : 'transparent' }}'">
                        <span>{{ $day }}</span>
                        @if($hasAppointments)
                            <span style="position: absolute; bottom: 2px; width: 4px; height: 4px; border-radius: 50%; 
                                         background-color: {{ $isSelected ? 'white' : '#9333ea' }};"></span>
                        @endif
                    </a>
                @endfor
            </div>

            <!-- Botão Hoje -->
            <div class="mt-4 pt-4 border-t border-gray-200">
                <a href="?date={{ now()->format('Y-m-d') }}&month={{ now()->format('Y-m-01') }}" 
                   class="block text-center text-sm font-semibold text-purple-600 hover:text-purple-700">
                    Hoje
                </a>
            </div>
        </div>

        <!-- Filtros -->
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-4">
            <h3 class="text-sm font-bold text-gray-900 mb-3">Filtros</h3>
            
            <form method="GET" class="space-y-3">
                <input type="hidden" name="date" value="{{ $selectedDate->format('Y-m-d') }}">
                <input type="hidden" name="month" value="{{ $selectedMonth->format('Y-m-01') }}">
                
                <!-- Status -->
                <div>
                    <label class="text-xs font-semibold text-gray-600 mb-1 block">Status</label>
                    <select name="status" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-200">
                        <option value="">Todos os status</option>
                        @foreach($statusOptions as $value => $label)
                            <option value="{{ $value }}" {{ $statusFilter === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold py-2 px-4 rounded-lg transition">
                        Aplicar
                    </button>
                    @if($statusFilter)
                        <a href="?date={{ $selectedDate->format('Y-m-d') }}&month={{ $selectedMonth->format('Y-m-01') }}" 
                           class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold py-2 px-4 rounded-lg transition text-center">
                            Limpar
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Legenda de Status -->
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-4">
            <h3 class="text-xs font-bold text-gray-600 uppercase mb-3">Legenda</h3>
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                    <span class="text-xs text-gray-700">Pendente</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                    <span class="text-xs text-gray-700">Confirmado</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    <span class="text-xs text-gray-700">Concluído</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <span class="text-xs text-gray-700">Cancelado</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Área Principal - Horários do Dia -->
    <div class="flex-1 bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden flex flex-col">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white p-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold">{{ $selectedDate->locale('pt_BR')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</h2>
                    <p class="text-sm text-purple-100 mt-1">
                        {{ $appointments->count() }} agendamento(s) no dia
                    </p>
                </div>
                <a href="{{ route('admin.appointments.create') }}?date={{ $selectedDate->format('Y-m-d') }}" 
                   class="bg-white text-purple-600 hover:bg-purple-50 px-4 py-2 rounded-lg font-semibold text-sm transition flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Novo Agendamento
                </a>
            </div>
        </div>

        <!-- Grade de Horários - Desktop -->
        <div class="hidden md:block flex-1 overflow-y-auto p-4">
            <div class="space-y-2">
                @foreach($timeSlots as $time)
                    @php
                        $hasAppointment = isset($appointmentsByTime[$time]);
                        $slotAppointments = $hasAppointment ? $appointmentsByTime[$time] : collect();
                    @endphp
                    
                    <div class="flex gap-3 min-h-[60px]">
                        <!-- Horário -->
                        <div class="w-16 flex-shrink-0 text-sm font-semibold text-gray-500 pt-1">
                            {{ $time }}
                        </div>

                        <!-- Slot de Agendamento -->
                        <div class="flex-1">
                            @if($hasAppointment)
                                @foreach($slotAppointments as $appointment)
                                    @php
                                        $statusColors = [
                                            'pendente' => 'bg-yellow-50 border-yellow-400 hover:bg-yellow-100',
                                            'confirmado' => 'bg-blue-50 border-blue-500 hover:bg-blue-100',
                                            'concluido' => 'bg-green-50 border-green-500 hover:bg-green-100',
                                            'cancelado' => 'bg-red-50 border-red-500 hover:bg-red-100',
                                        ];
                                        $statusDotColors = [
                                            'pendente' => 'bg-yellow-400',
                                            'confirmado' => 'bg-blue-500',
                                            'concluido' => 'bg-green-500',
                                            'cancelado' => 'bg-red-500',
                                        ];
                                    @endphp
                                    
                                    <div class="border-l-4 rounded-lg p-3 mb-2 transition cursor-pointer {{ $statusColors[$appointment->status] }}"
                                         onclick="window.location.href='{{ route('admin.appointments.edit', $appointment) }}'">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <div class="w-2 h-2 rounded-full {{ $statusDotColors[$appointment->status] }}"></div>
                                                    <span class="font-bold text-gray-900">{{ $appointment->client_name }}</span>
                                                </div>
                                                <p class="text-sm text-gray-700 mb-1">
                                                    <i class="fas fa-spa text-purple-500 mr-1"></i>
                                                    {{ $appointment->service->name }}
                                                </p>
                                                <div class="flex items-center gap-3 text-xs text-gray-600">
                                                    <span>
                                                        <i class="fas fa-phone mr-1"></i>
                                                        {{ $appointment->client_phone }}
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-clock mr-1"></i>
                                                        {{ $appointment->service->duration_minutes }}min
                                                    </span>
                                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                                        {{ $appointment->status === 'pendente' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                                        {{ $appointment->status === 'confirmado' ? 'bg-blue-200 text-blue-800' : '' }}
                                                        {{ $appointment->status === 'concluido' ? 'bg-green-200 text-green-800' : '' }}
                                                        {{ $appointment->status === 'cancelado' ? 'bg-red-200 text-red-800' : '' }}">
                                                        {{ $statusOptions[$appointment->status] }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex gap-1 ml-2">
                                                <a href="{{ route('admin.appointments.edit', $appointment) }}" 
                                                   class="p-1.5 hover:bg-white rounded transition" title="Editar">
                                                    <i class="fas fa-edit text-gray-600 text-sm"></i>
                                                </a>
                                            </div>
                                        </div>
                                        @if($appointment->notes)
                                            <p class="text-xs text-gray-600 mt-2 italic">
                                                <i class="fas fa-comment-dots mr-1"></i>
                                                {{ $appointment->notes }}
                                            </p>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="border-2 border-dashed border-gray-200 rounded-lg p-3 text-center text-gray-400 hover:border-purple-300 hover:bg-purple-50 transition cursor-pointer"
                                     onclick="window.location.href='{{ route('admin.appointments.create') }}?date={{ $selectedDate->format('Y-m-d') }}&time={{ $time }}'">
                                    <i class="fas fa-plus-circle text-sm"></i>
                                    <span class="text-xs ml-1">Horário disponível</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Lista Compacta - Mobile -->
        <div class="md:hidden flex-1 overflow-y-auto p-3">
            <!-- Header Mobile com Data e Navegação -->
            <div class="mb-3 sticky top-0 bg-white z-10 pb-3 border-b border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <a href="?date={{ $selectedDate->copy()->subDay()->format('Y-m-d') }}&month={{ $selectedMonth->format('Y-m-01') }}" 
                       class="p-2 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-chevron-left text-gray-600"></i>
                    </a>
                    <div class="text-center">
                        <h3 class="font-bold text-gray-900">{{ $selectedDate->locale('pt_BR')->isoFormat('DD [de] MMMM') }}</h3>
                        <p class="text-xs text-gray-500">{{ $selectedDate->locale('pt_BR')->isoFormat('dddd') }}</p>
                    </div>
                    <a href="?date={{ $selectedDate->copy()->addDay()->format('Y-m-d') }}&month={{ $selectedMonth->format('Y-m-01') }}" 
                       class="p-2 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-chevron-right text-gray-600"></i>
                    </a>
                </div>
                
                <!-- Botão Novo Agendamento -->
                <a href="{{ route('admin.appointments.create') }}?date={{ $selectedDate->format('Y-m-d') }}" 
                   class="flex items-center justify-center gap-2 bg-purple-600 text-white px-4 py-2.5 rounded-lg text-sm font-semibold shadow-md">
                    <i class="fas fa-plus"></i>
                    Novo Agendamento
                </a>
            </div>

            <!-- Lista de Horários -->
            <div class="space-y-2">
                @foreach($timeSlots as $time)
                    @php
                        $hasAppointment = isset($appointmentsByTime[$time]);
                        $slotAppointments = $hasAppointment ? $appointmentsByTime[$time] : collect();
                    @endphp
                    
                    @if($hasAppointment)
                        <!-- Horário com Agendamento -->
                        @foreach($slotAppointments as $appointment)
                            @php
                                $statusColors = [
                                    'pendente' => 'bg-yellow-50 border-l-yellow-400',
                                    'confirmado' => 'bg-blue-50 border-l-blue-500',
                                    'concluido' => 'bg-green-50 border-l-green-500',
                                    'cancelado' => 'bg-red-50 border-l-red-500',
                                ];
                                $statusDotColors = [
                                    'pendente' => 'bg-yellow-400',
                                    'confirmado' => 'bg-blue-500',
                                    'concluido' => 'bg-green-500',
                                    'cancelado' => 'bg-red-500',
                                ];
                            @endphp
                            
                            <div class="border-l-4 rounded-lg p-3 {{ $statusColors[$appointment->status] }} shadow-sm"
                                 onclick="window.location.href='{{ route('admin.appointments.edit', $appointment) }}'">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full {{ $statusDotColors[$appointment->status] }}"></div>
                                        <span class="font-bold text-gray-900 text-base">{{ substr($appointment->appointment_time, 0, 5) }}</span>
                                    </div>
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                        {{ $appointment->status === 'pendente' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                        {{ $appointment->status === 'confirmado' ? 'bg-blue-200 text-blue-800' : '' }}
                                        {{ $appointment->status === 'concluido' ? 'bg-green-200 text-green-800' : '' }}
                                        {{ $appointment->status === 'cancelado' ? 'bg-red-200 text-red-800' : '' }}">
                                        {{ $statusOptions[$appointment->status] }}
                                    </span>
                                </div>
                                
                                <p class="font-bold text-gray-900 mb-1">{{ $appointment->client_name }}</p>
                                <p class="text-sm text-gray-700 mb-2">
                                    <i class="fas fa-spa text-purple-500 mr-1"></i>
                                    {{ $appointment->service->name }}
                                </p>
                                
                                <div class="flex items-center gap-3 text-xs text-gray-600">
                                    <span>
                                        <i class="fas fa-phone mr-1"></i>
                                        {{ $appointment->client_phone }}
                                    </span>
                                    <span>
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $appointment->service->duration_minutes }}min
                                    </span>
                                </div>
                                
                                @if($appointment->notes)
                                    <p class="text-xs text-gray-600 mt-2 italic border-t border-gray-200 pt-2">
                                        <i class="fas fa-comment-dots mr-1"></i>
                                        {{ $appointment->notes }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <!-- Horário Disponível -->
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-3 bg-gray-50 flex items-center justify-between"
                             onclick="window.location.href='{{ route('admin.appointments.create') }}?date={{ $selectedDate->format('Y-m-d') }}&time={{ $time }}'">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-clock text-gray-400"></i>
                                <span class="text-sm font-semibold text-gray-600">{{ $time }}</span>
                            </div>
                            <div class="flex items-center gap-1 text-xs text-gray-500">
                                <i class="fas fa-plus-circle"></i>
                                <span>Disponível</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

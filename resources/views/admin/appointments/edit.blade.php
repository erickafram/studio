@extends('layouts.admin')

@section('page-title', 'Editar Agendamento')

@section('content')
<div class="max-w-8xl">
    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('admin.appointments.update', $appointment) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="service_id" class="block text-[#3A3A3A] text-sm font-bold mb-2">
                    Serviço *
                </label>
                <select name="service_id" id="service_id" required
                    class="shadow border border-[#E8B4D9]/50 rounded w-full py-2 px-3 text-[#3A3A3A] leading-tight focus:outline-none focus:border-[#D89FC4] focus:ring-[#E8B4D9]/20 @error('service_id') border-red-500 @enderror">
                    <option value="">Selecione um serviço</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id', $appointment->service_id) == $service->id ? 'selected' : '' }}>
                            {{ $service->name }} - R$ {{ number_format($service->price, 2, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('service_id')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="client_name" class="block text-[#3A3A3A] text-sm font-bold mb-2">
                    Nome do Cliente *
                </label>
                <input type="text" name="client_name" id="client_name" value="{{ old('client_name', $appointment->client_name) }}" required
                    class="shadow border border-[#E8B4D9]/50 rounded w-full py-2 px-3 text-[#3A3A3A] leading-tight focus:outline-none focus:border-[#D89FC4] focus:ring-[#E8B4D9]/20 @error('client_name') border-red-500 @enderror">
                @error('client_name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="client_phone" class="block text-[#3A3A3A] text-sm font-bold mb-2">
                        Telefone *
                    </label>
                    <input type="text" name="client_phone" id="client_phone" value="{{ old('client_phone', $appointment->client_phone) }}" required
                        class="shadow border border-[#E8B4D9]/50 rounded w-full py-2 px-3 text-[#3A3A3A] leading-tight focus:outline-none focus:border-[#D89FC4] focus:ring-[#E8B4D9]/20 @error('client_phone') border-red-500 @enderror">
                    @error('client_phone')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="client_email" class="block text-[#3A3A3A] text-sm font-bold mb-2">
                        E-mail
                    </label>
                    <input type="email" name="client_email" id="client_email" value="{{ old('client_email', $appointment->client_email) }}"
                        class="shadow border border-[#E8B4D9]/50 rounded w-full py-2 px-3 text-[#3A3A3A] leading-tight focus:outline-none focus:border-[#D89FC4] focus:ring-[#E8B4D9]/20 @error('client_email') border-red-500 @enderror">
                    @error('client_email')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="appointment_date" class="block text-[#3A3A3A] text-sm font-bold mb-2">
                        Data *
                    </label>
                    <input type="date" name="appointment_date" id="appointment_date" value="{{ old('appointment_date', $appointment->appointment_date->format('Y-m-d')) }}" required
                        class="shadow border border-[#E8B4D9]/50 rounded w-full py-2 px-3 text-[#3A3A3A] leading-tight focus:outline-none focus:border-[#D89FC4] focus:ring-[#E8B4D9]/20 @error('appointment_date') border-red-500 @enderror">
                    @error('appointment_date')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="appointment_time" class="block text-[#3A3A3A] text-sm font-bold mb-2">
                        Horário *
                    </label>
                    <input type="time" name="appointment_time" id="appointment_time" value="{{ old('appointment_time', substr($appointment->appointment_time, 0, 5)) }}" required
                        class="shadow border border-[#E8B4D9]/50 rounded w-full py-2 px-3 text-[#3A3A3A] leading-tight focus:outline-none focus:border-[#D89FC4] focus:ring-[#E8B4D9]/20 @error('appointment_time') border-red-500 @enderror">
                    @error('appointment_time')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-[#3A3A3A] text-sm font-bold mb-2">
                        Status *
                    </label>
                    <select name="status" id="status" required
                        class="shadow border border-[#E8B4D9]/50 rounded w-full py-2 px-3 text-[#3A3A3A] leading-tight focus:outline-none focus:border-[#D89FC4] focus:ring-[#E8B4D9]/20 @error('status') border-red-500 @enderror">
                        <option value="pendente" {{ old('status', $appointment->status) == 'pendente' ? 'selected' : '' }}>Pendente</option>
                        <option value="confirmado" {{ old('status', $appointment->status) == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                        <option value="concluido" {{ old('status', $appointment->status) == 'concluido' ? 'selected' : '' }}>Concluído</option>
                        <option value="cancelado" {{ old('status', $appointment->status) == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="notes" class="block text-[#3A3A3A] text-sm font-bold mb-2">
                    Observações
                </label>
                <textarea name="notes" id="notes" rows="3"
                    class="shadow border border-[#E8B4D9]/50 rounded w-full py-2 px-3 text-[#3A3A3A] leading-tight focus:outline-none focus:border-[#D89FC4] focus:ring-[#E8B4D9]/20">{{ old('notes', $appointment->notes) }}</textarea>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.appointments.index') }}" class="flex-1 bg-[#9B9B9B] hover:bg-[#6B6B6B] text-white font-bold py-2 px-4 rounded text-center transition">
                    <i class="fas fa-arrow-left mr-2"></i> Cancelar
                </a>
                <button type="submit" class="flex-1 bg-gradient-to-r from-[#E8B4D9] to-[#D89FC4] hover:from-[#D89FC4] hover:to-[#C88AB3] text-white font-bold py-2 px-4 rounded transition">
                    <i class="fas fa-save mr-2"></i> Atualizar Agendamento
                </button>
            </div>
        </form>
    </div>
</div>
@endsection



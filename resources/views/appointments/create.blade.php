@extends('layouts.app')

@section('title', 'Agendar Serviço - Studio de Unhas')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-purple-100">
        <h2 class="text-3xl font-bold text-slate-900 mb-6 text-center">
            <i class="fas fa-calendar-plus text-purple-600"></i> Agendar Serviço
        </h2>

        <form method="POST" action="{{ route('appointments.store') }}" id="appointment-form">
            @csrf

            <div class="mb-6">
                <label for="client_phone" class="block text-slate-700 text-sm font-bold mb-2">
                    Telefone *
                </label>
                <input type="text" name="client_phone" id="client_phone" value="{{ old('client_phone', auth()->user()->phone ?? '') }}" required placeholder="(11) 99999-9999"
                    class="shadow border border-slate-300 rounded-lg w-full py-3 px-4 text-slate-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('client_phone') border-red-500 @enderror">
                @error('client_phone')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
                <p class="text-xs text-slate-400 mt-2">Ao informar um número já cadastrado, os demais campos são preenchidos automaticamente.</p>
            </div>

            <div class="mb-6">
                <label for="client_name" class="block text-slate-700 text-sm font-bold mb-2">
                    Nome Completo *
                </label>
                <input type="text" name="client_name" id="client_name" value="{{ old('client_name', auth()->user()->name ?? '') }}" required
                    class="shadow border border-slate-300 rounded-lg w-full py-3 px-4 text-slate-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('client_name') border-red-500 @enderror">
                @error('client_name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="client_email" class="block text-slate-700 text-sm font-bold mb-2">
                        E-mail
                    </label>
                    <input type="email" name="client_email" id="client_email" value="{{ old('client_email', auth()->user()->email ?? '') }}"
                        class="shadow border border-slate-300 rounded-lg w-full py-3 px-4 text-slate-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('client_email') border-red-500 @enderror" placeholder="Opcional">
                    @error('client_email')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="service_id" class="block text-slate-700 text-sm font-bold mb-2">
                        Serviço *
                    </label>
                    <select name="service_id" id="service_id" required
                        class="shadow border border-slate-300 rounded-lg w-full py-3 px-4 text-slate-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('service_id') border-red-500 @enderror">
                        <option value="">Selecione um serviço</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}"
                                    {{ (old('service_id', $selectedService?->id ?? '') == $service->id) ? 'selected' : '' }}>
                                {{ $service->name }} - R$ {{ number_format($service->price, 2, ',', '.') }} ({{ $service->duration_minutes }} min)
                            </option>
                        @endforeach
                    </select>
                    @error('service_id')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="appointment_date" class="block text-slate-700 text-sm font-bold mb-2">
                        Data *
                    </label>
                    <input type="date" name="appointment_date" id="appointment_date" value="{{ old('appointment_date') }}" required
                        min="{{ date('Y-m-d') }}"
                        class="shadow border border-slate-300 rounded-lg w-full py-3 px-4 text-slate-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('appointment_date') border-red-500 @enderror">
                    @error('appointment_date')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="appointment_time" class="block text-slate-700 text-sm font-bold mb-2">
                        Horário *
                    </label>
                    <select name="appointment_time" id="appointment_time" required
                        class="shadow border border-slate-300 rounded-lg w-full py-3 px-4 text-slate-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('appointment_time') border-red-500 @enderror">
                        <option value="">Selecione a data primeiro</option>
                    </select>
                    @error('appointment_time')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="notes" class="block text-slate-700 text-sm font-bold mb-2">
                    Observações
                </label>
                <textarea name="notes" id="notes" rows="3"
                    class="shadow border border-slate-300 rounded-lg w-full py-3 px-4 text-slate-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">{{ old('notes') }}</textarea>
            </div>

            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 mb-6">
                <p class="text-sm text-purple-800">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Importante:</strong> Atendemos de segunda a sábado, das 9h às 18h. Após o agendamento, entraremos em contato para confirmação.
                </p>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('home') }}" class="flex-1 bg-slate-300 hover:bg-slate-400 text-slate-800 font-bold py-3 px-6 rounded-lg text-center transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Voltar
                </a>
                <button type="submit" class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-3 px-6 rounded-lg transition duration-300 shadow-lg hover:shadow-xl">
                    <i class="fas fa-calendar-check mr-2"></i> Confirmar Agendamento
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const phoneInput = document.getElementById('client_phone');
    const nameInput = document.getElementById('client_name');
    const emailInput = document.getElementById('client_email');

    const formatPhone = (value) => {
        let digits = value.replace(/\D/g, '');
        if (digits.length <= 10) {
            return digits.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
        }
        return digits.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
    };

    phoneInput.addEventListener('input', function(e) {
        e.target.value = formatPhone(e.target.value);
    });

    phoneInput.addEventListener('blur', function() {
        const raw = phoneInput.value.replace(/\D/g, '');
        if (raw.length < 10) {
            return;
        }

        fetch(`{{ route('appointments.lookup-client') }}?phone=${raw}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    nameInput.value = data.name || '';
                    emailInput.value = data.email || '';
                }
            })
            .catch(error => console.error('Erro ao buscar cliente:', error));
    });

    const dateInput = document.getElementById('appointment_date');
    const timeSelect = document.getElementById('appointment_time');

    dateInput.addEventListener('change', function() {
        const date = this.value;
        if (!date) return;

        // Verificar se é domingo
        const selectedDate = new Date(date + 'T00:00:00');
        if (selectedDate.getDay() === 0) {
            alert('Não trabalhamos aos domingos. Por favor, escolha outro dia.');
            this.value = '';
            return;
        }

        timeSelect.innerHTML = '<option value="">Carregando...</option>';

        fetch(`{{ route('api.available-times') }}?date=${date}`)
            .then(response => response.json())
            .then(times => {
                timeSelect.innerHTML = '<option value="">Selecione um horário</option>';
                if (times.length === 0) {
                    timeSelect.innerHTML = '<option value="">Nenhum horário disponível</option>';
                } else {
                    times.forEach(time => {
                        const option = document.createElement('option');
                        option.value = time;
                        option.textContent = time.substring(0, 5);
                        timeSelect.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                timeSelect.innerHTML = '<option value="">Erro ao carregar horários</option>';
            });
    });
});
</script>
@endpush




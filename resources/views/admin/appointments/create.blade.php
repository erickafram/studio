@extends('layouts.admin')

@section('page-title', 'Novo Agendamento')

@section('content')
<div class="max-w-4xl">
    <div class="rounded-3xl border border-[#8B5CF6]/40 bg-white p-6 shadow-lg shadow-[#8B5CF6]/20">
        <form method="POST" action="{{ route('admin.appointments.store') }}" id="appointment-form">
            @csrf

            <div class="mb-6">
                <label class="block text-sm font-semibold text-[#374151] uppercase tracking-wide mb-2">Cliente</label>
                <div class="grid gap-3 md:grid-cols-12">
                    <div class="md:col-span-8 relative">
                        <input type="hidden" name="user_id" id="user_id" value="{{ old('user_id') }}">
                        <input type="text" id="user_search" placeholder="Digite nome, telefone ou e-mail" value="{{ old('client_name') }}"
                               class="w-full rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30">
                        <div id="user_suggestions" class="absolute z-20 mt-2 hidden w-full rounded-xl border border-[#8B5CF6]/40 bg-white shadow-lg"></div>
                    </div>
                    <div class="md:col-span-4 flex items-center gap-2 text-xs text-[#9CA3AF]">
                        <span class="rounded-full bg-[#F3E8FF] px-3 py-1 text-[#7C3AED]">Opcional</span>
                        <p>Selecione um cliente existente ou cadastre manualmente.</p>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-2 mb-6">
                <div>
                    <label class="block text-xs font-semibold text-[#6B7280] uppercase mb-2">Nome *</label>
                    <input type="text" name="client_name" id="client_name" value="{{ old('client_name') }}" required
                           class="w-full rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#6B7280] uppercase mb-2">Telefone</label>
                    <input type="text" name="client_phone" id="client_phone" value="{{ old('client_phone') }}"
                           class="w-full rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30">
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-2 mb-6">
                <div>
                    <label class="block text-xs font-semibold text-[#6B7280] uppercase mb-2">E-mail</label>
                    <input type="email" name="client_email" id="client_email" value="{{ old('client_email') }}"
                           class="w-full rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30" placeholder="Opcional">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#6B7280] uppercase mb-2">Serviço *</label>
                    <select name="service_id" id="service_id" class="w-full rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30" required>
                        <option value="">Selecione</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->name }} - R$ {{ number_format($service->price, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-3 mb-6">
                <div>
                    <label class="block text-xs font-semibold text-[#6B7280] uppercase mb-2">Data *</label>
                    <input type="date" name="appointment_date" id="appointment_date" value="{{ old('appointment_date') }}" required
                           class="w-full rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#6B7280] uppercase mb-2">Horário *</label>
                    <input type="time" name="appointment_time" id="appointment_time" value="{{ old('appointment_time') }}" required
                           class="w-full rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#6B7280] uppercase mb-2">Status *</label>
                    <select name="status" class="w-full rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30" required>
                        <option value="pendente" {{ old('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                        <option value="confirmado" {{ old('status') == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                        <option value="concluido" {{ old('status') == 'concluido' ? 'selected' : '' }}>Concluído</option>
                        <option value="cancelado" {{ old('status') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-xs font-semibold text-[#6B7280] uppercase mb-2">Observações</label>
                <textarea name="notes" rows="3" class="w-full rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30">{{ old('notes') }}</textarea>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.appointments.index') }}" class="inline-flex items-center gap-2 rounded-full border border-[#9CA3AF] px-4 py-2 text-sm font-semibold text-[#6B7280] hover:bg-[#F3F4F6]">
                    <i class="fas fa-arrow-left"></i>
                    Cancelar
                </a>
                <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#8B5CF6] to-[#6B46C1] px-5 py-2 text-sm font-semibold text-white shadow hover:shadow-lg">
                    <i class="fas fa-save"></i>
                    Salvar agendamento
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const userSearchInput = document.getElementById('user_search');
    const userSuggestions = document.getElementById('user_suggestions');
    const userIdInput = document.getElementById('user_id');
    const nameInput = document.getElementById('client_name');
    const phoneInput = document.getElementById('client_phone');
    const emailInput = document.getElementById('client_email');

    let debounceTimeout = null;

    userSearchInput.addEventListener('input', () => {
        const query = userSearchInput.value.trim();

        clearTimeout(debounceTimeout);

        if (query.length < 2) {
            userSuggestions.classList.add('hidden');
            userIdInput.value = '';
            return;
        }

        debounceTimeout = setTimeout(async () => {
            const response = await fetch(`{{ route('admin.users.search') }}?q=${encodeURIComponent(query)}`);
            const data = await response.json();
            userSuggestions.innerHTML = '';

            if (!data.length) {
                userSuggestions.classList.add('hidden');
                return;
            }

            data.forEach(user => {
                const option = document.createElement('button');
                option.type = 'button';
                option.className = 'w-full text-left px-4 py-2 text-sm hover:bg-[#F3E8FF]';
                option.innerHTML = `
                    <div class="font-semibold text-[#374151]">${user.name}</div>
                    <div class="text-xs text-[#9CA3AF]">${user.email ?? 'Sem e-mail cadastrado'}</div>
                    <div class="text-xs text-[#9CA3AF]">${user.phone ?? 'Sem telefone'}</div>
                `;
                option.addEventListener('click', () => {
                    userIdInput.value = user.id;
                    nameInput.value = user.name;
                    phoneInput.value = user.phone ?? '';
                    emailInput.value = user.email ?? '';
                    userSearchInput.value = user.name;
                    userSuggestions.classList.add('hidden');
                });
                userSuggestions.appendChild(option);
            });

            userSuggestions.classList.remove('hidden');
        }, 300);
    });

    document.addEventListener('click', (event) => {
        if (!userSearchInput.contains(event.target) && !userSuggestions.contains(event.target)) {
            userSuggestions.classList.add('hidden');
        }
    });
</script>
@endpush



@extends('layouts.admin')

@section('page-title', 'Novo Usuário')

@section('content')
<div class="max-w-3xl">
    <div class="rounded-3xl border border-[#8B5CF6]/30 bg-white p-6 shadow-lg shadow-[#8B5CF6]/10">
        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-[#6B7280] uppercase mb-2">Nome completo *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30">
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[#6B7280] uppercase mb-2">E-mail</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30" placeholder="Opcional">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#6B7280] uppercase mb-2">Telefone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="w-full rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30" placeholder="Opcional">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[#6B7280] uppercase mb-2">Função *</label>
                    <select name="role" class="w-full rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30" required>
                        <option value="cliente" {{ old('role') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#6B7280] uppercase mb-2">Senha *</label>
                    <input type="password" name="password" required
                           class="w-full rounded-lg border border-[#8B5CF6]/40 px-3 py-2 text-sm focus:border-[#7C3AED] focus:ring-[#C4B5FD]/30">
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 rounded-full border border-[#9CA3AF] px-4 py-2 text-sm font-semibold text-[#6B7280] hover:bg-[#F3F4F6]">
                    <i class="fas fa-arrow-left"></i>
                    Cancelar
                </a>
                <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#8B5CF6] to-[#6B46C1] px-5 py-2 text-sm font-semibold text-white shadow hover:shadow-lg">
                    <i class="fas fa-save"></i>
                    Salvar usuário
                </button>
            </div>
        </form>
    </div>
</div>
@endsection



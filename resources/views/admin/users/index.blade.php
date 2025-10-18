@extends('layouts.admin')

@section('page-title', 'Usuários do Sistema')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-semibold text-[#374151]">Usuários cadastrados</h2>
            <p class="text-sm text-[#9CA3AF]">Gerencie clientes e administradores do sistema.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#8B5CF6] to-[#6B46C1] px-5 py-2.5 text-sm font-semibold text-white shadow hover:shadow-lg">
            <i class="fas fa-user-plus"></i>
            Novo usuário
        </a>
    </div>

    <div class="rounded-3xl border border-[#8B5CF6]/30 bg-white shadow-lg shadow-[#8B5CF6]/10">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#8B5CF6]/20 text-sm">
                <thead class="bg-[#F3E8FF] text-[11px] uppercase tracking-wide text-[#7C3AED]">
                    <tr>
                        <th class="px-6 py-3 text-left">Nome</th>
                        <th class="px-6 py-3 text-left">E-mail</th>
                        <th class="px-6 py-3 text-left">Telefone</th>
                        <th class="px-6 py-3 text-left">Função</th>
                        <th class="px-6 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#8B5CF6]/10">
                    @forelse($users as $user)
                        <tr class="hover:bg-[#F3E8FF]/40">
                            <td class="px-6 py-4 text-[#374151] font-semibold">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-[#6B7280]">{{ $user->email ?? '—' }}</td>
                            <td class="px-6 py-4 text-[#6B7280]">{{ $user->phone ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $user->role === 'admin' ? 'bg-emerald-100 text-emerald-700' : 'bg-[#F3E8FF] text-[#7C3AED]' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right text-sm">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-[#8B5CF6] hover:text-[#6B46C1] mr-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-[#9CA3AF] text-sm">
                                Nenhum usuário cadastrado ainda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="px-6 py-4 bg-[#F9FAFB] border-t border-[#8B5CF6]/20">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection



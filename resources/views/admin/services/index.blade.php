@extends('layouts.admin')

@section('page-title', 'Gerenciar Serviços')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.services.create') }}" class="bg-gradient-to-r from-[#8B5CF6] to-[#6B46C1] hover:from-[#6B46C1] hover:to-[#8B5CF6] text-white font-bold py-2 px-4 rounded inline-flex items-center transition">
        <i class="fas fa-plus mr-2"></i> Novo Serviço
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg border border-[#8B5CF6]/30 overflow-hidden">
    <table class="min-w-full divide-y divide-[#8B5CF6]/20">
        <thead class="bg-[#F3E8FF]">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-[#6B7280] uppercase tracking-wider">Nome</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-[#6B7280] uppercase tracking-wider">Descrição</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-[#6B7280] uppercase tracking-wider">Preço</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-[#6B7280] uppercase tracking-wider">Duração</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-[#6B7280] uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-[#6B7280] uppercase tracking-wider">Ações</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-[#8B5CF6]/20">
            @forelse($services as $service)
                <tr class="hover:bg-[#FAE8F5]/30">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[#3A3A3A]">
                        {{ $service->name }}
                    </td>
                    <td class="px-6 py-4 text-sm text-[#6B6B6B]">
                        {{ Str::limit($service->description, 50) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#3A3A3A]">
                        R$ {{ number_format($service->price, 2, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#6B6B6B]">
                        {{ $service->duration_minutes }} min
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($service->active)
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                Ativo
                            </span>
                        @else
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Inativo
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.services.edit', $service) }}" class="text-[#8B5CF6] hover:text-[#6B46C1] mr-3 transition">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este serviço?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                <i class="fas fa-trash"></i> Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-[#9CA3AF]">
                        Nenhum serviço cadastrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection



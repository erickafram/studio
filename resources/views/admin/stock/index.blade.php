@extends('layouts.admin')

@section('page-title', 'Gerenciar Estoque')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.stock.create') }}" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
        <i class="fas fa-plus mr-2"></i> Adicionar Produto
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produto</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantidade</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mínimo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Custo Unit.</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Ações</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($stockItems as $item)
                <tr class="{{ $item->isLowStock() ? 'bg-red-50' : '' }}">
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $item->product_name }}</div>
                        @if($item->description)
                            <div class="text-xs text-gray-500">{{ Str::limit($item->description, 40) }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="font-bold {{ $item->isLowStock() ? 'text-red-600' : 'text-gray-900' }}">
                            {{ $item->quantity }}
                        </span>
                        @if($item->isLowStock())
                            <i class="fas fa-exclamation-triangle text-red-500 ml-2" title="Estoque baixo"></i>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ $item->minimum_quantity }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        @if($item->unit_cost)
                            R$ {{ number_format($item->unit_cost, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.stock.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.stock.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Nenhum produto no estoque.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection




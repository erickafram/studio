@extends('layouts.admin')

@section('page-title', 'Fluxo de Caixa')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <a href="{{ route('admin.cashflow.create') }}" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
        <i class="fas fa-plus mr-2"></i> Nova Transação
    </a>

    <form method="GET" class="flex gap-2 flex-wrap">
        <select name="type" class="border rounded py-2 px-3 text-sm">
            <option value="">Todos os Tipos</option>
            <option value="entrada" {{ request('type') == 'entrada' ? 'selected' : '' }}>Entrada</option>
            <option value="saida" {{ request('type') == 'saida' ? 'selected' : '' }}>Saída</option>
        </select>
        <input type="date" name="start_date" value="{{ request('start_date') }}" placeholder="Data Início" class="border rounded py-2 px-3 text-sm">
        <input type="date" name="end_date" value="{{ request('end_date') }}" placeholder="Data Fim" class="border rounded py-2 px-3 text-sm">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
            <i class="fas fa-filter"></i> Filtrar
        </button>
    </form>
</div>

<div class="grid gap-4 md:grid-cols-3 mb-6">
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
        <p class="text-sm text-green-700 font-semibold">Total Entradas</p>
        <p class="text-2xl font-bold text-green-700">R$ {{ number_format($totalEntradas, 2, ',', '.') }}</p>
    </div>
    <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded">
        <p class="text-sm text-rose-700 font-semibold">Total Saídas</p>
        <p class="text-2xl font-bold text-rose-700">R$ {{ number_format($totalSaidas, 2, ',', '.') }}</p>
    </div>
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
        <p class="text-sm text-blue-700 font-semibold">Saldo</p>
        <p class="text-2xl font-bold {{ $saldo >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">R$ {{ number_format($saldo, 2, ',', '.') }}</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descrição</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoria</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Valor</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($transactions as $transaction)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $transaction->transaction_date->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $transaction->description }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ ucfirst($transaction->category) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($transaction->type === 'entrada')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Entrada
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Saída
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold {{ $transaction->type === 'entrada' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $transaction->type === 'entrada' ? '+' : '-' }} R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.cashflow.edit', $transaction) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.cashflow.destroy', $transaction) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza?');">
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
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Nenhuma transação encontrada.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($transactions->hasPages())
        <div class="px-6 py-4 bg-gray-50">
            {{ $transactions->links() }}
        </div>
    @endif
</div>
@endsection




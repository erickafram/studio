@extends('layouts.admin')

@section('page-title', 'Fechamento Diário de Caixa')

@section('content')
<div class="mb-6">
    <form method="GET" class="flex gap-2 items-center">
        <label class="text-gray-700 font-semibold">Data:</label>
        <input type="date" name="date" value="{{ $date }}" class="border rounded py-2 px-3">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-search"></i> Buscar
        </button>
        <button type="button" onclick="window.print()" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-print"></i> Imprimir
        </button>
    </form>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-center mb-6">Fechamento de Caixa - {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</h2>

    <!-- Entradas -->
    <div class="mb-6">
        <h3 class="text-xl font-bold text-green-700 mb-3 border-b-2 border-green-500 pb-2">
            <i class="fas fa-arrow-down"></i> Entradas
        </h3>
        @if($entradas->isEmpty())
            <p class="text-gray-500">Nenhuma entrada registrada.</p>
        @else
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="text-left py-2 px-3">Descrição</th>
                        <th class="text-left py-2 px-3">Categoria</th>
                        <th class="text-right py-2 px-3">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entradas as $entrada)
                        <tr class="border-b">
                            <td class="py-2 px-3">{{ $entrada->description }}</td>
                            <td class="py-2 px-3">{{ ucfirst($entrada->category) }}</td>
                            <td class="py-2 px-3 text-right text-green-600 font-semibold">
                                R$ {{ number_format($entrada->amount, 2, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-green-50 font-bold">
                        <td colspan="2" class="py-2 px-3 text-right">Total Entradas:</td>
                        <td class="py-2 px-3 text-right text-green-700">
                            R$ {{ number_format($totalEntradas, 2, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>

    <!-- Saídas -->
    <div class="mb-6">
        <h3 class="text-xl font-bold text-red-700 mb-3 border-b-2 border-red-500 pb-2">
            <i class="fas fa-arrow-up"></i> Saídas
        </h3>
        @if($saidas->isEmpty())
            <p class="text-gray-500">Nenhuma saída registrada.</p>
        @else
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="text-left py-2 px-3">Descrição</th>
                        <th class="text-left py-2 px-3">Categoria</th>
                        <th class="text-right py-2 px-3">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($saidas as $saida)
                        <tr class="border-b">
                            <td class="py-2 px-3">{{ $saida->description }}</td>
                            <td class="py-2 px-3">{{ ucfirst($saida->category) }}</td>
                            <td class="py-2 px-3 text-right text-red-600 font-semibold">
                                R$ {{ number_format($saida->amount, 2, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-red-50 font-bold">
                        <td colspan="2" class="py-2 px-3 text-right">Total Saídas:</td>
                        <td class="py-2 px-3 text-right text-red-700">
                            R$ {{ number_format($totalSaidas, 2, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>

    <!-- Resumo -->
    <div class="bg-blue-50 border-2 border-blue-500 rounded p-4 mt-6">
        <div class="grid grid-cols-3 gap-4 text-center">
            <div>
                <p class="text-sm text-gray-600">Entradas</p>
                <p class="text-xl font-bold text-green-700">R$ {{ number_format($totalEntradas, 2, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Saídas</p>
                <p class="text-xl font-bold text-red-700">R$ {{ number_format($totalSaidas, 2, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Saldo do Dia</p>
                <p class="text-2xl font-bold {{ $saldo >= 0 ? 'text-blue-700' : 'text-red-700' }}">
                    R$ {{ number_format($saldo, 2, ',', '.') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection






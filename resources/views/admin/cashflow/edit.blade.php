@extends('layouts.admin')

@section('page-title', 'Editar Transação')

@section('content')
<div class="max-w-8xl">
    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('admin.cashflow.update', $cashflow) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Tipo *</label>
                    <select name="type" id="type" required
                        class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('type') border-red-500 @enderror">
                        <option value="">Selecione</option>
                        <option value="entrada" {{ old('type', $cashflow->type) == 'entrada' ? 'selected' : '' }}>Entrada</option>
                        <option value="saida" {{ old('type', $cashflow->type) == 'saida' ? 'selected' : '' }}>Saída</option>
                    </select>
                    @error('type')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Categoria *</label>
                    <select name="category" id="category" required
                        class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('category') border-red-500 @enderror">
                        <option value="">Selecione</option>
                        <option value="servico" {{ old('category', $cashflow->category) == 'servico' ? 'selected' : '' }}>Serviço</option>
                        <option value="produto" {{ old('category', $cashflow->category) == 'produto' ? 'selected' : '' }}>Produto</option>
                        <option value="despesa" {{ old('category', $cashflow->category) == 'despesa' ? 'selected' : '' }}>Despesa</option>
                        <option value="outro" {{ old('category', $cashflow->category) == 'outro' ? 'selected' : '' }}>Outro</option>
                    </select>
                    @error('category')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Descrição *</label>
                <input type="text" name="description" id="description" value="{{ old('description', $cashflow->description) }}" required
                    class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('description') border-red-500 @enderror">
                @error('description')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Valor (R$) *</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount', $cashflow->amount) }}" step="0.01" min="0.01" required
                        class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('amount') border-red-500 @enderror">
                    @error('amount')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="transaction_date" class="block text-gray-700 text-sm font-bold mb-2">Data *</label>
                    <input type="date" name="transaction_date" id="transaction_date" value="{{ old('transaction_date', $cashflow->transaction_date->format('Y-m-d')) }}" required
                        class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('transaction_date') border-red-500 @enderror">
                    @error('transaction_date')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.cashflow.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded text-center">
                    <i class="fas fa-arrow-left mr-2"></i> Cancelar
                </a>
                <button type="submit" class="flex-1 bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-save mr-2"></i> Atualizar Transação
                </button>
            </div>
        </form>
    </div>
</div>
@endsection




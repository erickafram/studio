@extends('layouts.admin')

@section('page-title', 'Editar Produto')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('admin.stock.update', $stock) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="product_name" class="block text-gray-700 text-sm font-bold mb-2">Nome do Produto *</label>
                <input type="text" name="product_name" id="product_name" value="{{ old('product_name', $stock->product_name) }}" required
                    class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('product_name') border-red-500 @enderror">
                @error('product_name')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Descrição</label>
                <textarea name="description" id="description" rows="2"
                    class="shadow border rounded w-full py-2 px-3 text-gray-700">{{ old('description', $stock->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantidade *</label>
                    <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $stock->quantity) }}" min="0" required
                        class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('quantity') border-red-500 @enderror">
                    @error('quantity')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="minimum_quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantidade Mínima *</label>
                    <input type="number" name="minimum_quantity" id="minimum_quantity" value="{{ old('minimum_quantity', $stock->minimum_quantity) }}" min="0" required
                        class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('minimum_quantity') border-red-500 @enderror">
                    @error('minimum_quantity')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="unit_cost" class="block text-gray-700 text-sm font-bold mb-2">Custo Unitário (R$)</label>
                    <input type="number" name="unit_cost" id="unit_cost" value="{{ old('unit_cost', $stock->unit_cost) }}" step="0.01" min="0"
                        class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('unit_cost') border-red-500 @enderror">
                    @error('unit_cost')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.stock.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded text-center">
                    <i class="fas fa-arrow-left mr-2"></i> Cancelar
                </a>
                <button type="submit" class="flex-1 bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-save mr-2"></i> Atualizar Produto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection




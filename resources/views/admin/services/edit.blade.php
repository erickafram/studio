@extends('layouts.admin')

@section('page-title', 'Editar Serviço')

@section('content')
<div class="max-w-8xl">
    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('admin.services.update', $service) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                    Nome do Serviço *
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}" required
                    class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                    Descrição *
                </label>
                <textarea name="description" id="description" rows="3" required
                    class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror">{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="price" class="block text-gray-700 text-sm font-bold mb-2">
                        Preço (R$) *
                    </label>
                    <input type="number" name="price" id="price" value="{{ old('price', $service->price) }}" step="0.01" min="0" required
                        class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('price') border-red-500 @enderror">
                    @error('price')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="duration_minutes" class="block text-gray-700 text-sm font-bold mb-2">
                        Duração (minutos) *
                    </label>
                    <input type="number" name="duration_minutes" id="duration_minutes" value="{{ old('duration_minutes', $service->duration_minutes) }}" min="1" required
                        class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('duration_minutes') border-red-500 @enderror">
                    @error('duration_minutes')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="active" value="1" {{ old('active', $service->active) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-pink-600 shadow-sm focus:border-pink-300 focus:ring focus:ring-pink-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-700">Serviço Ativo</span>
                </label>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.services.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded text-center">
                    <i class="fas fa-arrow-left mr-2"></i> Cancelar
                </a>
                <button type="submit" class="flex-1 bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-save mr-2"></i> Atualizar Serviço
                </button>
            </div>
        </form>
    </div>
</div>
@endsection




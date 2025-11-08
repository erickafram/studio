@extends('layouts.admin')

@section('page-title', 'Novo Serviço')

@section('content')
    <div class="max-w-8xl">
        <div class="bg-white rounded-lg shadow-lg border border-[#E8B4D9]/30 p-6">
            <form method="POST" action="{{ route('admin.services.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-[#3A3A3A] text-sm font-bold mb-2">
                        Nome do Serviço *
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="shadow border border-[#E8B4D9]/50 rounded w-full py-2 px-3 text-[#3A3A3A] leading-tight focus:outline-none focus:border-[#D89FC4] focus:ring-[#E8B4D9]/20 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-[#3A3A3A] text-sm font-bold mb-2">
                        Descrição *
                    </label>
                    <textarea name="description" id="description" rows="3" required
                        class="shadow border border-[#E8B4D9]/50 rounded w-full py-2 px-3 text-[#3A3A3A] leading-tight focus:outline-none focus:border-[#D89FC4] focus:ring-[#E8B4D9]/20 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="price" class="block text-[#3A3A3A] text-sm font-bold mb-2">
                            Preço (R$) *
                        </label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" required
                            class="shadow border border-[#E8B4D9]/50 rounded w-full py-2 px-3 text-[#3A3A3A] leading-tight focus:outline-none focus:border-[#D89FC4] focus:ring-[#E8B4D9]/20 @error('price') border-red-500 @enderror">
                        @error('price')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="duration_minutes" class="block text-[#3A3A3A] text-sm font-bold mb-2">
                            Duração (minutos) *
                        </label>
                        <input type="number" name="duration_minutes" id="duration_minutes" value="{{ old('duration_minutes', 60) }}" min="1" required
                            class="shadow border border-[#E8B4D9]/50 rounded w-full py-2 px-3 text-[#3A3A3A] leading-tight focus:outline-none focus:border-[#D89FC4] focus:ring-[#E8B4D9]/20 @error('duration_minutes') border-red-500 @enderror">
                        @error('duration_minutes')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="active" value="1" {{ old('active', true) ? 'checked' : '' }}
                            class="rounded border-[#E8B4D9]/50 text-[#D89FC4] shadow-sm focus:border-[#D89FC4] focus:ring focus:ring-[#E8B4D9]/20 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-[#3A3A3A]">Serviço Ativo</span>
                    </label>
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('admin.services.index') }}" class="flex-1 bg-[#9B9B9B] hover:bg-[#6B6B6B] text-white font-bold py-2 px-4 rounded text-center transition">
                        <i class="fas fa-arrow-left mr-2"></i> Cancelar
                    </a>
                    <button type="submit" class="flex-1 bg-gradient-to-r from-[#8B5CF6] to-[#6B46C1] hover:from-[#6B46C1] hover:to-[#8B5CF6] text-white font-bold py-2 px-4 rounded transition">
                        <i class="fas fa-save mr-2"></i> Salvar Serviço
                    </button>
                </div>
        </form>
    </div>
</div>
@endsection



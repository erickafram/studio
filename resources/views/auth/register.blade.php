@extends('layouts.app')

@section('title', 'Cadastro - Studio de Unhas')

@section('content')
<div class="max-w-md mx-auto px-4">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">
            <i class="fas fa-user-plus text-pink-600"></i> Cadastro
        </h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                    Nome Completo *
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-pink-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                    E-mail *
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-pink-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">
                    Telefone
                </label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-pink-500 @error('phone') border-red-500 @enderror">
                @error('phone')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                    Senha *
                </label>
                <input type="password" name="password" id="password" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-pink-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">
                    Confirmar Senha *
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-pink-500">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                    <i class="fas fa-user-plus mr-2"></i> Cadastrar
                </button>
            </div>
        </form>

        <div class="text-center mt-6">
            <p class="text-gray-600 text-sm">
                Já tem uma conta?
                <a href="{{ route('login') }}" class="text-pink-600 hover:text-pink-800 font-semibold">
                    Faça login aqui
                </a>
            </p>
        </div>
    </div>
</div>
@endsection




@extends('layouts.app')

@section('title', 'Login - Studio de Unhas')

@section('content')
<div class="max-w-md mx-auto px-4">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">
            <i class="fas fa-user-lock text-pink-600"></i> Login
        </h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                    E-mail
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-pink-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                    Senha
                </label>
                <input type="password" name="password" id="password" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-pink-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-pink-600 shadow-sm focus:border-pink-300 focus:ring focus:ring-pink-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
                </label>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                    <i class="fas fa-sign-in-alt mr-2"></i> Entrar
                </button>
            </div>
        </form>

        <div class="text-center mt-6">
            <p class="text-gray-600 text-sm">
                Não tem uma conta?
                <a href="{{ route('register') }}" class="text-pink-600 hover:text-pink-800 font-semibold">
                    Cadastre-se aqui
                </a>
            </p>
        </div>
    </div>
</div>
@endsection




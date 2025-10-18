<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Acesso negado. Área restrita para administradores.');
        }

        return $next($request);
    }
}




<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Studio de Unhas')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="min-h-screen font-sans antialiased bg-white" x-data="{ mobileMenuOpen: false }">
    <!-- Header - Compact & Modern -->
    <header class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-spa text-white text-lg"></i>
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-gray-900 font-bold text-lg">Studio de Unhas</p>
                        <p class="text-gray-500 text-xs">Beleza e bem-estar</p>
                    </div>
                </a>
                
                <nav class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition">Início</a>
                    <a href="{{ route('appointments.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 rounded-lg transition">Agendar</a>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition">Admin</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition">Sair</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition">Entrar</a>
                    @endauth
                </nav>
                
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-gray-600 hover:text-purple-600">
                    <i class="fas" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden border-t border-gray-200 bg-white">
            <nav class="px-4 py-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg">Início</a>
                <a href="{{ route('appointments.create') }}" class="block px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg">Agendar</a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg">Admin</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg">Sair</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg">Entrar</a>
                @endauth
            </nav>
        </div>
    </header>

    @if(session('success'))
        <div class="max-w-8xl mx-auto mt-4 px-4">
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-center gap-3">
                <i class="fas fa-check-circle text-green-600"></i>
                <span class="text-sm text-green-800">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-8xl mx-auto mt-4 px-4">
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 flex items-center gap-3">
                <i class="fas fa-circle-exclamation text-red-600"></i>
                <span class="text-sm text-red-800">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <!-- Footer - Compact -->
    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 mb-6">
                <div>
                    <h3 class="text-white font-bold mb-3 flex items-center gap-2">
                        <i class="fas fa-spa text-purple-400"></i>
                        Studio de Unhas
                    </h3>
                    <p class="text-sm text-gray-400">Experiência premium em manicure e pedicure. Ambiente acolhedor e produtos de alta qualidade.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3 text-sm">Contato</h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center gap-2">
                            <i class="fas fa-phone text-purple-400 w-4"></i>
                            <span>(11) 99999-9999</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-envelope text-purple-400 w-4"></i>
                            <span>contato@studiounhas.com</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-purple-400 w-4"></i>
                            <span>Rua das Rosas, 123</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3 text-sm">Horário</h4>
                    <ul class="space-y-1 text-sm">
                        <li class="flex justify-between"><span>Seg - Sex</span><span>09h - 18h</span></li>
                        <li class="flex justify-between"><span>Sábado</span><span>09h - 16h</span></li>
                        <li class="flex justify-between"><span>Domingo</span><span>Fechado</span></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-6 text-center text-xs text-gray-500">
                &copy; {{ date('Y') }} Studio de Unhas • Feito com <i class="fas fa-heart text-pink-500"></i> para realçar sua beleza
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>



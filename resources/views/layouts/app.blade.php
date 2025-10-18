<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Studio de Unhas')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            color-scheme: light;
            --purple-dark: #5B21B6;
            --purple-darker: #4C1D95;
            --purple-medium: #7C3AED;
            --purple-light: #A78BFA;
            --pink-medium: #EC4899;
            --pink-light: #F472B6;
            --text-dark: #1F2937;
            --text-medium: #4B5563;
            --text-light: #6B7280;
            --header-bg: #5B21B6;
            --footer-bg: #F8FAFC;
        }

        body {
            background-color: #FFFFFF;
            color: var(--text-dark);
        }

        /* Main Layout Variables - CENTRALIZE TODAS AS CORES AQUI! */
        .main-header {
            background: var(--header-bg);
        }

        .main-footer {
            background: var(--footer-bg);
        }

        .nav-link {
            color: white;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        /* EXEMPLOS DE USO:
         * Para alterar cores do header: modifique --header-bg
         * Para alterar cores do footer: modifique --footer-bg
         * Para alterar cores dos links: modifique as propriedades .nav-link
         */
    </style>
</head>
<body class="min-h-screen font-sans text-[#374151] bg-white">
    <header class="relative shadow-lg main-header">
        <div class="absolute inset-0 bg-gradient-to-r from-[#8B5CF6] via-[#A78BFA] to-[#F472B6] opacity-95"></div>
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1500835556837-99ac94a94552?auto=format&fit=crop&w=1400&q=80')] opacity-10 mix-blend-screen"></div>
        <div class="relative max-w-7xl mx-auto flex items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 text-white text-2xl shadow-lg backdrop-blur">
                    <i class="fas fa-spa"></i>
                </span>
                <div class="leading-tight">
                    <p class="text-white text-lg font-semibold tracking-wide uppercase">Studio de Unhas</p>
                    <p class="text-white/90 text-sm">Beleza, cuidado e autoamor</p>
                </div>
            </a>
            <nav class="hidden md:flex items-center gap-2 text-sm font-medium">
                <a href="{{ route('home') }}" class="nav-link px-4 py-2 rounded-full">Início</a>
                <a href="{{ route('appointments.create') }}" class="nav-link px-4 py-2 rounded-full">Agendar</a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="nav-link px-4 py-2 rounded-full">Painel Admin</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="nav-link px-4 py-2 rounded-full">Sair</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link px-4 py-2 rounded-full">Entrar</a>
                @endauth
            </nav>
            <button id="mobile-toggle" class="md:hidden text-white text-2xl" aria-label="Abrir menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <nav id="mobile-menu" class="md:hidden hidden border-t border-white/10 bg-[#8B5CF6]/95 backdrop-blur">
            <div class="px-4 py-4 space-y-3 text-sm font-medium text-white">
                <a href="{{ route('home') }}" class="block rounded-lg px-4 py-3 bg-[#6B46C1] text-white">Início</a>
                <a href="{{ route('appointments.create') }}" class="block rounded-lg px-4 py-3 hover:bg-[#6B46C1] transition">Agendar</a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-4 py-3 hover:bg-[#6B46C1] transition">Painel Admin</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left rounded-lg px-4 py-3 hover:bg-[#6B46C1] transition">Sair</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block rounded-lg px-4 py-3 hover:bg-[#6B46C1] transition">Entrar</a>
                @endauth
            </div>
        </nav>
    </header>

    @if(session('success'))
        <div class="max-w-3xl mx-auto mt-6 px-4">
            <div class="rounded-2xl bg-white shadow ring-1 ring-[#8B5CF6]/50 p-4 text-sm text-[#6B7280] flex items-start gap-3">
                <span class="text-lg text-[#8B5CF6]">
                    <i class="fas fa-check-circle"></i>
                </span>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-3xl mx-auto mt-6 px-4">
            <div class="rounded-2xl bg-white shadow ring-1 ring-red-200/70 p-4 text-sm text-red-700 flex items-start gap-3">
                <span class="text-lg">
                    <i class="fas fa-circle-exclamation"></i>
                </span>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <main class="py-12 md:py-16">
        @yield('content')
    </main>

    <footer class="relative overflow-hidden main-footer text-[#374151]">
        <div class="absolute inset-0 bg-gradient-to-br from-[#8B5CF6]/20 via-transparent to-[#F472B6]/15"></div>
        <div class="absolute -right-16 -top-24 h-56 w-56 rounded-full bg-[#8B5CF6]/15 blur-3xl"></div>
        <div class="absolute -left-10 bottom-0 h-40 w-40 rounded-full bg-[#F472B6]/20 blur-3xl"></div>
        <div class="relative max-w-7xl mx-auto px-6 py-10 lg:py-14">
            <div class="grid gap-10 md:grid-cols-3">
                <div>
                    <h3 class="text-lg font-semibold text-[#8B5CF6] tracking-wide uppercase">Studio de Unhas</h3>
                    <p class="mt-4 text-sm text-[#6B7280] leading-relaxed">Experiência premium em manicure, pedicure e alongamentos. Ambiente acolhedor, profissionais talentosos e produtos de alta qualidade.</p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-[#8B5CF6] uppercase tracking-wide">Contato</h4>
                    <ul class="mt-4 space-y-3 text-sm text-[#6B7280]">
                        <li class="flex items-center gap-3">
                            <span class="text-[#8B5CF6]"><i class="fas fa-phone"></i></span>
                            <span>(11) 99999-9999</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-[#8B5CF6]"><i class="fas fa-envelope"></i></span>
                            <span>contato@studiounhas.com</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-[#8B5CF6]"><i class="fas fa-map-marker-alt"></i></span>
                            <span>Rua das Rosas, 123 - Centro</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-[#8B5CF6] uppercase tracking-wide">Horário de funcionamento</h4>
                    <ul class="mt-4 space-y-2 text-sm text-[#6B7280]">
                        <li class="flex justify-between"><span>Segunda a Sexta</span><span>09h - 18h</span></li>
                        <li class="flex justify-between"><span>Sábado</span><span>09h - 16h</span></li>
                        <li class="flex justify-between"><span>Domingo</span><span>Fechado</span></li>
                    </ul>
                </div>
            </div>
            <div class="mt-10 border-t border-[#8B5CF6]/30 pt-6 text-center text-xs text-[#9CA3AF] tracking-wide">
                &copy; {{ date('Y') }} Studio de Unhas • Criado com ♥ para realçar sua beleza
            </div>
        </div>
    </footer>

    <script>
        const mobileToggle = document.getElementById('mobile-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileToggle && mobileMenu) {
            mobileToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.add('px-4','py-2','rounded-full','text-white','hover:bg-white/20','transition','duration-200','ring-1','ring-white/0','hover:ring-white/40');
        });
    </script>

    @stack('scripts')
</body>
</html>



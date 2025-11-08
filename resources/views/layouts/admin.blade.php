<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Studio de Unhas')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --purple-dark: #6B46C1;
            --purple-medium: #8B5CF6;
            --purple-light: #A78BFA;
            --pink-medium: #EC4899;
            --pink-light: #F472B6;
            --text-dark: #374151;
            --text-medium: #6B7280;
            --text-light: #9CA3AF;
            --sidebar-bg: #F8FAFC;
            --sidebar-bg-gradient: linear-gradient(180deg, #F8FAFC 0%, #F1F5F9 100%);
            --sidebar-text: #475569;
            --sidebar-hover: rgba(148, 163, 184, 0.1);
            --sidebar-hover-text: #1E293B;
            --sidebar-active: rgba(139, 92, 246, 0.1);
        }

        body {
            background-color: #FFFFFF;
            color: var(--text-dark);
        }

        /* Sidebar Styles - MENU LATERAL MODERNO */
        .admin-sidebar {
            background: var(--sidebar-bg-gradient);
            color: var(--sidebar-text);
            border-right: 1px solid #E2E8F0;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.04);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 40;
        }

        .admin-sidebar .sidebar-header {
            background: white;
            border-radius: 0.75rem;
            margin: 1rem;
            padding: 1rem;
            text-align: center;
            border: 1px solid #E2E8F0;
        }

        .admin-sidebar .sidebar-logo {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #8B5CF6;
        }

        .admin-sidebar .sidebar-title {
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 0.025em;
            color: #475569;
        }

        .admin-sidebar .nav-section {
            margin: 2rem 0;
        }

        .admin-sidebar .nav-item {
            margin: 0.25rem 1rem;
            border-radius: 0.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .admin-sidebar .nav-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s ease;
        }

        .admin-sidebar .nav-item:hover::before {
            left: 100%;
        }

        .admin-sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 0.875rem;
            color: var(--sidebar-text);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.8125rem;
            border-radius: 0.5rem;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .admin-sidebar .nav-link:hover {
            background: var(--sidebar-hover);
            color: var(--sidebar-hover-text);
        }

        .admin-sidebar .nav-link.active {
            background: var(--sidebar-active);
            color: #8B5CF6;
            font-weight: 600;
        }

        .admin-sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 70%;
            background: #8B5CF6;
            border-radius: 0 2px 2px 0;
        }

        /* Responsividade para mobile */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                width: 280px;
                border-radius: 0;
            }

            .admin-sidebar.mobile-open {
                transform: translateX(0);
            }

            .admin-sidebar .sidebar-header {
                margin: 1rem;
                padding: 1rem;
            }

            .admin-sidebar .nav-item {
                margin: 0.125rem 0.5rem;
            }

            .admin-sidebar .nav-link {
                padding: 0.75rem 0.75rem;
                font-size: 0.875rem;
            }
        }

        .admin-sidebar .nav-icon {
            width: 1rem;
            height: 1rem;
            flex-shrink: 0;
            font-size: 0.875rem;
        }

        .admin-sidebar .nav-text {
            font-size: 0.8125rem;
            font-weight: 500;
        }

        .admin-sidebar .nav-separator {
            height: 1px;
            background: #E2E8F0;
            margin: 0.75rem 1rem;
            border-radius: 1px;
        }

        .admin-sidebar .nav-footer {
            margin-top: auto;
            padding: 1rem;
        }

        /* Admin Theme Variables - CENTRALIZE TODAS AS CORES AQUI! */
        .admin-card {
            background: white;
            border: 1px solid var(--purple-light);
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(139, 92, 246, 0.1);
        }

        .admin-button-primary {
            background: linear-gradient(135deg, var(--purple-medium) 0%, var(--purple-dark) 100%);
            color: white;
            border: none;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .admin-button-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .admin-button-secondary {
            background: var(--text-light);
            color: white;
            border: none;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .admin-button-secondary:hover {
            background: var(--text-medium);
        }

        .admin-text-primary {
            color: var(--text-dark);
        }

        .admin-text-secondary {
            color: var(--text-medium);
        }

        .admin-text-muted {
            color: var(--text-light);
        }

        .admin-border {
            border-color: var(--purple-light);
        }

        .admin-bg-light {
            background-color: #FAFAFA;
        }

        /* Mobile Overlay */
        .mobile-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 30;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .mobile-overlay.active {
            display: block;
            opacity: 1;
        }

        /* EXEMPLOS DE USO:
         * Para alterar cores do menu: modifique --sidebar-bg, --sidebar-text, etc.
         * Para alterar cores de botões: modifique --purple-medium, --purple-dark
         * Para alterar cores de texto: modifique --text-dark, --text-medium, etc.
         * Para alterar cores de cards: modifique --purple-light
         */
    </style>
</head>
<body class="bg-white text-[#374151]" x-data="{ sidebarOpen: false }">
    <!-- Mobile Overlay -->
    <div class="mobile-overlay" :class="{ 'active': sidebarOpen }" @click="sidebarOpen = false"></div>

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="admin-sidebar w-64 flex flex-col" :class="{ 'mobile-open': sidebarOpen }">


            <!-- Menu Principal -->
            <nav class="flex-1 px-4">
                <div class="nav-section">
                    <div class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </div>

                    <div class="nav-item">
                        <a href="{{ route('admin.appointments.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <span class="nav-text">Agendamentos</span>
                        </a>
                    </div>

                    <div class="nav-item">
                        <a href="{{ route('admin.appointments.manage') }}" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <span class="nav-text">Confirmar/Finalizar</span>
                        </a>
                    </div>
                </div>

                <div class="nav-separator"></div>

                <div class="nav-section">
                    <div class="nav-item">
                        <a href="{{ route('admin.services.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-concierge-bell"></i>
                            <span class="nav-text">Serviços</span>
                        </a>
                    </div>

                    <div class="nav-item">
                        <a href="{{ route('admin.stock.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-boxes"></i>
                            <span class="nav-text">Estoque</span>
                        </a>
                    </div>

                    <div class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <span class="nav-text">Usuários</span>
                        </a>
                    </div>
                </div>

                <div class="nav-separator"></div>

                <div class="nav-section">
                    <div class="nav-item">
                        <a href="{{ route('admin.cashflow.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-money-bill-wave"></i>
                            <span class="nav-text">Fluxo de Caixa</span>
                        </a>
                    </div>

                    <div class="nav-item">
                        <a href="{{ route('admin.cashflow.daily-report') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice-dollar"></i>
                            <span class="nav-text">Fechamento Diário</span>
                        </a>
                    </div>
                </div>

                <div class="nav-separator"></div>

                <!-- Links Externos -->
                <div class="nav-section">
                    <div class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <span class="nav-text">Site</span>
                        </a>
                    </div>

                    <div class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                            <button type="submit" class="nav-link w-full text-left">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span class="nav-text">Sair</span>
                    </button>
                </form>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden md:ml-64">
            <!-- Top bar -->
            <header class="bg-white shadow sticky top-0 z-20">
                <div class="px-4 md:px-6 py-3 md:py-4 flex flex-col gap-3">
                    <div class="flex justify-between items-center">
                        <!-- Mobile Menu Button -->
                        <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded-lg hover:bg-gray-100 text-gray-600">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        
                        <h1 class="text-lg md:text-2xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                        <div class="flex items-center gap-2 md:gap-4">
                            <a href="{{ route('admin.appointments.manage') }}" class="relative inline-flex items-center gap-1 md:gap-2 rounded-full border border-[#8B5CF6]/40 px-2 md:px-4 py-1.5 md:py-2 text-xs md:text-sm font-semibold text-[#7C3AED] hover:bg-[#F3E8FF]">
                                <i class="fas fa-bell"></i>
                                <span class="hidden sm:inline">Alertas</span>
                                @php
                                    $totalAlerts = ($alertPendingCount ?? 0) + ($alertConfirmedCount ?? 0);
                                @endphp
                                <span class="inline-flex items-center justify-center h-5 w-5 md:h-6 md:w-6 rounded-full bg-[#F87171] text-white text-xs font-bold">
                                    {{ $totalAlerts }}
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-3 text-xs">
                        <div class="flex items-center gap-2 md:gap-3 rounded-xl md:rounded-2xl border border-[#F59E0B]/40 bg-[#FEF3C7] px-3 md:px-4 py-2 md:py-3 text-[#B45309]">
                            <span class="inline-flex h-6 w-6 md:h-8 md:w-8 items-center justify-center rounded-full bg-[#FDE68A] text-[#B45309]"><i class="fas fa-clock text-xs md:text-sm"></i></span>
                            <div>
                                <p class="font-semibold uppercase tracking-wide text-xs">Pendentes</p>
                                <p class="text-xs">{{ $alertPendingCount ?? 0 }} aguardando confirmação</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 md:gap-3 rounded-xl md:rounded-2xl border border-emerald-300/50 bg-emerald-50 px-3 md:px-4 py-2 md:py-3 text-emerald-700">
                            <span class="inline-flex h-6 w-6 md:h-8 md:w-8 items-center justify-center rounded-full bg-emerald-100 text-emerald-600"><i class="fas fa-check-double text-xs md:text-sm"></i></span>
                            <div>
                                <p class="font-semibold uppercase tracking-wide text-xs">Confirmados</p>
                                <p class="text-xs">{{ $alertConfirmedCount ?? 0 }} aguardando finalização</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Flash Messages -->
            <div class="px-4 md:px-6 py-4">
                @if(session('success'))
                    <div class="admin-card border-purple-300/50 text-purple-700 px-4 py-3 rounded-lg shadow-sm relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="admin-card border-red-200 text-red-700 px-4 py-3 rounded-lg shadow-sm relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="admin-card border-red-200 text-red-700 px-4 py-3 rounded-lg shadow-sm relative mb-4" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto admin-bg-light px-4 md:px-6 pb-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Destacar item ativo no menu
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.admin-sidebar .nav-link');

            navLinks.forEach(link => {
                const href = link.getAttribute('href');

                // Ativar apenas se for exatamente a rota atual
                if (href === currentPath) {
                    link.classList.add('active');
                }
                // Para páginas de agendamentos que não são a principal nem manage
                else if (href === '/admin/appointments' && currentPath.startsWith('/admin/appointments/') && !currentPath.includes('/manage')) {
                    link.classList.add('active');
                }
                // Para a página de confirmar/finalizar agendamentos
                else if (href === '/admin/appointments/manage' && currentPath === '/admin/appointments/manage') {
                    link.classList.add('active');
                }
            });

            // Efeito de shimmer no hover
            const navItems = document.querySelectorAll('.admin-sidebar .nav-item');
            navItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(4px)';
                });

                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });

            // Fechar sidebar ao clicar em um link no mobile
            const sidebarLinks = document.querySelectorAll('.admin-sidebar .nav-link');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        // Trigger Alpine.js to close sidebar
                        const event = new CustomEvent('close-sidebar');
                        document.dispatchEvent(event);
                    }
                });
            });

            // Listen for close-sidebar event
            document.addEventListener('close-sidebar', function() {
                // This will be handled by Alpine.js
                const body = document.querySelector('body');
                if (body.__x) {
                    body.__x.$data.sidebarOpen = false;
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Studio de Unhas')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            --sidebar-bg: #8B5CF6;
            --sidebar-bg-gradient: linear-gradient(135deg, #8B5CF6 0%, #6B46C1 100%);
            --sidebar-text: #FFFFFF;
            --sidebar-hover: rgba(255, 255, 255, 0.2);
            --sidebar-hover-text: #FFFFFF;
            --sidebar-active: rgba(255, 255, 255, 0.3);
        }

        body {
            background-color: #FFFFFF;
            color: var(--text-dark);
        }

        /* Sidebar Styles - MENU LATERAL MODERNO */
        .admin-sidebar {
            background: var(--sidebar-bg-gradient);
            color: var(--sidebar-text);
            border-radius: 0 1.5rem 1.5rem 0;
            box-shadow: 0 10px 25px -5px rgba(139, 92, 246, 0.1), 0 10px 10px -5px rgba(139, 92, 246, 0.04);
        }

        .admin-sidebar .sidebar-header {
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            border-radius: 1rem;
            margin: 1.5rem;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .admin-sidebar .sidebar-logo {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .admin-sidebar .sidebar-title {
            font-size: 1.125rem;
            font-weight: 700;
            letter-spacing: 0.05em;
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
            padding: 0.875rem 1rem;
            color: var(--sidebar-text);
            text-decoration: none;
            font-weight: 500;
            border-radius: 0.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .admin-sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
        }

        .admin-sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .admin-sidebar .nav-link.active::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 2px 0 0 2px;
        }

        /* Responsividade para mobile */
        @media (max-width: 768px) {
            .admin-sidebar {
                width: 280px;
                border-radius: 0;
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

        .admin-sidebar .nav-icon {
            width: 1.25rem;
            height: 1.25rem;
            flex-shrink: 0;
        }

        .admin-sidebar .nav-text {
            font-size: 0.875rem;
            font-weight: 500;
        }

        .admin-sidebar .nav-separator {
            height: 1px;
            background: rgba(255, 255, 255, 0.2);
            margin: 1rem 1.5rem;
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

        /* EXEMPLOS DE USO:
         * Para alterar cores do menu: modifique --sidebar-bg, --sidebar-text, etc.
         * Para alterar cores de botões: modifique --purple-medium, --purple-dark
         * Para alterar cores de texto: modifique --text-dark, --text-medium, etc.
         * Para alterar cores de cards: modifique --purple-light
         */
    </style>
</head>
<body class="bg-white text-[#374151]">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="admin-sidebar w-64 min-h-screen flex flex-col absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-all duration-300 ease-in-out shadow-2xl">

            <!-- Header do Sidebar -->
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="fas fa-spa text-white"></i>
                </div>
                <div class="sidebar-title text-white">Admin Panel</div>
            </div>

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
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top bar -->
            <header class="bg-white shadow">
                <div class="px-6 py-4 flex flex-col gap-3">
                    <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.appointments.manage') }}" class="relative inline-flex items-center gap-2 rounded-full border border-[#8B5CF6]/40 px-4 py-2 text-sm font-semibold text-[#7C3AED] hover:bg-[#F3E8FF]">
                                <i class="fas fa-bell"></i>
                                Alertas
                                @php
                                    $totalAlerts = ($alertPendingCount ?? 0) + ($alertConfirmedCount ?? 0);
                                @endphp
                                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-[#F87171] text-white text-xs font-bold">
                                    {{ $totalAlerts }}
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 text-xs">
                        <div class="flex items-center gap-3 rounded-2xl border border-[#F59E0B]/40 bg-[#FEF3C7] px-4 py-3 text-[#B45309]">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-[#FDE68A] text-[#B45309]"><i class="fas fa-clock"></i></span>
                            <div>
                                <p class="font-semibold uppercase tracking-wide">Pendentes</p>
                                <p>{{ $alertPendingCount ?? 0 }} agendamento(s) aguardando confirmação</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 rounded-2xl border border-emerald-300/50 bg-emerald-50 px-4 py-3 text-emerald-700">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-emerald-600"><i class="fas fa-check-double"></i></span>
                            <div>
                                <p class="font-semibold uppercase tracking-wide">Confirmados</p>
                                <p>{{ $alertConfirmedCount ?? 0 }} aguardando finalização</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Flash Messages -->
            <div class="px-6 py-4">
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
            <main class="flex-1 overflow-x-hidden overflow-y-auto admin-bg-light px-6 pb-6">
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
        });
    </script>

    @stack('scripts')
</body>
</html>



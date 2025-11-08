@extends('layouts.app')

@section('title', 'Studio de Unhas - Serviços de Manicure e Pedicure')

@section('content')
<!-- Hero Section - Compact & Modern -->
<section class="relative bg-gradient-to-br from-purple-50 via-white to-pink-50 py-12 overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiM5MzMzZWEiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE2YzAtMi4yMSAxLjc5LTQgNC00czQgMS43OSA0IDQtMS43OSA0LTQgNC00LTEuNzktNC00em0wIDI0YzAtMi4yMSAxLjc5LTQgNC00czQgMS43OSA0IDQtMS43OSA0LTQgNC00LTEuNzktNC00ek0xMiAxNmMwLTIuMjEgMS43OS00IDQtNHM0IDEuNzkgNCA0LTEuNzkgNC00IDQtNC0xLjc5LTQtNHptMCAyNGMwLTIuMjEgMS43OS00IDQtNHM0IDEuNzkgNCA0LTEuNzkgNC00IDQtNC0xLjc5LTQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-3">
                Beleza e <span class="text-gradient">Bem-Estar</span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Serviços profissionais de manicure e pedicure em ambiente acolhedor</p>
        </div>

        <!-- Promo Card - Compact -->
        <div class="max-w-4xl mx-auto">
            <div class="card overflow-hidden">
                <div class="md:flex items-center">
                    <div class="md:w-1/3 bg-gradient-to-br from-purple-600 to-pink-600 p-6 text-white text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-3">
                            <i class="fas fa-star text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-1">Combo Especial</h3>
                        <div class="text-3xl font-bold mt-3">R$ 89,90</div>
                        <p class="text-sm text-purple-100 mt-1">Manicure + Pedicure</p>
                    </div>
                    <div class="md:w-2/3 p-6">
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div class="flex items-center gap-2 text-sm text-gray-700">
                                <i class="fas fa-check-circle text-purple-600"></i>
                                <span>Manicure completa</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-700">
                                <i class="fas fa-check-circle text-purple-600"></i>
                                <span>Pedicure profunda</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-700">
                                <i class="fas fa-check-circle text-purple-600"></i>
                                <span>Produtos premium</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-700">
                                <i class="fas fa-check-circle text-purple-600"></i>
                                <span>Ambiente relaxante</span>
                            </div>
                        </div>
                        <a href="{{ route('appointments.create') }}" class="btn-primary w-full justify-center">
                            <i class="fas fa-calendar-check"></i>
                            Agendar Combo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section - Compact Grid -->
<section class="py-12 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="section-title">Nossos Serviços</h2>
            <p class="text-gray-600">Escolha o serviço ideal para você</p>
        </div>

        @if($services->isEmpty())
            <div class="text-center py-12">
                <i class="fas fa-spa text-5xl text-purple-300 mb-3"></i>
                <p class="text-gray-600">Em breve, nossos serviços estarão disponíveis!</p>
            </div>
        @else
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($services as $service)
                    <div class="card p-5 group hover:border-purple-200" x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                        <div class="flex items-start gap-4 mb-3">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-spa text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-gray-900 mb-1 truncate">{{ $service->name }}</h3>
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="font-bold text-purple-600">R$ {{ number_format($service->price, 2, ',', '.') }}</span>
                                    <span class="text-gray-400">•</span>
                                    <span class="text-gray-500">{{ $service->duration_minutes }}min</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $service->description }}</p>
                        <a href="{{ route('appointments.create', ['service_id' => $service->id]) }}" class="btn-primary w-full justify-center text-sm py-2">
                            <i class="fas fa-calendar-check"></i>
                            Agendar
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Contact Section - Compact -->
<section class="py-10 bg-gray-50 border-t border-gray-200">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Agende Agora</h2>
            <p class="text-gray-600">Entre em contato ou agende online</p>
        </div>

        <div class="grid md:grid-cols-2 gap-4 max-w-3xl mx-auto mb-8">
            <a href="tel:+5511999999999" class="card p-5 hover:border-purple-200 text-center group">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-phone text-white"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Ligar Agora</h3>
                <p class="text-sm text-gray-600">(11) 99999-9999</p>
            </a>

            <a href="{{ route('appointments.create') }}" class="card p-5 hover:border-purple-200 text-center group">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-pink-500 to-pink-600 rounded-full mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-calendar-check text-white"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Agendar Online</h3>
                <p class="text-sm text-gray-600">Rápido e fácil</p>
            </a>
        </div>

        <!-- Info Cards - Compact -->
        <div class="grid grid-cols-3 gap-4 max-w-3xl mx-auto">
            <div class="text-center">
                <i class="fas fa-clock text-purple-500 text-xl mb-2"></i>
                <p class="font-semibold text-gray-900 text-xs mb-1">Horário</p>
                <p class="text-xs text-gray-600">Seg-Sáb<br>09h-18h</p>
            </div>
            <div class="text-center">
                <i class="fas fa-map-marker-alt text-purple-500 text-xl mb-2"></i>
                <p class="font-semibold text-gray-900 text-xs mb-1">Localização</p>
                <p class="text-xs text-gray-600">Rua das Rosas<br>123 - Centro</p>
            </div>
            <div class="text-center">
                <i class="fas fa-heart text-purple-500 text-xl mb-2"></i>
                <p class="font-semibold text-gray-900 text-xs mb-1">Atendimento</p>
                <p class="text-xs text-gray-600">Personalizado<br>e humanizado</p>
            </div>
        </div>
    </div>
</section>
@endsection



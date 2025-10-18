@extends('layouts.app')

@section('title', 'Studio de Unhas - Serviços de Manicure e Pedicure')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-20">
    <!-- Promoção da Semana -->
    <section class="py-16 bg-gradient-to-r from-purple-50 to-pink-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-purple-100">
                <div class="md:flex">
                    <div class="md:w-1/3 bg-gradient-to-br from-purple-600 to-purple-700 p-8 text-white text-center flex flex-col justify-center">
                        <div class="mb-4">
                            <i class="fas fa-star text-4xl mb-2"></i>
                            <h3 class="text-2xl font-bold mb-2">Promoção da Semana</h3>
                            <p class="text-purple-100">Combo Especial</p>
                        </div>
                        <div class="bg-white/20 rounded-2xl p-4">
                            <div class="text-3xl font-bold mb-1">R$ 89,90</div>
                            <div class="text-sm opacity-90">Manicure + Pedicure</div>
                        </div>
                    </div>
                    <div class="md:w-2/3 p-8">
                        <h4 class="text-2xl font-bold text-slate-900 mb-4">Combo Completo</h4>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-purple-600"></i>
                                <span class="text-slate-700">Manicure completa com esmaltação</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-purple-600"></i>
                                <span class="text-slate-700">Pedicure com hidratação profunda</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-purple-600"></i>
                                <span class="text-slate-700">Produtos premium inclusos</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-purple-600"></i>
                                <span class="text-slate-700">Ambiente climatizado e música relaxante</span>
                            </li>
                        </ul>
                        <div class="text-center">
                            <a href="{{ route('appointments.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transition-all duration-300">
                                <i class="fas fa-calendar-check"></i>
                                Agendar Combo Especial
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Serviços em Destaque -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold text-slate-900 mb-6">Nossos Serviços</h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto">Cuidado completo e profissional para suas unhas</p>
        </div>

        @if($services->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-spa text-6xl text-purple-300 mb-4"></i>
                    <p class="text-slate-600 text-lg">Em breve, nossos serviços estarão disponíveis!</p>
            </div>
        @else
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($services as $service)
                        <div class="bg-slate-50 rounded-2xl p-8 shadow-sm hover:shadow-lg transition-all duration-300 border border-slate-200 group">
                            <div class="text-center mb-6">
                                <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-spa text-white text-2xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 mb-3">{{ $service->name }}</h3>
                                <div class="flex items-center justify-center gap-3 text-purple-600 mb-4">
                                    <span class="text-2xl font-bold">R$ {{ number_format($service->price, 2, ',', '.') }}</span>
                                    <span class="text-sm bg-purple-100 px-3 py-1 rounded-full">{{ $service->duration_minutes }}min</span>
                        </div>
                        </div>

                            <p class="text-slate-600 text-center mb-6 leading-relaxed">{{ Str::limit($service->description, 120) }}</p>

                            <div class="text-center">
                                <a href="{{ route('appointments.create', ['service_id' => $service->id]) }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold py-3 px-6 rounded-full transition-all duration-300 hover:scale-105 shadow-lg">
                                    <i class="fas fa-calendar-check"></i>
                                    Agendar Agora
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        </div>
    </section>

    <!-- Contato Rápido -->
    <section class="py-16 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-8">Agende seu horário</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-phone text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-2">Telefone</h3>
                    <p class="text-slate-600 mb-4">(11) 99999-9999</p>
                    <a href="tel:+5511999999999" class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-6 rounded-full transition-all duration-300 shadow-lg">
                        <i class="fas fa-phone"></i>
                        Ligar Agora
                    </a>
                        </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-calendar-check text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-2">Agendamento Online</h3>
                    <p class="text-slate-600 mb-4">Rápido e fácil</p>
                    <a href="{{ route('appointments.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-calendar-check"></i>
                        Agendar Online
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-slate-600">
                <div class="text-center">
                    <i class="fas fa-clock text-xl text-purple-400 mb-2 block"></i>
                    <p class="font-semibold text-slate-900 text-sm">Horário Flexível</p>
                    <p class="text-sm">Segunda a sábado<br>09h às 18h</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-map-marker-alt text-xl text-purple-400 mb-2 block"></i>
                    <p class="font-semibold text-slate-900 text-sm">Localização</p>
                    <p class="text-sm">Centro<br>Rua das Rosas, 123</p>
        </div>
                <div class="text-center">
                    <i class="fas fa-heart text-xl text-purple-400 mb-2 block"></i>
                    <p class="font-semibold text-slate-900 text-sm">Atendimento</p>
                    <p class="text-sm">Personalizado e<br>humanizado</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection



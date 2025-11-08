@extends('layouts.app')

@section('title', 'Studio de Unhas - Serviços de Manicure e Pedicure')

@section('content')
<!-- Hero Section - Professional & Clean -->
<section class="relative bg-white py-20 overflow-hidden">
    <!-- Subtle background pattern -->
    <div class="absolute inset-0 opacity-[0.02]" style="background-image: radial-gradient(circle at 1px 1px, #9333ea 1px, transparent 0); background-size: 40px 40px;"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="text-center lg:text-left">
                <div class="inline-block mb-4">
                    <span class="px-4 py-2 bg-purple-50 text-purple-700 rounded-full text-sm font-semibold">
                        ✨ Beleza & Bem-Estar
                    </span>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                    Suas unhas<br>
                    <span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                        perfeitas
                    </span>
                </h1>
                <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                    Serviços profissionais de manicure e pedicure com produtos de alta qualidade em ambiente acolhedor e relaxante.
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('appointments.create') }}" class="inline-flex items-center justify-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-8 py-4 rounded-xl font-semibold text-lg shadow-lg shadow-purple-600/30 transition-all hover:scale-105">
                        <i class="fas fa-calendar-check"></i>
                        Agendar Horário
                    </a>
                    <a href="#servicos" class="inline-flex items-center justify-center gap-2 bg-white hover:bg-gray-50 text-gray-900 px-8 py-4 rounded-xl font-semibold text-lg border-2 border-gray-200 transition-all">
                        Ver Serviços
                        <i class="fas fa-arrow-down text-sm"></i>
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="grid grid-cols-3 gap-6 mt-12 pt-8 border-t border-gray-100">
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-bold text-purple-600 mb-1">500+</div>
                        <div class="text-sm text-gray-600">Clientes Felizes</div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-bold text-purple-600 mb-1">5★</div>
                        <div class="text-sm text-gray-600">Avaliação Média</div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="text-3xl font-bold text-purple-600 mb-1">100%</div>
                        <div class="text-sm text-gray-600">Satisfação</div>
                    </div>
                </div>
            </div>

            <!-- Right Content - Feature Card -->
            <div class="relative">
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-3xl p-8 shadow-xl border border-purple-100">
                    <div class="bg-white rounded-2xl p-6 mb-6 shadow-sm">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-600 to-pink-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-star text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Combo Especial</h3>
                                <p class="text-sm text-gray-600">Manicure + Pedicure</p>
                            </div>
                        </div>
                        <div class="flex items-baseline gap-2 mb-6">
                            <span class="text-4xl font-bold text-purple-600">R$ 89,90</span>
                            <span class="text-lg text-gray-400 line-through">R$ 120,00</span>
                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">-25%</span>
                        </div>
                        <a href="{{ route('appointments.create') }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-white text-center py-3 rounded-xl font-semibold transition-colors">
                            Agendar Combo
                        </a>
                    </div>

                    <!-- Benefits -->
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-gray-700">
                            <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-check text-purple-600 text-xs"></i>
                            </div>
                            <span class="text-sm">Produtos de alta qualidade</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700">
                            <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-check text-purple-600 text-xs"></i>
                            </div>
                            <span class="text-sm">Profissionais experientes</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700">
                            <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-check text-purple-600 text-xs"></i>
                            </div>
                            <span class="text-sm">Ambiente higienizado e relaxante</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700">
                            <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-check text-purple-600 text-xs"></i>
                            </div>
                            <span class="text-sm">Agendamento online fácil</span>
                        </div>
                    </div>
                </div>
                
                <!-- Floating badge -->
                <div class="absolute -top-4 -right-4 bg-gradient-to-br from-pink-500 to-purple-600 text-white px-6 py-3 rounded-full shadow-lg transform rotate-12">
                    <div class="text-center transform -rotate-12">
                        <div class="text-xs font-semibold">Promoção</div>
                        <div class="text-lg font-bold">Limitada</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section - Professional Grid -->
<section id="servicos" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block mb-4">
                <span class="px-4 py-2 bg-purple-50 text-purple-700 rounded-full text-sm font-semibold">
                    💅 Nossos Serviços
                </span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Escolha o serviço <span class="text-purple-600">ideal</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Oferecemos uma variedade de serviços profissionais para cuidar da beleza das suas unhas
            </p>
        </div>

        @if($services->isEmpty())
            <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                <div class="w-20 h-20 bg-purple-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-spa text-3xl text-purple-400"></i>
                </div>
                <p class="text-lg text-gray-600">Em breve, nossos serviços estarão disponíveis!</p>
            </div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($services as $service)
                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-purple-200 group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-600 to-pink-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-spa text-white text-xl"></i>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-purple-600">R$ {{ number_format($service->price, 2, ',', '.') }}</div>
                                <div class="text-sm text-gray-500 flex items-center gap-1 justify-end mt-1">
                                    <i class="fas fa-clock text-xs"></i>
                                    {{ $service->duration_minutes }}min
                                </div>
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $service->name }}</h3>
                        <p class="text-gray-600 mb-6 line-clamp-2 min-h-[3rem]">{{ $service->description }}</p>
                        
                        <a href="{{ route('appointments.create', ['service_id' => $service->id]) }}" 
                           class="block w-full bg-purple-600 hover:bg-purple-700 text-white text-center py-3 rounded-xl font-semibold transition-colors">
                            Agendar Agora
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Contact Section - Professional -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-purple-600 to-pink-600 rounded-3xl p-8 md:p-12 text-white relative overflow-hidden">
            <!-- Background decoration -->
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;"></div>
            
            <div class="relative grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">
                        Pronta para transformar suas unhas?
                    </h2>
                    <p class="text-lg text-purple-100 mb-8">
                        Agende seu horário agora e experimente o melhor em cuidados com as unhas
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('appointments.create') }}" 
                           class="inline-flex items-center justify-center gap-2 bg-white text-purple-600 hover:bg-gray-50 px-6 py-3 rounded-xl font-semibold transition-colors">
                            <i class="fas fa-calendar-check"></i>
                            Agendar Online
                        </a>
                        <a href="tel:+5511999999999" 
                           class="inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-semibold border-2 border-white/30 transition-colors">
                            <i class="fas fa-phone"></i>
                            (11) 99999-9999
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-lg mb-2">Horário</h3>
                        <p class="text-purple-100 text-sm">Segunda a Sábado<br>09:00 - 18:00</p>
                    </div>
                    
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-map-marker-alt text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-lg mb-2">Localização</h3>
                        <p class="text-purple-100 text-sm">Rua das Rosas, 123<br>Centro</p>
                    </div>
                    
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-shield-alt text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-lg mb-2">Segurança</h3>
                        <p class="text-purple-100 text-sm">Ambiente 100%<br>higienizado</p>
                    </div>
                    
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-heart text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-lg mb-2">Atendimento</h3>
                        <p class="text-purple-100 text-sm">Personalizado<br>e humanizado</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer CTA -->
<section class="py-12 bg-gray-50 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-gray-600 mb-4">Siga-nos nas redes sociais</p>
        <div class="flex items-center justify-center gap-4">
            <a href="#" class="w-12 h-12 bg-white hover:bg-purple-50 rounded-full flex items-center justify-center text-gray-600 hover:text-purple-600 transition-colors shadow-sm">
                <i class="fab fa-instagram text-xl"></i>
            </a>
            <a href="#" class="w-12 h-12 bg-white hover:bg-purple-50 rounded-full flex items-center justify-center text-gray-600 hover:text-purple-600 transition-colors shadow-sm">
                <i class="fab fa-facebook text-xl"></i>
            </a>
            <a href="#" class="w-12 h-12 bg-white hover:bg-purple-50 rounded-full flex items-center justify-center text-gray-600 hover:text-purple-600 transition-colors shadow-sm">
                <i class="fab fa-whatsapp text-xl"></i>
            </a>
        </div>
    </div>
</section>
@endsection



@extends('layouts.app')

@section('title', 'AstroTech - Développement Logiciel Moderne')

@section('content')
<!-- Hero Section -->
<section id="accueil" class="pt-16 bg-gradient-to-br from-primary-50 to-accent-50 dark:from-gray-800 dark:to-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-gray-900 dark:text-white leading-tight">
                    Développement
                    <span class="text-primary-600 dark:text-primary-400">Logiciel</span>
                    <br>Moderne
                </h1>
                <p class="mt-6 text-xl text-gray-600 dark:text-gray-300 leading-relaxed">
                    Spécialisés dans le développement d'applications web, mobile et desktop. 
                    Nous transformons vos idées en solutions numériques performantes et élégantes.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="#contact" class="bg-primary-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-primary-700 transition-colors text-center">
                        Démarrer un projet
                    </a>
                    <a href="{{ route('projets') }}" class="border border-primary-600 text-primary-600 px-8 py-3 rounded-lg font-medium hover:bg-primary-50 transition-colors text-center">
                        Voir nos projets
                    </a>
                </div>
            </div>
            <div class="lg:text-right">
                    <div class="w-full max-w-lg mx-auto lg:mx-0 lg:ml-auto">
                        <lottie-player 
                            src="https://assets5.lottiefiles.com/packages/lf20_fcfjwiyb.json"
                            background="transparent" 
                            speed="1" 
                            style="width: 100%; height: 400px;" 
                            loop 
                            autoplay>
                        </lottie-player>
                    </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-20 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-display font-bold text-gray-900 dark:text-white mb-4">
                Nos Services
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                Une expertise complète pour tous vos besoins en développement logiciel
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Web Development -->
            <div class="group p-8 bg-gray-50 dark:bg-gray-700 rounded-2xl hover:bg-primary-50 dark:hover:bg-gray-600 transition-colors fade-in hover-lift">
                <div class="w-16 h-16 bg-primary-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary-200 transition-colors">
                    <img src="{{ asset('images/www.jpg') }}" alt="Développement Web" class="w-10 h-10 object-cover rounded">
                </div>
                <h3 class="text-xl font-display font-semibold text-gray-900 dark:text-white mb-3">
                    Développement Web
                </h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Sites web modernes, applications web responsives et plateformes e-commerce performantes.
                </p>
            </div>

            <!-- Mobile Development -->
            <div class="group p-8 bg-gray-50 dark:bg-gray-700 rounded-2xl hover:bg-accent-50 dark:hover:bg-gray-600 transition-colors fade-in hover-lift">
                <div class="w-16 h-16 bg-accent-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-accent-200 transition-colors">
                    <svg class="w-8 h-8 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-display font-semibold text-gray-900 dark:text-white mb-3">
                    Applications Mobile
                </h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Applications natives et cross-platform pour iOS et Android avec une expérience utilisateur optimale.
                </p>
            </div>

            <!-- Desktop Development -->
            <div class="group p-8 bg-gray-50 dark:bg-gray-700 rounded-2xl hover:bg-green-50 dark:hover:bg-gray-600 transition-colors fade-in hover-lift">
                <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-green-200 transition-colors">
                    <img src="{{ asset('images/laptop.png') }}" alt="Développement Desktop" class="w-10 h-10 object-contain">
                </div>
                <h3 class="text-xl font-display font-semibold text-gray-900 dark:text-white mb-3">
                    Applications Desktop
                </h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Logiciels de bureau performants et intuitifs pour Windows, macOS et Linux.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <h2 class="text-3xl sm:text-4xl font-display font-bold text-gray-900 dark:text-white mb-6">
                    Parlons de votre projet
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                    Prêt à transformer vos idées en réalité ? Contactez-nous pour discuter de votre projet et obtenir un devis personnalisé.
                </p>
                
                <div class="space-y-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 dark:text-white">Email</h4>
                            <p class="text-gray-600 dark:text-gray-300">ibacodeur@gmail.com</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 dark:text-white">Téléphone</h4>
                            <p class="text-gray-600 dark:text-gray-300">+223 99 97 97 06</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
                <form class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm" id="contact-form" action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="prenom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Prénom</label>
                            <input type="text" id="prenom" name="prenom" required 
                                   class="w-full px-4 py-3 border border-gray-300 bg-white text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                   value="{{ old('prenom') }}">
                            @error('prenom')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nom</label>
                            <input type="text" id="nom" name="nom" required 
                                   class="w-full px-4 py-3 border border-gray-300 bg-white text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                   value="{{ old('nom') }}">
                            @error('nom')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" id="email" name="email" required 
                               class="w-full px-4 py-3 border border-gray-300 bg-white text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                               value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-6">
                        <label for="projet" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type de projet</label>
                        <select id="projet" name="projet" required class="w-full px-4 py-3 border border-gray-300 bg-white text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            <option value="">Sélectionnez un type</option>
                            <option value="web" {{ old('projet') == 'web' ? 'selected' : '' }}>Site Web</option>
                            <option value="mobile" {{ old('projet') == 'mobile' ? 'selected' : '' }}>Application Mobile</option>
                            <option value="desktop" {{ old('projet') == 'desktop' ? 'selected' : '' }}>Application Desktop</option>
                            <option value="autre" {{ old('projet') == 'autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                        @error('projet')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Message</label>
                        <textarea id="message" name="message" rows="5" required 
                                  class="w-full px-4 py-3 border border-gray-300 bg-white text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" class="w-full bg-primary-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-primary-700 transition-colors">
                        Envoyer le message
                    </button>
                </form>

                @if(session('success'))
                    <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

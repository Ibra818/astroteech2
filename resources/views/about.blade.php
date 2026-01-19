@extends('layouts.app')

@section('title', 'À Propos - AstroTech')

@section('content')
<!-- Hero Section -->
<section class="pt-24 pb-16 bg-gradient-to-br from-primary-50 to-accent-50 dark:from-gray-800 dark:to-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl sm:text-5xl font-display font-bold text-gray-900 dark:text-white mb-6">
                À Propos d'AstroTech
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                Une entreprise passionnée par l'innovation technologique, fondée en 2025 
                avec la vision de transformer les idées en solutions numériques exceptionnelles.
            </p>
        </div>
    </div>
</section>

<!-- Story Section -->
<section class="py-20 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-3xl sm:text-4xl font-display font-bold text-gray-900 dark:text-white mb-6">
                    Notre Histoire
                </h2>
                <div class="space-y-6 text-lg text-gray-600 dark:text-gray-300">
                    <p>
                        AstroTech a été fondée en 2025 par <strong class="text-primary-600 dark:text-primary-400">Ibrahima Youba Tounkara</strong>, 
                        un développeur passionné avec une vision claire : créer des solutions logicielles 
                        qui simplifient la vie des utilisateurs tout en repoussant les limites de la technologie.
                    </p>
                    <p>
                        Forte d'une expertise technique approfondie et d'une approche centrée sur l'utilisateur, 
                        notre équipe s'engage à livrer des projets qui dépassent les attentes de nos clients.
                    </p>
                    <p>
                        Nous croyons que chaque projet est unique et mérite une attention particulière, 
                        c'est pourquoi nous adoptons une approche personnalisée pour chaque collaboration.
                    </p>
                </div>
            </div>
            <div class="relative">
                <div class="aspect-w-4 aspect-h-3 rounded-2xl overflow-hidden">
                    <img src="{{ asset('images/logo.jpeg') }}" 
                         alt="Équipe AstroTech" 
                         class="w-full h-96 object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-20 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="text-center p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-sm">
                <div class="w-16 h-16 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-display font-bold text-gray-900 dark:text-white mb-4">Notre Mission</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                    Accompagner nos clients dans leur transformation numérique en développant 
                    des solutions sur mesure, performantes et évolutives qui répondent 
                    parfaitement à leurs besoins métier.
                </p>
            </div>
            
            <div class="text-center p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-sm">
                <div class="w-16 h-16 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-display font-bold text-gray-900 dark:text-white mb-4">Notre Vision</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                    Devenir la référence en matière de développement logiciel moderne, 
                    reconnue pour notre innovation, notre expertise technique et 
                    notre capacité à anticiper les besoins de demain.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-display font-bold text-gray-900 dark:text-white mb-4">
                Nos Valeurs
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                Les principes qui guident notre travail au quotidien
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h4 class="font-display font-semibold text-gray-900 dark:text-white mb-2">Innovation</h4>
                <p class="text-gray-600 dark:text-gray-300">Toujours à la pointe des dernières technologies</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h4 class="font-display font-semibold text-gray-900 dark:text-white mb-2">Qualité</h4>
                <p class="text-gray-600 dark:text-gray-300">Excellence dans chaque ligne de code</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h4 class="font-display font-semibold text-gray-900 dark:text-white mb-2">Collaboration</h4>
                <p class="text-gray-600 dark:text-gray-300">Partenariat étroit avec nos clients</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h4 class="font-display font-semibold text-gray-900 dark:text-white mb-2">Réactivité</h4>
                <p class="text-gray-600 dark:text-gray-300">Réponse rapide et adaptée aux besoins</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-display font-bold mb-6">
            Prêt à démarrer votre projet ?
        </h2>
        <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
            Discutons de vos besoins et transformons vos idées en réalité numérique
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}#contact" class="bg-primary-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-primary-700 transition-colors">
                Nous contacter
            </a>
            <a href="{{ route('projets') }}" class="border border-white text-white px-8 py-3 rounded-lg font-medium hover:bg-white hover:text-gray-900 transition-colors">
                Voir nos projets
            </a>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('title', $project->title . ' - AstroTech')

@section('content')
@php
    $colorClasses = [
        'emerald' => [
            'badge' => 'bg-emerald-500',
            'gradient' => 'from-emerald-400 to-teal-500',
            'text' => 'text-emerald-600 dark:text-emerald-400',
            'bg' => 'bg-emerald-50 dark:bg-emerald-900/20'
        ],
        'blue' => [
            'badge' => 'bg-blue-500',
            'gradient' => 'from-blue-400 to-cyan-500',
            'text' => 'text-blue-600 dark:text-blue-400',
            'bg' => 'bg-blue-50 dark:bg-blue-900/20'
        ],
        'purple' => [
            'badge' => 'bg-purple-500',
            'gradient' => 'from-purple-400 to-pink-500',
            'text' => 'text-purple-600 dark:text-purple-400',
            'bg' => 'bg-purple-50 dark:bg-purple-900/20'
        ],
        'orange' => [
            'badge' => 'bg-orange-500',
            'gradient' => 'from-orange-400 to-red-500',
            'text' => 'text-orange-600 dark:text-orange-400',
            'bg' => 'bg-orange-50 dark:bg-orange-900/20'
        ],
        'indigo' => [
            'badge' => 'bg-indigo-500',
            'gradient' => 'from-indigo-400 to-purple-500',
            'text' => 'text-indigo-600 dark:text-indigo-400',
            'bg' => 'bg-indigo-50 dark:bg-indigo-900/20'
        ],
        'rose' => [
            'badge' => 'bg-rose-500',
            'gradient' => 'from-rose-400 to-pink-500',
            'text' => 'text-rose-600 dark:text-rose-400',
            'bg' => 'bg-rose-50 dark:bg-rose-900/20'
        ]
    ];
    
    $color = $project->color ?? 'blue';
    $colors = $colorClasses[$color] ?? $colorClasses['blue'];
    
    $typeLabels = [
        'web' => 'Site Web',
        'mobile' => 'Application Mobile',
        'desktop' => 'Application Desktop'
    ];
@endphp

<!-- Hero Section -->
<section class="pt-24 pb-12 bg-gradient-to-br {{ $colors['gradient'] }} opacity-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('projets') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <span class="inline-block {{ $colors['badge'] }} text-white text-sm font-semibold px-4 py-1.5 rounded-full">
                {{ $typeLabels[$project->type] }}
            </span>
        </div>
        
        <h1 class="text-4xl sm:text-5xl font-display font-bold text-gray-900 dark:text-white mb-4">
            {{ $project->title }}
        </h1>
        
        <div class="flex flex-wrap items-center gap-6 text-gray-600 dark:text-gray-300">
            @if($project->company)
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span>{{ $project->company }}</span>
            </div>
            @endif
            
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>{{ $project->year }}</span>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-16 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Description et détails -->
            <div class="lg:col-span-2">
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">À propos du projet</h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ $project->description }}
                    </p>
                </div>

                @if($project->type === 'desktop' && $project->screenshots)
                <!-- Galerie de captures d'écran -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Captures d'écran</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($project->screenshots as $index => $screenshot)
                        <div class="group relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all cursor-pointer" onclick="openLightbox({{ $index }})">
                            <img src="{{ asset('storage/' . $screenshot) }}" alt="Capture {{ $index + 1 }}" class="w-full h-64 object-cover transition-transform group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-white font-medium">Cliquer pour agrandir</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($project->main_image && $project->type !== 'desktop')
                <!-- Image principale pour web/mobile -->
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Aperçu</h2>
                    <div class="rounded-xl overflow-hidden shadow-xl">
                        <img src="{{ $project->main_image }}" alt="{{ $project->title }}" class="w-full h-auto">
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 sticky top-24">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Informations</h3>
                    
                    <div class="space-y-6">
                        @if($project->company)
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Client</p>
                            <div class="flex items-center gap-2">
                                @if($project->logo_url)
                                <img src="{{ $project->logo_url }}" alt="{{ $project->company }}" class="w-8 h-8 rounded">
                                @endif
                                <p class="font-medium text-gray-900 dark:text-white">{{ $project->company }}</p>
                            </div>
                        </div>
                        @endif

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Type</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $typeLabels[$project->type] }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Année</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $project->year }}</p>
                        </div>

                        @if($project->type === 'web' && $project->site_url)
                        <div class="pt-6 border-t border-gray-200 dark:border-gray-600">
                            <a href="{{ $project->site_url }}" target="_blank" rel="noopener noreferrer" class="block w-full bg-primary-600 text-white text-center py-3 px-4 rounded-lg font-medium hover:bg-primary-700 transition-colors">
                                Visiter le site
                                <svg class="w-4 h-4 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        </div>
                        @endif

                        @if($project->type === 'mobile')
                        <div class="pt-6 border-t border-gray-200 dark:border-gray-600 space-y-3">
                            @if($project->ios_url)
                            <a href="{{ $project->ios_url }}" target="_blank" rel="noopener noreferrer" class="block w-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-center py-3 px-4 rounded-lg font-medium hover:opacity-80 transition-opacity">
                                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                                </svg>
                                App Store
                            </a>
                            @endif

                            @if($project->android_url)
                            <a href="{{ $project->android_url }}" target="_blank" rel="noopener noreferrer" class="block w-full bg-green-600 text-white text-center py-3 px-4 rounded-lg font-medium hover:bg-green-700 transition-colors">
                                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.523 15.341c-.538 0-.969.432-.969.969s.431.969.969.969.969-.432.969-.969-.431-.969-.969-.969zm-11.046 0c-.538 0-.969.432-.969.969s.431.969.969.969.969-.432.969-.969-.431-.969-.969-.969zm11.405-6.02l1.997-3.46a.416.416 0 00-.152-.569.416.416 0 00-.569.152l-2.022 3.503a11.644 11.644 0 00-9.272 0L5.842 5.444a.416.416 0 00-.569-.152.416.416 0 00-.152.569l1.997 3.46C2.688 11.186.343 15.162 0 19.69h24c-.343-4.528-2.688-8.504-7.118-10.369z"/>
                                </svg>
                                Play Store
                            </a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lightbox pour les images -->
@if($project->type === 'desktop' && $project->screenshots)
<div id="lightbox" class="fixed inset-0 bg-black/90 z-50 hidden flex items-center justify-center p-4" onclick="closeLightbox()">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
    
    <button onclick="event.stopPropagation(); previousImage()" class="absolute left-4 text-white hover:text-gray-300">
        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    
    <img id="lightbox-image" src="" alt="" class="max-w-full max-h-full object-contain" onclick="event.stopPropagation()">
    
    <button onclick="event.stopPropagation(); nextImage()" class="absolute right-4 text-white hover:text-gray-300">
        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
    
    <div class="absolute bottom-4 text-white text-sm">
        <span id="lightbox-counter"></span>
    </div>
</div>

<script>
const screenshots = @json($project->screenshots);
let currentImageIndex = 0;

function openLightbox(index) {
    currentImageIndex = index;
    updateLightboxImage();
    document.getElementById('lightbox').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function updateLightboxImage() {
    document.getElementById('lightbox-image').src = '{{ asset('storage') }}/' + screenshots[currentImageIndex];
    document.getElementById('lightbox-counter').textContent = `${currentImageIndex + 1} / ${screenshots.length}`;
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % screenshots.length;
    updateLightboxImage();
}

function previousImage() {
    currentImageIndex = (currentImageIndex - 1 + screenshots.length) % screenshots.length;
    updateLightboxImage();
}

// Navigation au clavier
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('lightbox');
    if (!lightbox.classList.contains('hidden')) {
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') previousImage();
    }
});
</script>
@endif

<!-- CTA Section -->
<section class="py-16 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
            Intéressé par un projet similaire ?
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
            Contactez-nous pour discuter de votre projet
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}#contact" class="bg-primary-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-primary-700 transition-colors">
                Nous contacter
            </a>
            <a href="{{ route('projets') }}" class="border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 px-8 py-3 rounded-lg font-medium hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                Voir tous les projets
            </a>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('title', 'Projets - AstroTech')

@section('content')
<!-- Hero Slider Section -->
<section class="pt-16 bg-gradient-to-br from-primary-50 to-accent-50 dark:from-gray-800 dark:to-gray-900 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-8">
            <h1 class="text-4xl sm:text-5xl font-display font-bold text-gray-900 dark:text-white mb-4">
                Nos Projets
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                Découvrez une sélection de nos réalisations les plus remarquables
            </p>
        </div>

        <!-- Projects Slider -->
        <div class="relative mt-12">
            <div class="overflow-hidden rounded-2xl shadow-2xl">
                <div id="slider-container" class="flex transition-transform duration-500 ease-in-out">
                    @foreach($desktopProjects->take(5) as $index => $project)
                    <div class="slider-item min-w-full relative" data-slide="{{ $index }}">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center bg-white dark:bg-gray-800 p-8 lg:p-12">
                            <!-- Image -->
                            <div class="order-2 lg:order-1">
                                <div class="relative rounded-xl overflow-hidden shadow-lg group">
                                    <img src="{{ $project->main_image ?? asset('images/laptop.png') }}" 
                                         alt="{{ $project->title }}" 
                                         class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="order-1 lg:order-2 space-y-6">
                                <div class="flex items-center gap-3">
                                    <span class="inline-block bg-primary-600 text-white text-sm font-semibold px-4 py-1.5 rounded-full">
                                        {{ ucfirst($project->type) }}
                                    </span>
                                    <span class="text-gray-500 dark:text-gray-400 font-medium">{{ $project->year }}</span>
                                </div>
                                
                                <h2 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 dark:text-white">
                                    {{ $project->title }}
                                </h2>
                                
                                <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                                    {{ Str::limit($project->description, 200) }}
                                </p>
                                
                                @if($project->company)
                                <div class="flex items-center gap-3">
                                    @if($project->logo_url)
                                    <img src="{{ $project->logo_url }}" alt="{{ $project->company }}" class="w-10 h-10 rounded-lg object-cover">
                                    @endif
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $project->company }}</span>
                                </div>
                                @endif
                                
                                <a href="{{ route('projets.show', $project->id) }}" 
                                   class="inline-flex items-center gap-2 bg-primary-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-primary-700 transition-colors">
                                    Voir les détails
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation Arrows -->
            @if($desktopProjects->count() > 1)
            <button id="prev-slide" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 dark:bg-gray-800/90 hover:bg-white dark:hover:bg-gray-700 text-gray-800 dark:text-white p-3 rounded-full shadow-lg transition-all z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button id="next-slide" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 dark:bg-gray-800/90 hover:bg-white dark:hover:bg-gray-700 text-gray-800 dark:text-white p-3 rounded-full shadow-lg transition-all z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Dots Indicator -->
            <div class="flex justify-center gap-2 mt-6">
                @foreach($desktopProjects->take(5) as $index => $project)
                <button class="slider-dot w-3 h-3 rounded-full bg-gray-300 dark:bg-gray-600 transition-all {{ $index === 0 ? 'bg-primary-600 dark:bg-primary-500 w-8' : '' }}" data-slide="{{ $index }}"></button>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-8 bg-white dark:bg-gray-800 sticky top-16 z-40 border-b dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-4">
            <button class="filter-btn bg-primary-600 text-white px-6 py-2 rounded-full font-medium hover:bg-primary-700 transition-colors active" data-filter="all">
                Tous les projets
            </button>
            <button class="filter-btn bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 px-6 py-2 rounded-full font-medium hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors" data-filter="web">
                Applications Web
            </button>
            <button class="filter-btn bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 px-6 py-2 rounded-full font-medium hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors" data-filter="mobile">
                Applications Mobile
            </button>
            <button class="filter-btn bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 px-6 py-2 rounded-full font-medium hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors" data-filter="desktop">
                Applications Desktop
            </button>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="projects-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $allProjects = $desktopProjects;
                
                $colorClasses = [
                    'emerald' => [
                        'badge' => 'bg-emerald-500',
                        'gradient' => 'from-emerald-400 to-teal-500',
                        'hover' => 'hover:shadow-emerald-200',
                        'text' => 'text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300'
                    ],
                    'blue' => [
                        'badge' => 'bg-blue-500',
                        'gradient' => 'from-blue-400 to-cyan-500',
                        'hover' => 'hover:shadow-blue-200',
                        'text' => 'text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300'
                    ],
                    'purple' => [
                        'badge' => 'bg-purple-500',
                        'gradient' => 'from-purple-400 to-pink-500',
                        'hover' => 'hover:shadow-purple-200',
                        'text' => 'text-purple-600 hover:text-purple-700 dark:text-purple-400 dark:hover:text-purple-300'
                    ],
                    'orange' => [
                        'badge' => 'bg-orange-500',
                        'gradient' => 'from-orange-400 to-red-500',
                        'hover' => 'hover:shadow-orange-200',
                        'text' => 'text-orange-600 hover:text-orange-700 dark:text-orange-400 dark:hover:text-orange-300'
                    ],
                    'indigo' => [
                        'badge' => 'bg-indigo-500',
                        'gradient' => 'from-indigo-400 to-purple-500',
                        'hover' => 'hover:shadow-indigo-200',
                        'text' => 'text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300'
                    ],
                    'rose' => [
                        'badge' => 'bg-rose-500',
                        'gradient' => 'from-rose-400 to-pink-500',
                        'hover' => 'hover:shadow-rose-200',
                        'text' => 'text-rose-600 hover:text-rose-700 dark:text-rose-400 dark:hover:text-rose-300'
                    ]
                ];
                
                $typeLabels = [
                    'web' => 'Web',
                    'mobile' => 'Mobile',
                    'desktop' => 'Desktop'
                ];
            @endphp
            
            @foreach($allProjects as $project)
            @php
                $color = $project->color ?? 'blue';
                $colors = $colorClasses[$color] ?? $colorClasses['blue'];
            @endphp
            <a href="{{ route('projets.show', $project->id) }}" class="project-card hover-lift cursor-pointer bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl {{ $colors['hover'] }} transition-all block" data-type="{{ $project->type }}">
                <div class="relative group">
                    <img src="{{ $project->main_image ?? asset('images/laptop.png') }}" 
                         alt="{{ $project->title }}" 
                         class="w-full h-56 object-cover transition-transform group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t {{ $colors['gradient'] }} opacity-0 group-hover:opacity-20 transition-opacity"></div>
                    <div class="absolute top-4 left-4">
                        <span class="inline-block {{ $colors['badge'] }} text-white text-xs font-semibold px-4 py-1.5 rounded-full shadow-lg">
                            {{ $typeLabels[$project->type] }}
                        </span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="inline-block bg-white/90 dark:bg-gray-900/90 text-gray-900 dark:text-white text-xs font-medium px-3 py-1.5 rounded-full shadow-lg">
                            {{ $project->year }}
                        </span>
                    </div>
                </div>
                <div class="project-info p-6">
                    <h3 class="text-xl font-display font-bold text-gray-900 dark:text-white mb-3">
                        {{ $project->title }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
                        {{ $project->description }}
                    </p>
                    
                    @if($project->type === 'web' && $project->site_url)
                    <div class="mt-4 flex items-center gap-3">
                        @if($project->logo_url)
                        <img src="{{ $project->logo_url }}" alt="{{ $project->company }}" class="w-8 h-8 rounded object-cover">
                        @endif
                        <span class="text-sm font-medium {{ $colors['text'] }} flex items-center gap-1">
                            Visiter le site
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </span>
                    </div>
                    @endif
                    
                    @if($project->type === 'mobile' && ($project->ios_url || $project->android_url))
                    <div class="mt-4 flex items-center gap-3">
                        @if($project->logo_url)
                        <img src="{{ $project->logo_url }}" alt="{{ $project->company }}" class="w-8 h-8 rounded object-cover">
                        @endif
                        <div class="flex gap-2">
                            @if($project->ios_url)
                            <span class="text-xs font-medium bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-3 py-1.5 rounded-lg">
                                App Store
                            </span>
                            @endif
                            @if($project->android_url)
                            <span class="text-xs font-medium bg-green-600 text-white px-3 py-1.5 rounded-lg">
                                Play Store
                            </span>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    @if($project->type === 'desktop')
                    <div class="mt-4">
                        <span class="text-sm font-medium {{ $colors['text'] }} flex items-center gap-1">
                            Voir les détails
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                    </div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<script>
// S'assurer que le script s'exécute même si DOMContentLoaded a déjà été déclenché
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

function init() {
    initSlider();
    initFilters();
}

// Slider functionality
function initSlider() {
    const sliderContainer = document.getElementById('slider-container');
    const prevBtn = document.getElementById('prev-slide');
    const nextBtn = document.getElementById('next-slide');
    const dots = document.querySelectorAll('.slider-dot');
    
    if (!sliderContainer) return;
    
    let currentSlide = 0;
    const totalSlides = document.querySelectorAll('.slider-item').length;
    
    if (totalSlides <= 1) return;
    
    function goToSlide(index) {
        if (index < 0) index = totalSlides - 1;
        if (index >= totalSlides) index = 0;
        
        currentSlide = index;
        sliderContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        // Update dots
        dots.forEach((dot, i) => {
            if (i === currentSlide) {
                dot.classList.add('bg-primary-600', 'dark:bg-primary-500', 'w-8');
                dot.classList.remove('bg-gray-300', 'dark:bg-gray-600', 'w-3');
            } else {
                dot.classList.remove('bg-primary-600', 'dark:bg-primary-500', 'w-8');
                dot.classList.add('bg-gray-300', 'dark:bg-gray-600', 'w-3');
            }
        });
    }
    
    // Navigation buttons
    if (prevBtn) {
        prevBtn.addEventListener('click', () => goToSlide(currentSlide - 1));
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', () => goToSlide(currentSlide + 1));
    }
    
    // Dots navigation
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => goToSlide(index));
    });
    
    // Auto-play
    let autoplayInterval = setInterval(() => {
        goToSlide(currentSlide + 1);
    }, 5000);
    
    // Pause on hover
    sliderContainer.addEventListener('mouseenter', () => {
        clearInterval(autoplayInterval);
    });
    
    sliderContainer.addEventListener('mouseleave', () => {
        autoplayInterval = setInterval(() => {
            goToSlide(currentSlide + 1);
        }, 5000);
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') goToSlide(currentSlide - 1);
        if (e.key === 'ArrowRight') goToSlide(currentSlide + 1);
    });
}

// Filters functionality
function initFilters() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');
    
    if (filterBtns.length === 0 || projectCards.length === 0) return;
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const filter = this.dataset.filter;
            
            // Update active button
            filterBtns.forEach(b => {
                b.classList.remove('bg-primary-600', 'text-white');
                b.classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-300');
            });
            
            this.classList.remove('bg-white', 'text-gray-700', 'border', 'border-gray-300');
            this.classList.add('bg-primary-600', 'text-white');
            
            // Filter projects
            projectCards.forEach(card => {
                const projectType = card.dataset.type;
                const shouldShow = filter === 'all' || projectType === filter;
                
                if (shouldShow) {
                    card.style.display = '';
                    card.style.visibility = 'visible';
                    card.style.opacity = '1';
                    card.classList.add('fade-in');
                } else {
                    card.style.display = 'none';
                    card.style.visibility = 'hidden';
                    card.style.opacity = '0';
                }
            });
        });
    });
}
</script>
@endsection

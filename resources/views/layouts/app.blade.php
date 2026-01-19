<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AstroTech - Développement Logiciel Moderne')</title>
    
    <script>
        // Theme initialization before page load to prevent flash
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e'
                        },
                        accent: {
                            50: '#fdf4ff',
                            100: '#fae8ff',
                            200: '#f5d0fe',
                            300: '#f0abfc',
                            400: '#e879f9',
                            500: '#d946ef',
                            600: '#c026d3',
                            700: '#a21caf',
                            800: '#86198f',
                            900: '#701a75'
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'display': ['Poppins', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom styles */
        html { scroll-behavior: smooth; }
        
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .project-card {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            transition: all 0.3s ease;
        }
        .project-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.8), rgba(212, 70, 239, 0.8));
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .project-card:hover::before {
            opacity: 1;
        }
        .project-card .project-info {
            position: relative;
            z-index: 2;
            transition: transform 0.3s ease;
        }
        .project-card:hover .project-info {
            transform: translateY(-10px);
        }
    </style>
</head>
<body class="font-sans bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-sm fixed w-full top-0 z-50 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('images/logo.jpeg') }}" alt="AstroTech" class="h-10 w-auto rounded-lg">
                        </a>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'text-primary-600 dark:text-primary-400 border-b-2 border-primary-600' : '' }}">Accueil</a>
                        <a href="{{ route('projets') }}" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('projets') ? 'text-primary-600 dark:text-primary-400 border-b-2 border-primary-600' : '' }}">Projets</a>
                        <a href="{{ route('about') }}" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('about') ? 'text-primary-600 dark:text-primary-400 border-b-2 border-primary-600' : '' }}">À Propos</a>
                        <a href="{{ route('home') }}#contact" class="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700 transition-colors">Contact</a>
                        <button id="theme-toggle" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 p-2 rounded-lg transition-colors" aria-label="Changer le thème">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="md:hidden flex items-center gap-2">
                    <button id="theme-toggle-mobile" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 p-2 rounded-lg transition-colors" aria-label="Changer le thème">
                        <svg class="theme-toggle-dark-icon-mobile hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg class="theme-toggle-light-icon-mobile hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <button id="mobile-menu-btn" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400" aria-label="Ouvrir le menu mobile" title="Menu">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800 border-t dark:border-gray-700">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('home') }}" class="block text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 px-3 py-2 text-base font-medium">Accueil</a>
                <a href="{{ route('projets') }}" class="block text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 px-3 py-2 text-base font-medium">Projets</a>
                <a href="{{ route('about') }}" class="block text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 px-3 py-2 text-base font-medium">À Propos</a>
                <a href="{{ route('home') }}#contact" class="block bg-primary-600 text-white px-3 py-2 text-base font-medium rounded-lg mx-3 text-center">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 dark:bg-gray-950 text-white py-12 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-2xl font-display font-bold text-primary-400 dark:text-primary-300 mb-4">AstroTech</h3>
                    <p class="text-gray-300 dark:text-gray-400 mb-4">
                        Votre partenaire de confiance pour le développement de solutions logicielles innovantes et performantes.
                    </p>
                </div>
                
                <div>
                    <h4 class="font-semibold text-white mb-4">Liens rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 dark:text-gray-400 hover:text-primary-400 dark:hover:text-primary-300 transition-colors">Accueil</a></li>
                        <li><a href="{{ route('projets') }}" class="text-gray-300 dark:text-gray-400 hover:text-primary-400 dark:hover:text-primary-300 transition-colors">Projets</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 dark:text-gray-400 hover:text-primary-400 dark:hover:text-primary-300 transition-colors">À Propos</a></li>
                        <li><a href="{{ route('home') }}#contact" class="text-gray-300 dark:text-gray-400 hover:text-primary-400 dark:hover:text-primary-300 transition-colors">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold text-white mb-4">Contact</h4>
                    <div class="space-y-2 text-gray-300 dark:text-gray-400">
                        <p>ibacodeur@gmail.com</p>
                        <p>+223 99979706</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 dark:border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400 dark:text-gray-500">
                    © {{ date('Y') }} AstroTech. Tous droits réservés. Fondée par Ibrahima Youba Tounkara.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Initialize on page load
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }

        function init() {
            initMobileMenu();
            initThemeToggle();
            initSmoothScroll();
            initFadeInAnimations();
        }

        // Mobile menu toggle
        function initMobileMenu() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mobileMenu.classList.toggle('hidden');
                    
                    // Animate icon
                    const icon = this.querySelector('svg');
                    if (icon) {
                        icon.style.transform = mobileMenu.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(90deg)';
                    }
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(e) {
                    if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                        mobileMenu.classList.add('hidden');
                    }
                });

                // Close menu when clicking on a link
                const menuLinks = mobileMenu.querySelectorAll('a');
                menuLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                    });
                });
            }
        }

        // Theme toggle
        function initThemeToggle() {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const themeToggleMobileBtn = document.getElementById('theme-toggle-mobile');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');
            const darkIconMobile = document.querySelector('.theme-toggle-dark-icon-mobile');
            const lightIconMobile = document.querySelector('.theme-toggle-light-icon-mobile');

            console.log('Theme toggle initialized');
            console.log('Toggle button:', themeToggleBtn);
            console.log('Current theme:', document.documentElement.classList.contains('dark') ? 'dark' : 'light');

            // Show correct icon based on current theme
            function updateIcons() {
                const isDark = document.documentElement.classList.contains('dark');
                console.log('Updating icons, isDark:', isDark);
                
                if (darkIcon && lightIcon) {
                    if (isDark) {
                        darkIcon.classList.remove('hidden');
                        lightIcon.classList.add('hidden');
                    } else {
                        darkIcon.classList.add('hidden');
                        lightIcon.classList.remove('hidden');
                    }
                }
                
                if (darkIconMobile && lightIconMobile) {
                    if (isDark) {
                        darkIconMobile.classList.remove('hidden');
                        lightIconMobile.classList.add('hidden');
                    } else {
                        darkIconMobile.classList.add('hidden');
                        lightIconMobile.classList.remove('hidden');
                    }
                }
            }

            // Toggle theme
            function toggleTheme(e) {
                e.preventDefault();
                console.log('Toggle theme clicked');
                
                const wasDark = document.documentElement.classList.contains('dark');
                
                if (wasDark) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                    console.log('Switched to light mode');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                    console.log('Switched to dark mode');
                }
                
                updateIcons();
            }

            // Initialize icons
            updateIcons();

            // Add event listeners
            if (themeToggleBtn) {
                themeToggleBtn.addEventListener('click', toggleTheme);
                console.log('Event listener added to desktop toggle');
            } else {
                console.error('Desktop toggle button not found');
            }
            
            if (themeToggleMobileBtn) {
                themeToggleMobileBtn.addEventListener('click', toggleTheme);
                console.log('Event listener added to mobile toggle');
            } else {
                console.error('Mobile toggle button not found');
            }
        }

        // Smooth scrolling for anchor links
        function initSmoothScroll() {
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            anchorLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        e.preventDefault();
                        const offsetTop = targetElement.offsetTop - 80;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        }

        // Fade-in animations
        function initFadeInAnimations() {
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            const fadeElements = document.querySelectorAll('.fade-in');
            fadeElements.forEach(el => observer.observe(el));
        }
    </script>
</body>
</html>

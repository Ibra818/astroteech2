<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration - AstroTech')</title>
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
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors">
    <!-- Navigation Admin -->
    <nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-8">
                    <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-primary-600 dark:text-primary-400">
                        AstroTech Admin
                    </a>
                    <div class="hidden md:flex items-center gap-6">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-primary-600 dark:text-primary-400 font-medium' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.projects.create') }}" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                            Nouveau projet
                        </a>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" target="_blank" class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors text-sm">
                        Voir le site
                    </a>
                    
                    <button id="theme-toggle-admin" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 p-2 rounded-lg transition-colors">
                        <svg id="theme-toggle-dark-icon-admin" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon-admin" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-700 transition-colors">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <script>
        // Theme toggle functionality
        function initTheme() {
            const themeToggleBtn = document.getElementById('theme-toggle-admin');
            const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon-admin');
            const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon-admin');

            function updateThemeIcons() {
                if (document.documentElement.classList.contains('dark')) {
                    themeToggleLightIcon?.classList.remove('hidden');
                    themeToggleDarkIcon?.classList.add('hidden');
                } else {
                    themeToggleDarkIcon?.classList.remove('hidden');
                    themeToggleLightIcon?.classList.add('hidden');
                }
            }

            function toggleTheme() {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
                updateThemeIcons();
            }

            updateThemeIcons();
            themeToggleBtn?.addEventListener('click', toggleTheme);
        }

        document.addEventListener('DOMContentLoaded', initTheme);
    </script>
</body>
</html>

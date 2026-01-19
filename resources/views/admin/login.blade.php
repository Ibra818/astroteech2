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
    <title>Connexion Admin - AstroTech</title>
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
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>
<body class="font-sans bg-gradient-to-br from-primary-50 to-accent-50 dark:from-gray-900 dark:to-gray-800 min-h-screen flex items-center justify-center transition-colors">
    <div class="w-full max-w-md px-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 transition-colors">
            <!-- Logo et titre -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <lottie-player 
                        src="https://assets9.lottiefiles.com/packages/lf20_q5pk6p1k.json"
                        background="transparent"
                        speed="1"
                        style="width: 120px; height: 120px;"
                        loop
                        autoplay>
                    </lottie-player>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Administration</h1>
                <p class="text-gray-600 dark:text-gray-300">Connectez-vous pour gérer les projets</p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nom d'utilisateur
                    </label>
                    <input type="text" 
                           id="username" 
                           name="username" 
                           value="{{ old('username') }}"
                           required 
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors"
                           placeholder="admin">
                    @error('username')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Mot de passe
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required 
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors"
                           placeholder="••••••••">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" 
                        class="w-full bg-primary-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-primary-700 transition-colors shadow-lg hover:shadow-xl">
                    Se connecter
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-sm text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                    ← Retour au site
                </a>
            </div>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Identifiants par défaut : <strong>admin</strong> / <strong>admin123</strong>
            </p>
        </div>
    </div>

    <script>
        // Theme toggle functionality (optional for login page)
        function initTheme() {
            if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
        initTheme();
    </script>
</body>
</html>

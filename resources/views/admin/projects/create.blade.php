@extends('admin.layouts.app')

@section('title', 'Nouveau Projet - Administration')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-4 mb-4">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Nouveau Projet</h1>
    </div>
    <p class="text-gray-600 dark:text-gray-300">Ajoutez un nouveau projet à votre portfolio</p>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-8">
    <form action="{{ route('admin.projects.store') }}" method="POST" id="project-form" enctype="multipart/form-data">
        @csrf
        
        <!-- Informations générales -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Informations générales</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Titre du projet *
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Description *
                    </label>
                    <textarea id="description" name="description" rows="4" required
                              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Type de projet *
                    </label>
                    <select id="type" name="type" required onchange="toggleProjectFields()"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <option value="">Sélectionnez un type</option>
                        <option value="web" {{ old('type') == 'web' ? 'selected' : '' }}>Site Web</option>
                        <option value="mobile" {{ old('type') == 'mobile' ? 'selected' : '' }}>Application Mobile</option>
                        <option value="desktop" {{ old('type') == 'desktop' ? 'selected' : '' }}>Application Desktop</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Année *
                    </label>
                    <input type="text" id="year" name="year" value="{{ old('year', date('Y')) }}" required maxlength="4" pattern="\d{4}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    @error('year')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Couleur du thème *
                    </label>
                    <select id="color" name="color" required
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <option value="blue" {{ old('color') == 'blue' ? 'selected' : '' }}>Bleu</option>
                        <option value="emerald" {{ old('color') == 'emerald' ? 'selected' : '' }}>Émeraude</option>
                        <option value="purple" {{ old('color') == 'purple' ? 'selected' : '' }}>Violet</option>
                        <option value="orange" {{ old('color') == 'orange' ? 'selected' : '' }}>Orange</option>
                        <option value="indigo" {{ old('color') == 'indigo' ? 'selected' : '' }}>Indigo</option>
                        <option value="rose" {{ old('color') == 'rose' ? 'selected' : '' }}>Rose</option>
                    </select>
                    @error('color')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nom de l'entreprise *
                    </label>
                    <input type="text" id="company" name="company" value="{{ old('company') }}" required
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    @error('company')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Champs spécifiques Web -->
        <div id="web-fields" class="mb-8 hidden">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Informations Web</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="logo_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        URL du logo *
                    </label>
                    <input type="url" id="logo_url" name="logo_url" value="{{ old('logo_url') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           placeholder="https://example.com/logo.png">
                    @error('logo_url')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="site_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        URL du site *
                    </label>
                    <input type="url" id="site_url" name="site_url" value="{{ old('site_url') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           placeholder="https://example.com">
                    @error('site_url')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="main_image_web" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        URL de l'image principale *
                    </label>
                    <input type="url" id="main_image_web" name="main_image" value="{{ old('main_image') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           placeholder="https://example.com/screenshot.png">
                    @error('main_image')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Champs spécifiques Mobile -->
        <div id="mobile-fields" class="mb-8 hidden">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Informations Mobile</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="logo_url_mobile" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        URL du logo *
                    </label>
                    <input type="url" id="logo_url_mobile" name="logo_url" value="{{ old('logo_url') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           placeholder="https://example.com/logo.png">
                </div>

                <div>
                    <label for="main_image_mobile" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        URL de l'image principale *
                    </label>
                    <input type="url" id="main_image_mobile" name="main_image" value="{{ old('main_image') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           placeholder="https://example.com/screenshot.png">
                </div>

                <div>
                    <label for="ios_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        URL App Store (iOS)
                    </label>
                    <input type="url" id="ios_url" name="ios_url" value="{{ old('ios_url') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           placeholder="https://apps.apple.com/...">
                    @error('ios_url')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="android_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        URL Play Store (Android)
                    </label>
                    <input type="url" id="android_url" name="android_url" value="{{ old('android_url') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           placeholder="https://play.google.com/...">
                    @error('android_url')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Champs spécifiques Desktop -->
        <div id="desktop-fields" class="mb-8 hidden">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Captures d'écran (1 à 10 images)</h2>
            
            <div id="screenshots-container" class="space-y-4">
                <div class="screenshot-field">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Capture d'écran 1 *
                    </label>
                    <input type="file" name="screenshots[]" accept="image/jpeg,image/png,image/jpg,image/gif"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Formats acceptés : JPG, PNG, GIF (max 5MB par image)</p>
                </div>
            </div>
            
            <button type="button" onclick="addScreenshotField()" class="mt-4 text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-medium flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter une capture d'écran
            </button>
            
            @error('screenshots')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Boutons d'action -->
        <div class="flex justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                Annuler
            </a>
            <button type="submit" class="px-6 py-3 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-colors">
                Créer le projet
            </button>
        </div>
    </form>
</div>

<script>
function toggleProjectFields() {
    const type = document.getElementById('type').value;
    const webFields = document.getElementById('web-fields');
    const mobileFields = document.getElementById('mobile-fields');
    const desktopFields = document.getElementById('desktop-fields');
    
    // Masquer tous les champs et les désactiver
    webFields.classList.add('hidden');
    mobileFields.classList.add('hidden');
    desktopFields.classList.add('hidden');
    
    // Désactiver tous les champs (required + disabled)
    webFields.querySelectorAll('input').forEach(input => {
        input.removeAttribute('required');
        input.setAttribute('disabled', 'disabled');
    });
    mobileFields.querySelectorAll('input').forEach(input => {
        input.removeAttribute('required');
        input.setAttribute('disabled', 'disabled');
    });
    desktopFields.querySelectorAll('input').forEach(input => {
        input.removeAttribute('required');
        input.setAttribute('disabled', 'disabled');
    });
    
    // Afficher et activer les champs selon le type
    if (type === 'web') {
        webFields.classList.remove('hidden');
        webFields.querySelectorAll('input').forEach(input => input.removeAttribute('disabled'));
        document.getElementById('logo_url').setAttribute('required', 'required');
        document.getElementById('site_url').setAttribute('required', 'required');
        document.getElementById('main_image_web').setAttribute('required', 'required');
    } else if (type === 'mobile') {
        mobileFields.classList.remove('hidden');
        mobileFields.querySelectorAll('input').forEach(input => input.removeAttribute('disabled'));
        document.getElementById('logo_url_mobile').setAttribute('required', 'required');
        document.getElementById('main_image_mobile').setAttribute('required', 'required');
    } else if (type === 'desktop') {
        desktopFields.classList.remove('hidden');
        desktopFields.querySelectorAll('input').forEach(input => input.removeAttribute('disabled'));
        const firstScreenshot = desktopFields.querySelector('input[name="screenshots[]"]');
        if (firstScreenshot) {
            firstScreenshot.setAttribute('required', 'required');
        }
    }
}

function addScreenshotField() {
    const container = document.getElementById('screenshots-container');
    const count = container.querySelectorAll('.screenshot-field').length;
    
    if (count >= 10) {
        alert('Vous ne pouvez ajouter que 10 captures d\'écran maximum.');
        return;
    }
    
    const newField = document.createElement('div');
    newField.className = 'screenshot-field flex gap-2';
    newField.innerHTML = `
        <div class="flex-1">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Capture d'écran ${count + 1}
            </label>
            <input type="file" name="screenshots[]" accept="image/jpeg,image/png,image/jpg,image/gif"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Formats acceptés : JPG, PNG, GIF (max 5MB par image)</p>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="mt-8 text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </button>
    `;
    
    container.appendChild(newField);
}

// Initialiser les champs au chargement si un type est déjà sélectionné
document.addEventListener('DOMContentLoaded', function() {
    toggleProjectFields();
});
</script>
@endsection

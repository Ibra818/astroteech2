# AstroTech - Site Web Corporate Laravel

<p align="center">
  <img src="public/images/logo.jpeg" alt="AstroTech Logo" width="200">
</p>

<p align="center">
  <strong>Application web Laravel moderne pour une entreprise de développement logiciel</strong><br>
  Fondée en 2025 par Ibrahima Youba Tounkara
</p>

## À propos du projet

AstroTech est une application web Laravel moderne et élégante conçue pour une entreprise de développement logiciel spécialisée dans les applications web, mobile et desktop. Le site présente un design sobre, professionnel et entièrement responsive utilisant des vues Blade.

## Fonctionnalités

### Pages principales
- **Accueil** (`/`) - Présentation de l'entreprise, services et formulaire de contact
- **Projets** (`/projets`) - Portfolio dynamique avec projets desktop réels
- **À Propos** (`/about`) - Histoire, mission, vision et valeurs de l'entreprise

### Caractéristiques techniques
- **Laravel 11** - Framework PHP moderne
- **Vues Blade** - Templates dynamiques et réutilisables
- **Tailwind CSS** - Framework CSS utilitaire
- **Design responsive** - Adapté à tous les écrans
- **Formulaire de contact** - Validation et traitement Laravel
- **Portfolio dynamique** - Projets générés depuis les contrôleurs
- **Images réelles** - Captures d'écran des projets desktop

## Technologies utilisées

- **Laravel 11** - Framework PHP
- **Blade Templates** - Système de templates
- **Tailwind CSS** - Framework CSS
- **Vite** - Build tool moderne
- **JavaScript ES6** - Interactivité côté client
- **PHP 8.2+** - Backend moderne

## Structure du projet Laravel

```
astrotech/
├── app/
│   └── Http/Controllers/
│       ├── HomeController.php      # Contrôleur principal
│       └── ContactController.php   # Gestion des contacts
├── resources/
│   ├── views/
│   │   ├── layouts/app.blade.php   # Layout principal
│   │   ├── home.blade.php          # Page d'accueil
│   │   ├── projets.blade.php       # Page projets
│   │   └── about.blade.php         # Page à propos
│   ├── css/app.css                 # Styles Tailwind
│   └── js/app.js                   # JavaScript principal
├── public/
│   └── images/
│       ├── desktop/                # Captures projets desktop
│       ├── logo.jpeg              # Logo entreprise
│       ├── laptop.png             # Image hero
│       └── www.jpg                # Image service web
└── routes/web.php                  # Routes de l'application
```

## Installation et déploiement

### Prérequis
- PHP 8.2 ou supérieur
- Composer
- Node.js et NPM
- Serveur web (Apache/Nginx)

### Installation locale

1. **Cloner le projet**
   ```bash
   git clone <repository-url>
   cd astrotech
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Installer les dépendances JavaScript**
   ```bash
   npm install
   ```

4. **Configurer l'environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Compiler les assets**
   ```bash
   npm run dev
   # Ou pour la production :
   npm run build
   ```

6. **Démarrer le serveur**
   ```bash
   php artisan serve
   ```

7. **Visiter l'application**
   Ouvrir http://localhost:8000 dans le navigateur

### Déploiement en production

1. **Compiler les assets pour la production**
   ```bash
   npm run build
   ```

2. **Optimiser Laravel**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. **Configurer le serveur web** pour pointer vers `/public`

## Configuration

### Images des projets
Les images des projets desktop sont automatiquement chargées depuis `public/images/desktop/`. Les projets disponibles incluent :

- **Gestion des Produits** - `gestion_produits.png`
- **Système de Caisse** - `caisse.png`
- **Dashboard Admin** - `diao_dashboard.png`
- **Authentification** - `diao_login.png`
- **Gestion Utilisateurs** - `users.png`
- **Statistiques** - `statistiques.png`
- **Documentation** - `docus.png`
- **Historique Ventes** - `ventes_historiques.png`
- **Maintenance** - `maintenance.png`

### Formulaire de contact
Le formulaire envoie les données au contrôleur `ContactController` qui :
- Valide les données
- Log les demandes
- Simule l'envoi d'email (configurable)
- Retourne des messages de succès/erreur

### Personnalisation des couleurs
Les couleurs sont configurées dans le layout principal via Tailwind :
- **Primaire** : Bleus (#0ea5e9 à #0c4a6e)
- **Accent** : Violets (#d946ef à #701a75)

## Routes disponibles

- `GET /` - Page d'accueil
- `GET /projets` - Page projets avec portfolio
- `GET /about` - Page à propos
- `POST /contact` - Traitement du formulaire de contact

## Fonctionnalités avancées

### Système de filtrage des projets
JavaScript dynamique pour filtrer les projets par type (Web, Mobile, Desktop).

### Animations et interactions
- Fade-in au scroll avec Intersection Observer
- Smooth scrolling pour les ancres
- Hover effects sur les cartes projets
- Transitions CSS fluides

### Responsive design
- Navigation mobile avec menu hamburger
- Grille adaptative pour les projets
- Images optimisées pour tous les écrans

## Support navigateurs

- Chrome/Edge 88+
- Firefox 84+
- Safari 14+
- Mobiles modernes (iOS 12+, Android 8+)

## Développement

### Commandes utiles
```bash
# Serveur de développement
php artisan serve

# Compilation des assets en temps réel
npm run dev

# Vider les caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Tests (si configurés)
php artisan test
```

## Contact

Pour toute question concernant ce projet :
- **Email** : contact@astrotech.dev
- **Fondateur** : Ibrahima Youba Tounkara

## Licence

© 2025 AstroTech. Tous droits réservés.

---

**Note technique** : Ce projet utilise Laravel avec des vues Blade pour un rendu dynamique du contenu. Les images des projets sont stockées dans `public/images/` et les données des projets sont gérées via les contrôleurs Laravel.

# 🚀 Guide de Déploiement Hostinger - AstroTech

Ce guide détaille le déploiement de l'application AstroTech sur un hébergement Hostinger.

## 📋 Prérequis Hostinger

### Plan d'hébergement recommandé
- **Business** ou **Premium** (pour accès SSH et composer)
- PHP 8.2 ou supérieur
- Base de données MySQL
- Accès SSH (obligatoire pour Laravel)

### Vérifications avant déploiement
- [ ] Accès au panneau de contrôle Hostinger (hPanel)
- [ ] Accès SSH activé
- [ ] Nom de domaine configuré
- [ ] Base de données MySQL créée

## 🔧 Étape 1 : Préparation sur Hostinger

### 1.1 Activer l'accès SSH
1. Connectez-vous à hPanel
2. Allez dans **Avancé** → **SSH Access**
3. Activez l'accès SSH
4. Notez vos identifiants SSH

### 1.2 Créer la base de données
1. Dans hPanel, allez dans **Bases de données** → **MySQL Databases**
2. Créez une nouvelle base de données :
   - Nom : `u123456789_astrotech` (exemple)
   - Utilisateur : `u123456789_admin`
   - Mot de passe : Générez un mot de passe fort
3. Notez ces informations pour la configuration

### 1.3 Configurer PHP
1. Dans hPanel, allez dans **Avancé** → **PHP Configuration**
2. Sélectionnez **PHP 8.2** ou supérieur
3. Activez les extensions requises :
   - `mbstring`
   - `openssl`
   - `pdo`
   - `tokenizer`
   - `xml`
   - `ctype`
   - `json`
   - `bcmath`

## 📦 Étape 2 : Upload des fichiers

### Option A : Via SSH (Recommandé)

```bash
# Connexion SSH
ssh u123456789@votredomaine.com -p 65002

# Aller dans le répertoire racine
cd ~

# Cloner le projet (si vous utilisez Git)
git clone https://github.com/votre-repo/astrotech.git
cd astrotech

# OU uploader via SFTP puis :
cd astrotech
```

### Option B : Via File Manager
1. Compressez votre projet en ZIP (excluez `node_modules` et `vendor`)
2. Uploadez via hPanel → **File Manager**
3. Décompressez dans le répertoire racine (`/home/u123456789/`)

## 🔨 Étape 3 : Installation des dépendances

```bash
# Connexion SSH
ssh u123456789@votredomaine.com -p 65002
cd ~/astrotech

# Installer Composer (si pas déjà installé)
curl -sS https://getcomposer.org/installer | php
alias composer='php composer.phar'

# Installer les dépendances PHP
composer install --optimize-autoloader --no-dev

# Installer Node.js et NPM (si pas disponible, utilisez nvm)
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
source ~/.bashrc
nvm install 18
nvm use 18

# Installer les dépendances JavaScript
npm install
npm run build
```

## ⚙️ Étape 4 : Configuration de l'environnement

```bash
# Copier le fichier d'environnement
cp .env.example .env

# Éditer le fichier .env
nano .env
```

Configurez les variables suivantes :

```env
APP_NAME=AstroTech
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://votredomaine.com

# Base de données Hostinger
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u123456789_astrotech
DB_USERNAME=u123456789_admin
DB_PASSWORD=votre_mot_de_passe_mysql

# Session et Cache
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# Mail (optionnel - configurez avec les paramètres SMTP Hostinger)
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=votre@email.com
MAIL_PASSWORD=votre_mot_de_passe_email
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=votre@email.com
MAIL_FROM_NAME="${APP_NAME}"
```

Générez la clé d'application :

```bash
php artisan key:generate
```

## 🗄️ Étape 5 : Configuration de la base de données

```bash
# Exécuter les migrations
php artisan migrate --force

# Vérifier que tout fonctionne
php artisan tinker
>>> DB::connection()->getPdo();
>>> exit
```

## 🌐 Étape 6 : Configuration du domaine

### Structure des dossiers Hostinger
```
/home/u123456789/
├── astrotech/              # Votre application Laravel
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/            # Contenu à lier vers public_html
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   └── vendor/
└── public_html/           # Dossier web racine (à configurer)
```

### Méthode 1 : Lien symbolique (Recommandé)

```bash
# Sauvegarder l'ancien public_html
mv ~/public_html ~/public_html.backup

# Créer un lien symbolique vers le dossier public de Laravel
ln -s ~/astrotech/public ~/public_html

# Vérifier
ls -la ~/public_html
```

### Méthode 2 : Fichier index.php personnalisé

Si les liens symboliques ne fonctionnent pas, créez un `index.php` dans `public_html` :

```bash
nano ~/public_html/index.php
```

Contenu :

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Chemin vers votre application Laravel
$app_path = '/home/u123456789/astrotech';

// Maintenance mode
if (file_exists($maintenance = $app_path.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Composer autoloader
require $app_path.'/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once $app_path.'/bootstrap/app.php';

$app->handleRequest(Request::capture());
```

Copiez aussi le `.htaccess` :

```bash
cp ~/astrotech/public/.htaccess ~/public_html/.htaccess
```

## 🔒 Étape 7 : Permissions et sécurité

```bash
# Définir les permissions appropriées
chmod -R 755 ~/astrotech
chmod -R 775 ~/astrotech/storage
chmod -R 775 ~/astrotech/bootstrap/cache

# Sécuriser le fichier .env
chmod 600 ~/astrotech/.env

# Créer les liens de stockage (si vous utilisez le stockage public)
php artisan storage:link
```

## ⚡ Étape 8 : Optimisation

```bash
cd ~/astrotech

# Optimiser l'autoloader
composer dump-autoload --optimize

# Mettre en cache les configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Si vous utilisez des événements
php artisan event:cache
```

## 🔐 Étape 9 : SSL/HTTPS

1. Dans hPanel, allez dans **Sécurité** → **SSL**
2. Activez le certificat SSL gratuit Let's Encrypt
3. Forcez HTTPS en ajoutant dans `.htaccess` :

```apache
# Forcer HTTPS
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

## 👤 Étape 10 : Configuration Admin

### Modifier les identifiants par défaut

**IMPORTANT** : Changez les identifiants admin dans `app/Http/Controllers/Admin/AuthController.php`

```bash
# Générer un hash pour le mot de passe
php artisan tinker
>>> use Illuminate\Support\Facades\Hash;
>>> Hash::make('VotreNouveauMotDePasse123!');
>>> exit
```

Copiez le hash généré et modifiez le contrôleur.

## ✅ Étape 11 : Vérification

### Tests à effectuer
1. Accédez à `https://votredomaine.com`
2. Vérifiez que la page d'accueil s'affiche correctement
3. Testez la navigation (Projets, À propos)
4. Connectez-vous à l'admin : `https://votredomaine.com/admin/login`
5. Testez l'ajout/modification de projets
6. Vérifiez le formulaire de contact

### En cas de problème

```bash
# Vérifier les logs
tail -n 50 ~/astrotech/storage/logs/laravel.log

# Vider les caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Puis reconstruire
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🔄 Mises à jour futures

### Script de mise à jour

Créez un fichier `deploy.sh` :

```bash
#!/bin/bash
cd ~/astrotech

# Mode maintenance
php artisan down

# Récupérer les dernières modifications
git pull origin main

# Mettre à jour les dépendances
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Migrations
php artisan migrate --force

# Optimisations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Sortir du mode maintenance
php artisan up

echo "✅ Déploiement terminé !"
```

Rendez-le exécutable :

```bash
chmod +x deploy.sh
```

Pour mettre à jour :

```bash
./deploy.sh
```

## 📊 Monitoring et Maintenance

### Tâches CRON (optionnel)

Dans hPanel → **Avancé** → **Cron Jobs**, ajoutez :

```bash
# Nettoyage des sessions (quotidien à 2h)
0 2 * * * cd /home/u123456789/astrotech && php artisan session:gc

# Sauvegarde de la base de données (quotidien à 3h)
0 3 * * * mysqldump -u u123456789_admin -p'VOTRE_PASSWORD' u123456789_astrotech > /home/u123456789/backups/db_$(date +\%Y\%m\%d).sql
```

### Surveillance des logs

```bash
# Voir les derniers logs
tail -f ~/astrotech/storage/logs/laravel.log

# Nettoyer les vieux logs (plus de 30 jours)
find ~/astrotech/storage/logs -name "*.log" -mtime +30 -delete
```

## 🚨 Dépannage Hostinger

### Erreur 500
- Vérifiez les permissions : `chmod -R 775 storage bootstrap/cache`
- Consultez les logs : `tail ~/astrotech/storage/logs/laravel.log`
- Vérifiez le `.env` : clé APP_KEY générée, DB correcte

### Page blanche
- Vérifiez que le lien symbolique fonctionne : `ls -la ~/public_html`
- Vérifiez les logs PHP dans hPanel → **Statistiques** → **Error Logs**

### Erreur base de données
- Vérifiez les identifiants dans `.env`
- Testez la connexion : `php artisan tinker` puis `DB::connection()->getPdo();`

### Assets non chargés (CSS/JS)
- Vérifiez que `npm run build` a été exécuté
- Vérifiez l'URL dans `.env` (APP_URL)
- Vérifiez le `.htaccess` dans public_html

### Problème de permissions
```bash
chmod -R 755 ~/astrotech
chmod -R 775 ~/astrotech/storage
chmod -R 775 ~/astrotech/bootstrap/cache
chmod 600 ~/astrotech/.env
```

## 📞 Support

### Ressources
- **Support Hostinger** : https://www.hostinger.fr/support
- **Documentation Laravel** : https://laravel.com/docs
- **Logs Laravel** : `~/astrotech/storage/logs/laravel.log`
- **Logs PHP Hostinger** : Disponibles dans hPanel

### Checklist finale
- [ ] Application accessible via le domaine
- [ ] HTTPS activé et fonctionnel
- [ ] Base de données connectée
- [ ] Admin accessible et sécurisé
- [ ] Assets (CSS/JS/images) chargés correctement
- [ ] Formulaire de contact fonctionnel
- [ ] Gestion des projets opérationnelle
- [ ] Logs vérifiés (pas d'erreurs critiques)
- [ ] Sauvegardes configurées

## 🎉 Félicitations !

Votre application AstroTech est maintenant déployée sur Hostinger !

**URL Admin** : `https://votredomaine.com/admin/login`

---

**Dernière mise à jour** : Janvier 2026  
**Développé par** : Ibrahima Youba Tounkara

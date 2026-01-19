# Guide de Déploiement - AstroTech

Ce guide vous accompagne dans le déploiement de l'application AstroTech en production.

## 📋 Prérequis

### Serveur
- **PHP** : Version 8.2 ou supérieure
- **Composer** : Gestionnaire de dépendances PHP
- **Node.js** : Version 18 ou supérieure
- **NPM** : Gestionnaire de paquets JavaScript
- **Base de données** : MySQL 8.0+ ou PostgreSQL 13+
- **Serveur web** : Apache 2.4+ ou Nginx 1.18+

### Extensions PHP requises
- OpenSSL
- PDO
- Mbstring
- Tokenizer
- XML
- Ctype
- JSON
- BCMath

## 🚀 Installation en Production

### 1. Cloner le projet

```bash
cd /var/www
git clone <votre-repository-url> astrotech
cd astrotech
```

### 2. Installer les dépendances

```bash
# Dépendances PHP
composer install --optimize-autoloader --no-dev

# Dépendances JavaScript
npm install
```

### 3. Configuration de l'environnement

```bash
# Copier le fichier d'environnement
cp .env.example .env

# Générer la clé d'application
php artisan key:generate
```

Éditez le fichier `.env` avec vos paramètres de production :

```env
APP_NAME=AstroTech
APP_ENV=production
APP_KEY=base64:VOTRE_CLE_GENEREE
APP_DEBUG=false
APP_URL=https://votredomaine.com

# Base de données
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=astrotech_db
DB_USERNAME=astrotech_user
DB_PASSWORD=VOTRE_MOT_DE_PASSE_SECURISE

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Cache
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

### 4. Configuration de la base de données

```bash
# Créer la base de données
mysql -u root -p
CREATE DATABASE astrotech_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'astrotech_user'@'localhost' IDENTIFIED BY 'VOTRE_MOT_DE_PASSE';
GRANT ALL PRIVILEGES ON astrotech_db.* TO 'astrotech_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;

# Exécuter les migrations
php artisan migrate --force
```

### 5. Compiler les assets

```bash
# Compilation pour la production
npm run build
```

### 6. Optimiser l'application

```bash
# Optimiser l'autoloader
composer dump-autoload --optimize

# Mettre en cache les configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimiser les événements
php artisan event:cache
```

### 7. Permissions des fichiers

```bash
# Définir les permissions appropriées
sudo chown -R www-data:www-data /var/www/astrotech
sudo chmod -R 755 /var/www/astrotech
sudo chmod -R 775 /var/www/astrotech/storage
sudo chmod -R 775 /var/www/astrotech/bootstrap/cache
```

## 🌐 Configuration du Serveur Web

### Apache

Créez un fichier de configuration : `/etc/apache2/sites-available/astrotech.conf`

```apache
<VirtualHost *:80>
    ServerName votredomaine.com
    ServerAlias www.votredomaine.com
    DocumentRoot /var/www/astrotech/public

    <Directory /var/www/astrotech/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/astrotech-error.log
    CustomLog ${APACHE_LOG_DIR}/astrotech-access.log combined
</VirtualHost>
```

Activez le site et les modules nécessaires :

```bash
sudo a2enmod rewrite
sudo a2ensite astrotech.conf
sudo systemctl reload apache2
```

### Nginx

Créez un fichier de configuration : `/etc/nginx/sites-available/astrotech`

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name votredomaine.com www.votredomaine.com;
    root /var/www/astrotech/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Activez le site :

```bash
sudo ln -s /etc/nginx/sites-available/astrotech /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

## 🔒 SSL/HTTPS avec Let's Encrypt

```bash
# Installer Certbot
sudo apt install certbot python3-certbot-apache  # Pour Apache
# OU
sudo apt install certbot python3-certbot-nginx   # Pour Nginx

# Obtenir un certificat SSL
sudo certbot --apache -d votredomaine.com -d www.votredomaine.com  # Apache
# OU
sudo certbot --nginx -d votredomaine.com -d www.votredomaine.com   # Nginx

# Le renouvellement automatique est configuré par défaut
```

## 👤 Compte Administrateur

### Identifiants par défaut
- **Nom d'utilisateur** : `admin`
- **Mot de passe** : `admin123`

⚠️ **IMPORTANT** : Pour la production, modifiez les identifiants dans :
`app/Http/Controllers/Admin/AuthController.php` (ligne 28)

### Amélioration de la sécurité (Recommandé)

Pour une meilleure sécurité, utilisez le hachage de mot de passe :

```php
// Dans AuthController.php
use Illuminate\Support\Facades\Hash;

// Remplacez la vérification simple par :
if ($request->username === 'admin' && Hash::check($request->password, '$2y$10$VOTRE_HASH_ICI')) {
    // ...
}
```

Générez un hash sécurisé :

```bash
php artisan tinker
>>> Hash::make('votre_nouveau_mot_de_passe')
```

## 📊 Gestion des Projets

### Accès à l'administration
1. Accédez à `https://votredomaine.com/admin/login`
2. Connectez-vous avec vos identifiants
3. Gérez vos projets depuis le dashboard

### Types de projets supportés

#### Projet Web
- Nom de l'entreprise
- URL du logo
- URL du site web
- Image principale

#### Projet Mobile
- Nom de l'entreprise
- URL du logo
- URL App Store (iOS)
- URL Play Store (Android)
- Image principale

#### Projet Desktop
- Nom de l'entreprise
- Jusqu'à 10 captures d'écran

## 🔧 Maintenance

### Vider les caches

```bash
# En cas de modification de configuration
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Puis reconstruire les caches
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Sauvegardes

#### Base de données

```bash
# Sauvegarde quotidienne automatique
# Ajoutez dans crontab : crontab -e
0 2 * * * mysqldump -u astrotech_user -p'VOTRE_MOT_DE_PASSE' astrotech_db > /backups/astrotech_$(date +\%Y\%m\%d).sql
```

#### Fichiers

```bash
# Sauvegarde des fichiers uploadés (si applicable)
tar -czf /backups/astrotech_files_$(date +%Y%m%d).tar.gz /var/www/astrotech/storage/app/public
```

### Logs

Les logs sont stockés dans `storage/logs/laravel.log`

```bash
# Surveiller les logs en temps réel
tail -f storage/logs/laravel.log

# Nettoyer les anciens logs (optionnel)
find storage/logs -name "*.log" -mtime +30 -delete
```

## 🚨 Dépannage

### Erreur 500

```bash
# Vérifier les logs
tail -n 50 storage/logs/laravel.log

# Vérifier les permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Page blanche

```bash
# Activer le mode debug temporairement
# Dans .env : APP_DEBUG=true
# N'oubliez pas de le désactiver après !
```

### Problèmes de base de données

```bash
# Vérifier la connexion
php artisan tinker
>>> DB::connection()->getPdo();

# Réexécuter les migrations
php artisan migrate:fresh --force
```

## 📈 Optimisations Performance

### OPcache (PHP)

Éditez `/etc/php/8.2/fpm/php.ini` :

```ini
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=10000
opcache.revalidate_freq=2
```

### Compression Gzip (Nginx)

```nginx
gzip on;
gzip_vary on;
gzip_proxied any;
gzip_comp_level 6;
gzip_types text/plain text/css text/xml text/javascript application/json application/javascript application/xml+rss;
```

## 🔐 Sécurité

### Checklist de sécurité

- [ ] Modifier les identifiants admin par défaut
- [ ] Activer HTTPS avec certificat SSL
- [ ] Désactiver APP_DEBUG en production
- [ ] Configurer un pare-feu (UFW, iptables)
- [ ] Limiter les tentatives de connexion
- [ ] Mettre à jour régulièrement PHP et les dépendances
- [ ] Sauvegardes automatiques configurées
- [ ] Surveiller les logs d'erreurs

### Protection contre les attaques

```bash
# Installer fail2ban
sudo apt install fail2ban

# Configurer pour protéger contre les attaques brute-force
sudo nano /etc/fail2ban/jail.local
```

## 📞 Support

Pour toute question ou problème :
- **Email** : contact@astrotech.dev
- **Documentation Laravel** : https://laravel.com/docs
- **Logs** : Consultez `storage/logs/laravel.log`

## 📝 Notes de version

### Version 1.0.0
- Système de gestion de projets (Web, Mobile, Desktop)
- Authentification administrateur
- Interface publique responsive
- Mode sombre/clair
- Page de détails des projets
- Formulaire de contact

---

**Dernière mise à jour** : Janvier 2026  
**Développé par** : Ibrahima Youba Tounkara

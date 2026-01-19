# 📦 Déploiement AstroTech sur Hostinger

## 🎯 Démarrage rapide

Votre projet AstroTech est maintenant prêt pour le déploiement sur Hostinger !

### Fichiers créés pour le déploiement

1. **`DEPLOIEMENT_HOSTINGER.md`** - Guide détaillé étape par étape
2. **`.env.hostinger`** - Template de configuration pour Hostinger
3. **`deploy.sh`** - Script automatisé de déploiement
4. **`CHECKLIST_DEPLOIEMENT.md`** - Checklist complète de déploiement
5. **`public/.htaccess`** - Configuration Apache optimisée (HTTPS, sécurité, cache)
6. **`.htaccess`** - Protection du dossier racine

## 🚀 Déploiement en 3 étapes

### Étape 1 : Préparer Hostinger (5 min)

1. Connectez-vous à votre hPanel Hostinger
2. Activez l'accès SSH (Avancé → SSH Access)
3. Créez une base de données MySQL (Bases de données → MySQL)
4. Notez vos identifiants (host, database, username, password)

### Étape 2 : Uploader le projet (10 min)

**Option A : Via Git (Recommandé)**
```bash
ssh u123456789@votredomaine.com -p 65002
cd ~
git clone https://github.com/votre-repo/astrotech.git
cd astrotech
```

**Option B : Via SFTP**
- Compressez le projet (excluez `node_modules` et `vendor`)
- Uploadez via FileZilla ou hPanel File Manager
- Décompressez dans `/home/u123456789/`

### Étape 3 : Configurer et déployer (15 min)

```bash
# Connexion SSH
ssh u123456789@votredomaine.com -p 65002
cd ~/astrotech

# Copier et configurer l'environnement
cp .env.hostinger .env
nano .env  # Modifiez avec vos identifiants

# Installer les dépendances
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Générer la clé et migrer
php artisan key:generate
php artisan migrate --force

# Optimiser
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Lier le dossier public
mv ~/public_html ~/public_html.backup
ln -s ~/astrotech/public ~/public_html

# Permissions
chmod -R 755 ~/astrotech
chmod -R 775 ~/astrotech/storage ~/astrotech/bootstrap/cache
chmod 600 ~/astrotech/.env
```

## ✅ Vérification

Accédez à votre site : `https://votredomaine.com`

Si tout fonctionne :
- ✅ Page d'accueil s'affiche
- ✅ Navigation fonctionne
- ✅ Admin accessible : `/admin/login`

## 📚 Documentation complète

Pour plus de détails, consultez :
- **`DEPLOIEMENT_HOSTINGER.md`** - Guide complet avec toutes les options
- **`CHECKLIST_DEPLOIEMENT.md`** - Liste de vérification détaillée

## 🔄 Mises à jour futures

Pour déployer les mises à jour, utilisez le script automatisé :

```bash
cd ~/astrotech
chmod +x deploy.sh
./deploy.sh
```

## 🆘 Dépannage rapide

### Erreur 500
```bash
tail -n 50 ~/astrotech/storage/logs/laravel.log
chmod -R 775 ~/astrotech/storage ~/astrotech/bootstrap/cache
```

### Assets non chargés
```bash
cd ~/astrotech
npm run build
php artisan config:clear
```

### Problème de base de données
Vérifiez les identifiants dans `.env` et testez :
```bash
php artisan tinker
>>> DB::connection()->getPdo();
```

## 🔐 Sécurité importante

⚠️ **AVANT DE METTRE EN PRODUCTION** :

1. Modifiez les identifiants admin dans `app/Http/Controllers/Admin/AuthController.php`
2. Vérifiez que `APP_DEBUG=false` dans `.env`
3. Assurez-vous que HTTPS est actif

```bash
# Générer un hash sécurisé pour le mot de passe
php artisan tinker
>>> use Illuminate\Support\Facades\Hash;
>>> Hash::make('VotreNouveauMotDePasse');
```

## 📞 Support

- **Support Hostinger** : https://www.hostinger.fr/support
- **Documentation Laravel** : https://laravel.com/docs
- **Logs** : `~/astrotech/storage/logs/laravel.log`

## 🎉 C'est tout !

Votre application AstroTech est maintenant en production sur Hostinger !

**URLs importantes :**
- 🌐 Site : `https://votredomaine.com`
- 🔐 Admin : `https://votredomaine.com/admin/login`

---

**Développé par** : Ibrahima Youba Tounkara  
**Dernière mise à jour** : Janvier 2026

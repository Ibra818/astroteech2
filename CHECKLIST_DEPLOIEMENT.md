# ✅ Checklist de Déploiement Hostinger - AstroTech

## 📋 Avant le déploiement

### Préparation Hostinger
- [ ] Compte Hostinger actif (Plan Business ou Premium recommandé)
- [ ] Accès SSH activé dans hPanel
- [ ] Base de données MySQL créée
- [ ] Nom de domaine configuré et pointé vers Hostinger
- [ ] SSL/HTTPS activé dans hPanel

### Préparation du projet
- [ ] Code testé en local
- [ ] Fichier `.env.hostinger` configuré avec vos identifiants
- [ ] Assets compilés (`npm run build`)
- [ ] Dépendances à jour (`composer install`, `npm install`)

## 🚀 Étapes de déploiement

### 1. Upload des fichiers
- [ ] Fichiers uploadés via SFTP ou Git
- [ ] Dossier placé dans `/home/u123456789/astrotech/`
- [ ] Permissions vérifiées (755 pour les dossiers, 644 pour les fichiers)

### 2. Configuration
- [ ] Fichier `.env` copié et configuré
- [ ] `APP_KEY` générée avec `php artisan key:generate`
- [ ] Identifiants de base de données vérifiés
- [ ] `APP_URL` configurée avec votre domaine

### 3. Installation
- [ ] `composer install --optimize-autoloader --no-dev` exécuté
- [ ] `npm install && npm run build` exécuté
- [ ] Migrations exécutées : `php artisan migrate --force`

### 4. Configuration du domaine
- [ ] Lien symbolique créé : `ln -s ~/astrotech/public ~/public_html`
  OU
- [ ] Fichier `index.php` personnalisé dans `public_html`
- [ ] Fichier `.htaccess` copié dans `public_html`

### 5. Optimisation
- [ ] `composer dump-autoload --optimize`
- [ ] `php artisan config:cache`
- [ ] `php artisan route:cache`
- [ ] `php artisan view:cache`
- [ ] `php artisan storage:link` (si nécessaire)

### 6. Sécurité
- [ ] Identifiants admin modifiés (pas admin/admin123)
- [ ] `APP_DEBUG=false` dans `.env`
- [ ] HTTPS forcé dans `.htaccess`
- [ ] Permissions sécurisées : `chmod 600 .env`
- [ ] Fichiers sensibles protégés

## ✅ Tests post-déploiement

### Tests fonctionnels
- [ ] Page d'accueil accessible : `https://votredomaine.com`
- [ ] Navigation fonctionne (Accueil, Projets, À propos)
- [ ] Page projets affiche les projets
- [ ] Page détail d'un projet fonctionne
- [ ] Formulaire de contact fonctionne
- [ ] Admin accessible : `https://votredomaine.com/admin/login`
- [ ] Connexion admin fonctionne
- [ ] Dashboard admin accessible
- [ ] Ajout de projet fonctionne
- [ ] Modification de projet fonctionne
- [ ] Suppression de projet fonctionne

### Tests techniques
- [ ] HTTPS actif (cadenas vert dans le navigateur)
- [ ] Redirection HTTP → HTTPS fonctionne
- [ ] Assets chargés (CSS, JS, images)
- [ ] Aucune erreur 404 sur les assets
- [ ] Aucune erreur dans la console navigateur
- [ ] Mode sombre/clair fonctionne
- [ ] Responsive design fonctionne (mobile, tablette, desktop)

### Vérification des logs
- [ ] Aucune erreur critique dans `storage/logs/laravel.log`
- [ ] Aucune erreur PHP dans les logs Hostinger (hPanel)
- [ ] Base de données connectée correctement

## 🔧 Configuration optionnelle

### Tâches CRON
- [ ] Nettoyage des sessions configuré
- [ ] Sauvegarde automatique de la base de données configurée

### Performance
- [ ] Cache navigateur activé (via `.htaccess`)
- [ ] Compression Gzip activée
- [ ] OPcache PHP activé dans hPanel

### Email
- [ ] Configuration SMTP testée
- [ ] Email de contact fonctionnel

## 📊 Monitoring

### À surveiller régulièrement
- [ ] Logs d'erreurs : `tail -f ~/astrotech/storage/logs/laravel.log`
- [ ] Espace disque disponible
- [ ] Performance du site (temps de chargement)
- [ ] Sauvegardes effectuées

## 🆘 En cas de problème

### Erreur 500
```bash
tail -n 50 ~/astrotech/storage/logs/laravel.log
chmod -R 775 ~/astrotech/storage ~/astrotech/bootstrap/cache
```

### Page blanche
```bash
# Vérifier le lien symbolique
ls -la ~/public_html
# Vérifier les logs PHP dans hPanel
```

### Assets non chargés
```bash
cd ~/astrotech
npm run build
php artisan config:clear
```

### Erreur base de données
```bash
# Vérifier la connexion
php artisan tinker
>>> DB::connection()->getPdo();
```

## 📞 Ressources

- **Guide complet** : `DEPLOIEMENT_HOSTINGER.md`
- **Script de déploiement** : `deploy.sh`
- **Configuration env** : `.env.hostinger`
- **Support Hostinger** : https://www.hostinger.fr/support
- **Documentation Laravel** : https://laravel.com/docs

## 🎉 Déploiement réussi !

Une fois toutes les cases cochées, votre application AstroTech est en production sur Hostinger !

**URLs importantes :**
- Site public : `https://votredomaine.com`
- Admin : `https://votredomaine.com/admin/login`

---

**Dernière mise à jour** : Janvier 2026

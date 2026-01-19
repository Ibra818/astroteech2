#!/bin/bash

# Script de déploiement pour Hostinger
# Usage: ./deploy.sh

echo "🚀 Début du déploiement AstroTech sur Hostinger..."

# Couleurs pour les messages
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Fonction pour afficher les messages
log_info() {
    echo -e "${GREEN}✓${NC} $1"
}

log_warning() {
    echo -e "${YELLOW}⚠${NC} $1"
}

log_error() {
    echo -e "${RED}✗${NC} $1"
}

# Vérifier que nous sommes dans le bon répertoire
if [ ! -f "artisan" ]; then
    log_error "Erreur: Ce script doit être exécuté depuis la racine du projet Laravel"
    exit 1
fi

# Mode maintenance
log_info "Activation du mode maintenance..."
php artisan down || log_warning "Mode maintenance non activé"

# Récupérer les dernières modifications (si Git est utilisé)
if [ -d ".git" ]; then
    log_info "Récupération des dernières modifications Git..."
    git pull origin main || git pull origin master
else
    log_warning "Git non détecté, passage à l'étape suivante..."
fi

# Mettre à jour les dépendances Composer
log_info "Installation des dépendances PHP..."
composer install --optimize-autoloader --no-dev

# Mettre à jour les dépendances NPM
log_info "Installation des dépendances JavaScript..."
npm install

# Compiler les assets
log_info "Compilation des assets pour la production..."
npm run build

# Exécuter les migrations
log_info "Exécution des migrations de base de données..."
php artisan migrate --force

# Vider les caches
log_info "Nettoyage des caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Optimiser l'application
log_info "Optimisation de l'application..."
composer dump-autoload --optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Vérifier les événements (si utilisés)
if grep -q "event:cache" artisan; then
    php artisan event:cache
fi

# Définir les permissions appropriées
log_info "Configuration des permissions..."
chmod -R 755 storage bootstrap/cache
chmod 600 .env

# Créer le lien symbolique pour le stockage (si nécessaire)
if [ ! -L "public/storage" ]; then
    log_info "Création du lien symbolique storage..."
    php artisan storage:link
fi

# Sortir du mode maintenance
log_info "Désactivation du mode maintenance..."
php artisan up

# Afficher les informations de déploiement
echo ""
log_info "═══════════════════════════════════════════════════════"
log_info "✅ Déploiement terminé avec succès !"
log_info "═══════════════════════════════════════════════════════"
echo ""
log_info "📊 Vérifications recommandées :"
echo "   1. Testez l'accès au site web"
echo "   2. Vérifiez l'interface admin"
echo "   3. Consultez les logs : tail -f storage/logs/laravel.log"
echo ""
log_info "🔗 Liens utiles :"
echo "   - Site : https://votredomaine.com"
echo "   - Admin : https://votredomaine.com/admin/login"
echo ""

exit 0

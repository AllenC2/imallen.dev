#!/bin/bash
set -e

APP_DIR="/var/www/landing-sites"

echo "=== Deploying landing-sites ==="

cd "$APP_DIR"

echo "[1/8] Pulling latest changes..."
git pull origin main

echo "[2/8] Installing PHP dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction

echo "[3/8] Installing Node dependencies and building assets..."
npm ci
npm run build

echo "[4/8] Running migrations..."
php artisan migrate --force

echo "[5/8] Linking storage..."
php artisan storage:link --force

echo "[6/8] Clearing and caching..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan filament:cache-components

echo "[7/8] Setting permissions..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo "[8/8] Reloading PHP-FPM..."
sudo systemctl reload php8.2-fpm

echo "=== Deploy complete! ==="

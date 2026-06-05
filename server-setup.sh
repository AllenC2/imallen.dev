#!/bin/bash
set -e

# ============================================
# Server Setup Script for imallen.dev
# Run on a fresh Ubuntu 22/24 VPS as root
# Usage: curl -sSL https://raw.githubusercontent.com/AllenC2/imallen.dev/main/server-setup.sh | bash
# ============================================

DOMAIN="imallen.dev"
DB_NAME="landing_sites"
DB_USER="landing_user"
DB_PASS="$(openssl rand -base64 24)"
APP_DIR="/var/www/landing-sites"
REPO="https://github.com/AllenC2/imallen.dev.git"
PHP_VERSION="8.2"

echo ""
echo "=========================================="
echo "  Server Setup: $DOMAIN"
echo "=========================================="
echo ""

# ------------------------------------------
# 1. System packages
# ------------------------------------------
echo "[1/10] Installing system packages..."
apt update && apt upgrade -y
apt install -y \
    nginx \
    mysql-server \
    php${PHP_VERSION}-fpm \
    php${PHP_VERSION}-mysql \
    php${PHP_VERSION}-mbstring \
    php${PHP_VERSION}-xml \
    php${PHP_VERSION}-curl \
    php${PHP_VERSION}-zip \
    php${PHP_VERSION}-gd \
    php${PHP_VERSION}-bcmath \
    php${PHP_VERSION}-intl \
    php${PHP_VERSION}-sqlite3 \
    php${PHP_VERSION}-fileinfo \
    unzip curl git

# ------------------------------------------
# 2. Composer
# ------------------------------------------
echo "[2/10] Installing Composer..."
if ! command -v composer &> /dev/null; then
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
fi
composer --version

# ------------------------------------------
# 3. Node.js 20
# ------------------------------------------
echo "[3/10] Installing Node.js..."
if ! command -v node &> /dev/null; then
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
    apt install -y nodejs
fi
node --version

# ------------------------------------------
# 4. MySQL
# ------------------------------------------
echo "[4/10] Configuring MySQL..."
systemctl enable mysql
systemctl start mysql

mysql -u root <<EOF
CREATE DATABASE IF NOT EXISTS ${DB_NAME} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';
GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost';
FLUSH PRIVILEGES;
EOF

echo "  Database: ${DB_NAME}"
echo "  User: ${DB_USER}"
echo "  Password: ${DB_PASS}"

# ------------------------------------------
# 5. Clone repo
# ------------------------------------------
echo "[5/10] Cloning repository..."
if [ -d "$APP_DIR" ]; then
    echo "  Directory exists, pulling latest..."
    cd "$APP_DIR"
    git pull origin main
else
    git clone "$REPO" "$APP_DIR"
    cd "$APP_DIR"
fi

# ------------------------------------------
# 6. Configure .env
# ------------------------------------------
echo "[6/10] Configuring .env..."
cp .env.example .env
php artisan key:generate

sed -i "s/DB_PASSWORD=/DB_PASSWORD=${DB_PASS}/" .env

# ------------------------------------------
# 7. Install dependencies
# ------------------------------------------
echo "[7/10] Installing dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction
npm ci
npm run build

# ------------------------------------------
# 8. Laravel setup
# ------------------------------------------
echo "[8/10] Running migrations and optimizing..."
php artisan migrate --force
php artisan storage:link --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan filament:cache-components

# ------------------------------------------
# 9. Permissions
# ------------------------------------------
echo "[9/10] Setting permissions..."
chown -R www-data:www-data "$APP_DIR/storage" "$APP_DIR/bootstrap/cache"
chmod -R 775 "$APP_DIR/storage" "$APP_DIR/bootstrap/cache"

# ------------------------------------------
# 10. Nginx + SSL
# ------------------------------------------
echo "[10/10] Configuring Nginx..."

cat > /etc/nginx/sites-available/${DOMAIN} <<NGINX
server {
    listen 80;
    server_name ${DOMAIN} www.${DOMAIN};
    root ${APP_DIR}/public;
    index index.php;

    charset utf-8;
    client_max_body_size 20M;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php\$ {
        fastcgi_pass unix:/var/run/php/php${PHP_VERSION}-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
NGINX

ln -sf /etc/nginx/sites-available/${DOMAIN} /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default
nginx -t
systemctl reload nginx

# SSL
echo ""
echo "Installing SSL certificate..."
apt install -y certbot python3-certbot-nginx
certbot --nginx -d ${DOMAIN} -d www.${DOMAIN} --non-interactive --agree-tos --email admin@${DOMAIN} || {
    echo "  SSL setup failed. Run manually: certbot --nginx -d ${DOMAIN} -d www.${DOMAIN}"
}

# ------------------------------------------
# Done
# ------------------------------------------
echo ""
echo "=========================================="
echo "  Setup Complete!"
echo "=========================================="
echo ""
echo "  URL:      https://${DOMAIN}"
echo "  Admin:    https://${DOMAIN}/admin"
echo "  DB Name:  ${DB_NAME}"
echo "  DB User:  ${DB_USER}"
echo "  DB Pass:  ${DB_PASS}"
echo ""
echo "  Save these credentials!"
echo ""
echo "  Next: Create admin user"
echo "  cd ${APP_DIR} && php artisan make:filament-user"
echo ""

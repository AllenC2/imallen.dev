#!/bin/bash
set -e

# ============================================
# Server Setup Script for imallen.dev
# Works on fresh AND existing VPS installations
# Run as root: bash server-setup.sh
# ============================================

DOMAIN="imallen.dev"
DB_NAME="landing_sites"
DB_USER="landing_user"
APP_DIR="/var/www/landing-sites"
REPO="https://github.com/AllenC2/imallen.dev.git"
PHP_VERSION="8.2"

echo ""
echo "=========================================="
echo "  Server Setup: $DOMAIN"
echo "=========================================="
echo ""

# ------------------------------------------
# 1. System packages (skips if installed)
# ------------------------------------------
echo "[1/10] Checking system packages..."
apt update

PACKAGES="nginx mysql-server php${PHP_VERSION}-fpm php${PHP_VERSION}-mysql php${PHP_VERSION}-mbstring php${PHP_VERSION}-xml php${PHP_VERSION}-curl php${PHP_VERSION}-zip php${PHP_VERSION}-gd php${PHP_VERSION}-bcmath php${PHP_VERSION}-intl php${PHP_VERSION}-sqlite3 php${PHP_VERSION}-fileinfo unzip curl git"

for pkg in $PACKAGES; do
    if ! dpkg -s "$pkg" &> /dev/null; then
        echo "  Installing $pkg..."
        apt install -y "$pkg"
    fi
done
echo "  All packages OK."

# ------------------------------------------
# 2. Composer
# ------------------------------------------
echo "[2/10] Checking Composer..."
if ! command -v composer &> /dev/null; then
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
fi
echo "  Composer $(composer --version 2>&1 | head -1)"

# ------------------------------------------
# 3. Node.js
# ------------------------------------------
echo "[3/10] Checking Node.js..."
if ! command -v node &> /dev/null; then
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
    apt install -y nodejs
fi
echo "  Node $(node --version)"

# ------------------------------------------
# 4. MySQL
# ------------------------------------------
echo "[4/10] Checking MySQL..."
systemctl enable mysql
systemctl start mysql

# Check if DB exists
DB_EXISTS=$(mysql -u root -sse "SHOW DATABASES LIKE '${DB_NAME}';" 2>/dev/null || echo "")
if [ "$DB_EXISTS" != "$DB_NAME" ]; then
    DB_PASS="$(openssl rand -base64 24)"
    mysql -u root <<EOF
CREATE DATABASE ${DB_NAME} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';
GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost';
FLUSH PRIVILEGES;
EOF
    echo "  Database created. Password: ${DB_PASS}"
    echo ""
    echo "  *** SAVE THIS PASSWORD: ${DB_PASS} ***"
    echo ""
else
    echo "  Database '${DB_NAME}' already exists. Skipping creation."
fi

# ------------------------------------------
# 5. Clone or pull repo
# ------------------------------------------
echo "[5/10] Updating repository..."
if [ -d "$APP_DIR/.git" ]; then
    cd "$APP_DIR"
    git fetch origin
    git reset --hard origin/main
    echo "  Pulled latest from main."
else
    git clone "$REPO" "$APP_DIR"
    cd "$APP_DIR"
    echo "  Repository cloned."
fi

# ------------------------------------------
# 6. Configure .env
# ------------------------------------------
echo "[6/10] Checking .env..."
if [ ! -f "$APP_DIR/.env" ]; then
    cp .env.example .env
    php artisan key:generate
    echo "  .env created from example. Edit it manually with your DB password:"
    echo "  nano $APP_DIR/.env"
else
    echo "  .env already exists. Keeping current config."
fi

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
# 10. Nginx
# ------------------------------------------
echo "[10/10] Configuring Nginx..."

NGINX_CONF="/etc/nginx/sites-available/${DOMAIN}"

# Check if config already exists
if [ -f "$NGINX_CONF" ]; then
    echo "  Nginx config already exists. Updating root directive..."
    # Update root path in case it changed
    sed -i "s|root .*;|root ${APP_DIR}/public;|" "$NGINX_CONF"
else
    cat > "$NGINX_CONF" <<NGINX
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
    echo "  Nginx config created."
fi

ln -sf "$NGINX_CONF" /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default 2>/dev/null
nginx -t
systemctl reload nginx

# SSL check
if ! certbot certificates 2>/dev/null | grep -q "${DOMAIN}"; then
    echo ""
    echo "No SSL certificate found. Installing..."
    apt install -y certbot python3-certbot-nginx
    certbot --nginx -d ${DOMAIN} -d www.${DOMAIN} --non-interactive --agree-tos --email admin@${DOMAIN} || {
        echo "  SSL setup failed. Run manually: certbot --nginx -d ${DOMAIN} -d www.${DOMAIN}"
    }
else
    echo "  SSL certificate already exists."
fi

# ------------------------------------------
# Done
# ------------------------------------------
echo ""
echo "=========================================="
echo "  Setup Complete!"
echo "=========================================="
echo ""
echo "  URL:   https://${DOMAIN}"
echo "  Admin: https://${DOMAIN}/admin"
echo ""
echo "  To create admin user:"
echo "  cd ${APP_DIR} && php artisan make:filament-user"
echo ""

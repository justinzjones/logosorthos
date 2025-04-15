#!/bin/bash

# Generate application key if not exists
if [ -z "$(grep 'APP_KEY=' .env)" ]; then
    php artisan key:generate
fi

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Run database migrations
php artisan migrate --force

# Clear and cache routes, config, and views
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set proper permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Restart services
docker-compose restart app webserver 
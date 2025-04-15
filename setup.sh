#!/bin/bash

# Create necessary directories
mkdir -p directus/uploads
mkdir -p directus/extensions

# Copy Laravel .env file for Docker
cp magellan/.env.docker magellan/.env

# Set permissions
chmod -R 775 magellan/storage
chmod -R 775 magellan/bootstrap/cache
chmod +x magellan/docker/scripts/*.sh 2>/dev/null || true

# Start Docker containers
docker compose down
docker compose up -d

# Wait for database to be ready
echo "Waiting for database to be ready..."
sleep 10

# Run database migrations for Laravel
docker compose exec app php artisan migrate --force
docker compose exec app php artisan key:generate

# Create storage link
docker compose exec app php artisan storage:link

echo ""
echo "===================================================="
echo "Setup completed! Your applications are now running:"
echo ""
echo "Laravel (Magellan): http://localhost:8080"
echo "Directus CMS: http://localhost:8055"
echo ""
echo "Database connection details:"
echo "  Host: localhost"
echo "  Port: 3306"
echo "  Username: magellan"
echo "  Password: magellanpass123"
echo "  Databases: magellan, directus"
echo "====================================================" 
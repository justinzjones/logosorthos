#!/bin/bash

echo "===== CONTAINER STATUS ====="
docker compose ps

echo ""
echo "===== APP CONTAINER LOGS ====="
docker compose logs app

echo ""
echo "===== NGINX CONTAINER LOGS ====="
docker compose logs webserver

echo ""
echo "===== CHECKING NGINX CONFIG ====="
docker compose exec webserver nginx -t

echo ""
echo "===== CHECKING PHP STATUS ====="
docker compose exec app php -v

echo ""
echo "===== DIRECTORY STRUCTURE ====="
docker compose exec app ls -la /var/www/html/public

echo ""
echo "===== CHECKING DATABASE CONNECTION ====="
docker compose exec app php artisan db:monitor 
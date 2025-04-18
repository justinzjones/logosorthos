#!/bin/bash
echo "Getting a fresh JWT token from Directus..."
curl -s -X POST http://localhost:8055/auth/login -H "Content-Type: application/json" -d '{"email":"justinzjones@hotmail.com","password":"Kippercat1!"}' | jq -r ".data.access_token" > token.txt
TOKEN=$(cat token.txt)
echo "Updating .env file with new token..."
sed -i "" "s|DIRECTUS_API_TOKEN=.*|DIRECTUS_API_TOKEN=$TOKEN|" magellan/.env
echo "Updating container and clearing cache..."
docker cp magellan/.env logosorthos-app:/var/www/html/.env
docker exec logosorthos-app php artisan config:clear
echo "Done! JWT token has been refreshed. It will expire in approximately 15 minutes."
echo "Run this script again when needed."

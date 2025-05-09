#!/bin/bash

# Colors for better readability
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Configuration - Edit these variables
REMOTE_SERVER="root@88.198.107.196"
REMOTE_PATH="/var/www/logosorthos"
COMMIT_MESSAGE=$1

# Check if commit message was provided
if [ -z "$COMMIT_MESSAGE" ]; then
    echo -e "${RED}Error: Commit message is required${NC}"
    echo -e "Usage: ./deploy.sh \"Your commit message\""
    exit 1
fi

# Step 1: Clear Laravel caches locally
echo -e "${YELLOW}Clearing local Laravel caches...${NC}"
docker exec logosorthos-app php artisan cache:clear
docker exec logosorthos-app php artisan view:clear
docker exec logosorthos-app php artisan config:clear
docker exec logosorthos-app php artisan route:clear

# Step 2: Git add, commit, and push
echo -e "${YELLOW}Adding changes to git...${NC}"
git add .

echo -e "${YELLOW}Committing with message: ${NC}\"$COMMIT_MESSAGE\""
git commit -m "$COMMIT_MESSAGE"

echo -e "${YELLOW}Pushing to remote repository...${NC}"
git push

# Step 3: SSH to server and pull changes
echo -e "${YELLOW}Deploying to production server...${NC}"
# First, save any local changes on the server
ssh $REMOTE_SERVER "cd $REMOTE_PATH && git stash --include-untracked && git pull && git stash pop || true"

# Step 4: Get the actual app container name on the server (handles container ID changes)
echo -e "${YELLOW}Getting server container names...${NC}"
APP_CONTAINER=$(ssh $REMOTE_SERVER "docker ps --format '{{.Names}}' | grep logosorthos-app")
if [ -z "$APP_CONTAINER" ]; then
    echo -e "${RED}Error: Could not find app container on server${NC}"
    exit 1
fi
echo -e "${GREEN}Found app container: $APP_CONTAINER${NC}"

# Step 5: Clear caches on the server using Docker
echo -e "${YELLOW}Clearing server caches...${NC}"
ssh $REMOTE_SERVER "cd $REMOTE_PATH && docker exec $APP_CONTAINER php artisan cache:clear && docker exec $APP_CONTAINER php artisan view:clear && docker exec $APP_CONTAINER php artisan config:clear && docker exec $APP_CONTAINER php artisan route:clear"

# Step 6: Restart containers if needed
echo -e "${YELLOW}Restarting server containers...${NC}"
ssh $REMOTE_SERVER "docker restart $APP_CONTAINER logosorthos-nginx"

# Step a7: Run npm build on the server if needed
echo -e "${YELLOW}Building assets on server...${NC}"
ssh $REMOTE_SERVER "cd $REMOTE_PATH/magellan && docker exec $APP_CONTAINER npm run build || echo 'Skipping npm build, not available in container'"

echo -e "${GREEN}Deployment completed successfully!${NC}" 
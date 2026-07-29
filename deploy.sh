#!/bin/bash
set -e

DEPLOY_PATH="/opt/optical-crm"
TIMESTAMP=$(date +"%Y-%m-%d %H:%M:%S")

echo "===== Deployment started: $TIMESTAMP ====="

if [ ! -d "$DEPLOY_PATH" ]; then
    echo "Cloning repository for the first time..."
    git clone https://github.com/mohamedait-abbou/optical-management-system.git "$DEPLOY_PATH"
fi

cd "$DEPLOY_PATH"

echo "Pulling latest code from main branch..."
git pull origin main

echo "Copying production .env file if not present..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "WARNING: .env file was missing. A fresh one was created from .env.example."
    echo "Please update it with production values and re-run the script."
    exit 1
fi

echo "Stopping existing containers (if any)..."
docker compose -f docker-compose.yml -f docker-compose.prod.yml down --remove-orphans || true

echo "Building and starting containers..."
docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d --build

echo "Waiting for MySQL to be ready..."
sleep 10

echo "Running database migrations..."
docker compose -f docker-compose.yml -f docker-compose.prod.yml exec -T app php artisan migrate --force

echo "Clearing and rebuilding cache..."
docker compose -f docker-compose.yml -f docker-compose.prod.yml exec -T app php artisan config:cache
docker compose -f docker-compose.yml -f docker-compose.prod.yml exec -T app php artisan route:cache
docker compose -f docker-compose.yml -f docker-compose.prod.yml exec -T app php artisan view:cache
docker compose -f docker-compose.yml -f docker-compose.prod.yml exec -T app php artisan event:cache

echo "Setting file permissions..."
docker compose -f docker-compose.yml -f docker-compose.prod.yml exec -T app chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

echo "Restarting queue worker (if configured)..."
docker compose -f docker-compose.yml -f docker-compose.prod.yml exec -T app php artisan queue:restart 2>/dev/null || true

echo "===== Deployment completed: $TIMESTAMP ====="
echo "Application is running at http://$(curl -s ifconfig.me):8000"

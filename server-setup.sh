#!/bin/bash
set -e

# ============================================================
# Server Setup Script for Optical CRM
# Run this ONCE on your fresh Ubuntu 26.04 server
# ============================================================

echo "===== Server Setup Started ====="

# --------------------------------------------------
# Step 1: Update system packages
# --------------------------------------------------
# apt update refreshes the package index from repositories
# apt upgrade installs the latest versions of all packages
echo "Updating system packages..."
sudo apt update && sudo apt upgrade -y

# --------------------------------------------------
# Step 2: Install Docker
# --------------------------------------------------
# Docker is required to run the application containers
echo "Installing Docker..."
sudo apt install -y docker.io

# Start Docker service and enable it to start on boot
sudo systemctl start docker
sudo systemctl enable docker

# --------------------------------------------------
# Step 3: Install Docker Compose plugin
# --------------------------------------------------
# Docker Compose lets you define and run multi-container applications
echo "Installing Docker Compose..."
sudo apt install -y docker-compose-plugin

# Verify installations
docker --version
docker compose version

# --------------------------------------------------
# Step 4: Clone the repository
# --------------------------------------------------
# /opt is the standard directory for third-party software on Linux
echo "Cloning repository..."
sudo mkdir -p /opt/optical-crm
sudo git clone https://github.com/mohamedait-abbou/optical-management-system.git /opt/optical-crm

# --------------------------------------------------
# Step 5: Create production .env file
# --------------------------------------------------
# The .env file contains sensitive configuration like database passwords.
# Never commit the real .env to Git.
echo "Creating production .env file..."
cd /opt/optical-crm
sudo cp .env.example .env

echo "=========================================="
echo "  IMPORTANT: Edit the .env file now!"
echo "  Run: sudo nano /opt/optical-crm/.env"
echo ""
echo "  You MUST update these values:"
echo "    - APP_ENV=production"
echo "    - APP_DEBUG=false"
echo "    - APP_KEY (will be generated)"
echo "    - APP_URL=https://your-domain.com"
echo "    - DB_ROOT_PASSWORD=<strong-password>"
echo "    - DB_PASSWORD=<strong-password>"
echo "=========================================="

# --------------------------------------------------
# Step 6: Add your user to the docker group
# --------------------------------------------------
# This lets you run docker commands without sudo
echo "Adding current user to docker group..."
sudo usermod -aG docker "$USER"

echo "===== Server Setup Complete ====="
echo ""
echo "NEXT STEPS:"
echo "  1. Log out and log back in (or run 'newgrp docker')"
echo "  2. Edit the .env file with production values"
echo "  3. Generate APP_KEY: docker compose run --rm app php artisan key:generate"
echo "  4. Run the deploy script: bash /opt/optical-crm/deploy.sh"
echo "  5. Set up SSH keys for GitHub Actions (see SSH_SETUP.md)"

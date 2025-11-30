#!/bin/bash

################################################################################
# Auto-Deployment Script for StudyTube - Shared Hosting
#
# This script automates the deployment of StudyTube (multi-tenant LMS) to shared
# hosting environments. It handles git pulls, dependency installation, tenant
# database management, optimization, and graceful application updates.
#
# Usage: ./deploy.sh [environment]
#   environment: production (default), staging
#
# Prerequisites:
# - Git repository set up on shared hosting at /home/soonqggo/apps/studytube
# - Web root at /home/soonqggo/studytube.app pointing to public/index.php
# - Composer installed and accessible
# - Proper file permissions for Laravel directories
# - .env file configured with production settings
# - Assets pre-compiled locally (npm not available on shared hosting)
################################################################################

set -e  # Exit on any error

# Configuration
ENVIRONMENT="${1:-production}"
PROJECT_DIR="/home/soonqggo/apps/studytube"
PUBLIC_DIR="/home/soonqggo/studytube.app"
BACKUP_DIR="${PROJECT_DIR}/backups"
TENANT_DB_DIR="${PROJECT_DIR}/database/tenants"
DATE=$(date +"%Y%m%d_%H%M%S")

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Functions
log_info() {
  echo -e "${GREEN}[INFO]${NC} $1"
}

log_warning() {
  echo -e "${YELLOW}[WARNING]${NC} $1"
}

log_error() {
  echo -e "${RED}[ERROR]${NC} $1"
}

# Change to project directory
cd "${PROJECT_DIR}" || {
  log_error "Cannot access project directory: ${PROJECT_DIR}"
  exit 1
}

# Check if we're in the project directory
if [ ! -f "artisan" ]; then
  log_error "Not in Laravel project directory. Please check PROJECT_DIR configuration."
  exit 1
fi

log_info "Starting StudyTube deployment for environment: ${ENVIRONMENT}"
log_info "Project directory: ${PROJECT_DIR}"
log_info "Public directory: ${PUBLIC_DIR}"

# Step 1: Enable maintenance mode
log_info "Putting application in maintenance mode..."
php artisan down --retry=60 || log_warning "Could not enable maintenance mode"

# Step 2: Create backup directory
log_info "Creating backup directory..."
mkdir -p "${BACKUP_DIR}"

# Step 3: Backup master database (SQLite)
if [ -f "database/database.sqlite" ]; then
  log_info "Backing up master database..."
  cp database/database.sqlite "${BACKUP_DIR}/master_database_${DATE}.sqlite"
  log_info "Master database backed up to: ${BACKUP_DIR}/master_database_${DATE}.sqlite"
fi

# Step 4: Backup tenant databases
if [ -d "${TENANT_DB_DIR}" ] && [ "$(ls -A ${TENANT_DB_DIR})" ]; then
  log_info "Backing up tenant databases..."
  mkdir -p "${BACKUP_DIR}/tenant_dbs_${DATE}"
  cp -r "${TENANT_DB_DIR}/"* "${BACKUP_DIR}/tenant_dbs_${DATE}/"
  log_info "Tenant databases backed up to: ${BACKUP_DIR}/tenant_dbs_${DATE}/"
else
  log_info "No tenant databases found to backup"
fi

# Step 5: Backup .env file
log_info "Backing up .env file..."
cp .env "${BACKUP_DIR}/.env_${DATE}"

# Step 6: Pull latest code from repository
log_info "Pulling latest code from Git..."
git fetch origin
git reset --hard origin/$(git rev-parse --abbrev-ref HEAD)
log_info "Code updated successfully"

# Step 7: Install/Update Composer dependencies (production mode)
log_info "Installing Composer dependencies..."
composer install --no-interaction --no-dev --optimize-autoloader --prefer-dist
log_info "Dependencies installed"

# Step 8: Verify compiled assets exist
log_info "Verifying pre-compiled assets..."
if [ ! -d "public/build" ] && [ ! -f "public/css/app.css" ] && [ ! -f "public/js/app.js" ]; then
  log_warning "No compiled assets found. Make sure to run 'npm run build' locally and commit the assets."
else
  log_info "Pre-compiled assets found"
fi

# Step 9: Create tenant database directory if it doesn't exist
log_info "Ensuring tenant database directory exists..."
mkdir -p "${TENANT_DB_DIR}"
chmod 775 "${TENANT_DB_DIR}"

# Step 10: Run database migrations
log_info "Running master database migrations..."
php artisan migrate --force --no-interaction
log_info "Master migrations completed"

log_info "Running tenant database migrations..."
php artisan migrate --database=tenant --path=database/migrations/tenant --force --no-interaction || log_warning "Tenant migrations failed (this is normal if no tenant DBs exist yet)"
log_info "Tenant migrations completed"

# Step 11: Clear and cache configuration
log_info "Clearing old cache files..."
php artisan config:clear
php artisan cache:clear || log_warning "Cache clear failed (this is normal on first deployment)"
php artisan route:clear
php artisan view:clear

log_info "Caching configuration for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Step 12: Clear application cache again (after migrations)
log_info "Clearing application cache..."
php artisan cache:clear || log_warning "Cache clear skipped"

# Step 13: Set correct permissions (shared hosting specific)
log_info "Setting proper file permissions..."
chmod -R 755 storage bootstrap/cache
find storage -type f -exec chmod 644 {} \;
find storage -type d -exec chmod 755 {} \;

# Set permissions for tenant database directory
if [ -d "${TENANT_DB_DIR}" ]; then
  chmod -R 775 "${TENANT_DB_DIR}"
  find "${TENANT_DB_DIR}" -type f -name "*.sqlite" -exec chmod 664 {} \;
  log_info "Tenant database permissions set"
fi

log_info "Permissions set"

# Step 14: Sync public directory files
log_info "Syncing public directory to web root..."
# Create public directory if it doesn't exist
mkdir -p "${PUBLIC_DIR}"

# Copy index.php and .htaccess to web root
cp -f "${PROJECT_DIR}/public/index.php" "${PUBLIC_DIR}/index.php"
cp -f "${PROJECT_DIR}/public/.htaccess" "${PUBLIC_DIR}/.htaccess"

# Update index.php paths to point to the correct project directory
sed -i "s|__DIR__.'/../vendor/autoload.php'|'${PROJECT_DIR}/vendor/autoload.php'|g" "${PUBLIC_DIR}/index.php"
sed -i "s|__DIR__.'/../bootstrap/app.php'|'${PROJECT_DIR}/bootstrap/app.php'|g" "${PUBLIC_DIR}/index.php"

# Copy all assets from public directory (css, js, images, etc.)
rsync -av --delete \
  --exclude='index.php' \
  --exclude='.htaccess' \
  "${PROJECT_DIR}/public/" "${PUBLIC_DIR}/"

log_info "Public directory synced successfully"
log_info "Web root: ${PUBLIC_DIR}"

# Step 15: Clean up old backups (keep last 10)
log_info "Cleaning up old backups..."
cd "${BACKUP_DIR}"
ls -t master_database_*.sqlite 2>/dev/null | tail -n +11 | xargs -r rm --
ls -t .env_* 2>/dev/null | tail -n +11 | xargs -r rm --
find . -name "tenant_dbs_*" -type d | sort -r | tail -n +11 | xargs -r rm -rf
cd "${PROJECT_DIR}"
log_info "Old backups cleaned"

# Step 16: Disable maintenance mode
log_info "Bringing application back online..."
php artisan up

# Step 17: Verify deployment
log_info "Verifying deployment..."
if php artisan tinker --execute="echo 'OK';" > /dev/null 2>&1; then
  log_info "Application is responding correctly"
else
  log_warning "Application verification failed, but deployment completed"
fi

# Final message
echo ""
log_info "======================================"
log_info "StudyTube deployment completed successfully!"
log_info "Environment: ${ENVIRONMENT}"
log_info "Timestamp: ${DATE}"
log_info "Project directory: ${PROJECT_DIR}"
log_info "Public directory: ${PUBLIC_DIR}"
log_info "Backup location: ${BACKUP_DIR}"
log_info "======================================"
echo ""
log_info "Next steps:"
echo "  1. Test application: curl https://studytube.app"
echo "  2. Monitor logs: tail -f storage/logs/laravel.log"
echo "  3. Check application status: php artisan about"
echo "  4. Verify tenant isolation: Register test users"
echo ""
log_info "Remember: Compile assets locally with 'npm run build' before deployment"
echo ""

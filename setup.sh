#!/bin/bash

# StudyTube Quick Setup Script

echo "🚀 Setting up StudyTube..."

# Install dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-interaction

echo "📦 Installing NPM dependencies..."
npm install

# Copy environment file if it doesn't exist
if [ ! -f .env ]; then
    echo "🔧 Creating .env file..."
    cp .env.example .env
    php artisan key:generate
fi

# Create necessary directories
echo "📁 Creating tenant database directory..."
mkdir -p database/tenants

# Run migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force --seed

# Build frontend assets
echo "🎨 Building frontend assets..."
npm run build

# Create admin user
echo "👤 Create an admin user for FilamentPHP:"
php artisan filament:user

echo ""
echo "✅ Setup complete!"
echo ""
echo "🔥 To start the development server, run:"
echo "   php artisan serve"
echo ""
echo "📍 Access the application at:"
echo "   - Frontend: http://localhost:8000"
echo "   - Admin Panel: http://localhost:8000/jabarrioss"
echo ""
echo "⚙️ Don't forget to configure:"
echo "   - Google OAuth credentials in .env"
echo "   - Shopify settings in .env"
echo ""

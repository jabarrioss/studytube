# StudyTube - Multi-Tenant Learning Management System

**StudyTube** is a feature-rich, multi-tenant learning management system built with the TALL stack (Tailwind, Alpine.js, Laravel 12, Blade). It allows users to create learning topics from YouTube videos, add timestamped notes, and track their learning progress.

---

## 🚀 Technology Stack

- **Framework:** Laravel 12 (Latest Stable)
- **Frontend:** Blade Templates + Alpine.js (No Vue/React/TypeScript)
- **Styling:** Tailwind CSS v4
- **Database:** SQLite (Multi-tenant architecture)
- **Admin Panel:** FilamentPHP v3
- **Authentication:** Laravel Breeze + Google OAuth (Laravel Socialite)
- **Payments:** Shopify (Headless/Checkout API)

---

## 🏗️ Architecture Overview

### Multi-Tenant Database Architecture

StudyTube uses **strict database isolation** between users:

1. **Master Database** (`database/database.sqlite`)
   - Stores global application data
   - Tables: `users`, `plans`, `payment_providers`, `sessions`, etc.

2. **Tenant Databases** (`database/tenants/user_{uuid}.sqlite`)
   - One database per user (isolated by UUID)
   - Tables: `topics`, `notes`, `learning_sessions`
   - Automatically created on user registration
   - Automatically switched via `SetTenantDatabase` middleware

### Data Flow

```
User Login → Auth Middleware → SetTenantDatabase Middleware → 
Database switches to user_{uuid}.sqlite → User-specific data operations
```

---

## 📦 Installation & Setup

### Prerequisites

- PHP 8.2+
- Composer
- Node.js & NPM
- SQLite

### Step 1: Install Dependencies

```bash
composer install
npm install
npm run build
```

### Step 2: Configure Environment

Update `.env` file with:

#### Google OAuth
```env
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
```

#### Shopify Configuration
```env
SHOPIFY_DOMAIN=your-store.myshopify.com
SHOPIFY_STOREFRONT_TOKEN=your_storefront_access_token
SHOPIFY_WEBHOOK_SECRET=your_webhook_secret
SHOPIFY_PREMIUM_VARIANT_ID=your_premium_variant_id
```

### Step 3: Run Migrations

```bash
php artisan migrate --seed
```

### Step 4: Create Admin User

```bash
php artisan filament:user
```

### Step 5: Start Development Server

```bash
php artisan serve
```

Access admin panel at: `http://localhost:8000/jabarrioss`

---

## 🎯 Core Features

### 1. **YouTube Video Learning**
- Paste any YouTube URL to create a learning topic
- Auto-fetch video metadata (title, thumbnail) via YouTube oEmbed API
- Embedded YouTube player with full IFrame API integration

### 2. **Timestamped Notes (Alpine.js)**
- Add notes at any point while watching videos
- Notes are saved with precise timestamp (seconds)
- Click on timestamp to jump to that exact moment in video
- Real-time playback tracking

### 3. **Multi-Tenancy**
- Each user gets their own isolated SQLite database
- Automatic provisioning on registration via `CreateTenantDatabase` listener
- Middleware-based database switching on every request

### 4. **Authentication**
- Email/Password (Laravel Breeze)
- Google OAuth (Laravel Socialite)
- Automatic tenant database creation on first login

### 5. **Premium Subscriptions (Shopify)**
- Shopify headless checkout integration
- User UUID passed as cart attribute
- Webhook handler for `orders/paid` event
- Automatic plan upgrade on successful payment

### 6. **Admin Panel (FilamentPHP)**
- Manage users and their plans
- Configure payment provider settings

---

## 📁 Key Files

```
app/Http/Middleware/SetTenantDatabase.php - Critical middleware for DB switching
app/Listeners/CreateTenantDatabase.php - Provisions tenant DB on registration
app/Services/YouTubeMetadataService.php - Fetches video metadata
app/Services/ShopifyPaymentService.php - Generates checkout URLs
resources/views/topics/show.blade.php - Video player with Alpine.js
```

---

## 🔐 Shopify Webhook Setup

Add webhook in Shopify Admin:
- **URL:** `https://yourdomain.com/webhooks/shopify`
- **Event:** `orders/paid`
- **Format:** `JSON`

---

## 🆘 Support

For issues and questions:
- Check the `TODO.md` file for development progress
- Review the inline code documentation

---

**Happy Learning! 📚🎥**

# StudyTube AI Agent Instructions

## Project Overview
StudyTube is a multi-tenant learning management system built with Laravel 12, Blade templates, Alpine.js, and Tailwind CSS. Users create learning topics from YouTube videos and add timestamped notes.

## Critical Architecture: Multi-Tenant Database Isolation

### Two-Database System
- **Master DB** (`database/database.sqlite`): Global data - `users`, `plans`, `payment_providers`, sessions
- **Tenant DBs** (`database/tenants/user_{uuid}.sqlite`): Per-user isolated data - `topics`, `notes`, `learning_sessions`

### Request Flow (CRITICAL)
```
Auth Middleware → SetTenantDatabase Middleware → DB switches to user_{uuid}.sqlite → Controller
```

**NEVER bypass `SetTenantDatabase` middleware** - it must run on every authenticated request to ensure proper database isolation.

### Tenant Models MUST Specify Connection
All models in `app/Models/Tenant/` must declare `protected $connection = 'tenant';` (see `Topic`, `Note`, `LearningSession`).

### New User Provisioning
The `CreateTenantDatabase` listener automatically creates a user's SQLite file and runs tenant migrations when a user registers. This hooks into Laravel's `Registered` event (configured in `User::boot()` via UUID generation).

## Technology Stack Constraints

- **NO Vue/React/TypeScript** - Use Blade + Alpine.js only
- **Frontend**: Alpine.js for interactivity, Tailwind CSS v4 for styling
- **Database**: SQLite only (multi-tenant architecture)
- **Admin**: FilamentPHP v3 at `/jabarrioss` (master DB only)

## Development Workflow

### Quick Start
```bash
composer run dev  # Starts server, queue, logs, vite concurrently
```
Individual commands: `php artisan serve`, `npm run dev`, `php artisan queue:listen`, `php artisan pail`

### Testing Changes
```bash
composer test           # Run PHPUnit tests
php artisan migrate    # Master DB only
php artisan migrate --database=tenant --path=database/migrations/tenant  # Tenant DB structure
```

### Key Files for Database Switching
- `bootstrap/app.php`: Middleware priority - `SetTenantDatabase` runs after auth, before route model binding
- `config/database.php`: Defines both `sqlite` (master) and `tenant` connections
- `app/Http/Middleware/SetTenantDatabase.php`: Dynamically sets tenant DB path using `Config::set()` and `DB::reconnect()`

## Patterns & Conventions

### Alpine.js Component Pattern
Use `Alpine.data()` for complex components. See `resources/views/topics/show.blade.php` for the video player component:
```javascript
Alpine.data('videoPlayerComponent', (youtubeId, topicId) => ({
    player: null,
    currentTime: 0,
    notes: @json($notes),
    // Methods: init(), onPlayerReady(), seekTo(), saveNote()
}));
```

### YouTube Integration
- `YouTubeMetadataService`: Extracts video ID, fetches metadata via oEmbed API (no API key needed)
- Player uses YouTube IFrame API, tracks position every 1 second
- Notes capture `timestamp_seconds` (integer), displayed as MM:SS format

### Shopify Payment Flow
1. `ShopifyPaymentService::generateCartPermalink()` embeds user UUID in cart attributes
2. User completes purchase on Shopify
3. Webhook to `/webhooks/shopify` (CSRF exempt in `bootstrap/app.php`)
4. HMAC-SHA256 signature verification
5. Update user's `plan_id` in master DB

Configuration stored in `payment_providers` table (managed via Filament admin).

## Common Tasks

### Adding Tenant Table
1. Create migration in `database/migrations/tenant/`
2. Create model in `app/Models/Tenant/` with `protected $connection = 'tenant';`
3. Run against tenant DB: `php artisan migrate --database=tenant --path=database/migrations/tenant`
4. Existing users need manual migration: Consider a command that iterates user UUIDs

### Adding Global Table
1. Create migration in `database/migrations/`
2. Create model in `app/Models/` (default connection)
3. Run: `php artisan migrate`

### Filament Admin Resources
Admin panel connects to **master DB only** - do not access tenant data from Filament. Panel ID is `jabarrioss` (see `app/Providers/Filament/JabarriossPanelProvider.php`).

## Testing Multi-Tenancy

Verify isolation by:
1. Register two users (User A, User B)
2. Check `database/tenants/` for two separate SQLite files
3. Create topics as User A
4. Log in as User B - should see empty topics list
5. Use DB browser to inspect separate SQLite files

## Deployment Considerations

- Ensure `database/tenants/` is writable (775 permissions)
- Run production cache: `php artisan config:cache`, `php artisan route:cache`, `php artisan view:cache`
- See `DEPLOYMENT.md` for full checklist (Google OAuth, Shopify webhooks, SSL)
- Queue worker required for background jobs: `php artisan queue:listen`

## Common Pitfalls

1. **Forgetting tenant connection** - Models in `app/Models/Tenant/` without `$connection = 'tenant'` will query the master DB
2. **Direct DB facade calls** - Use `DB::connection('tenant')` explicitly if not using Eloquent
3. **Middleware order** - `SetTenantDatabase` must run after auth but before route model binding
4. **Filament accessing tenant data** - Filament is master DB only; don't mix tenant queries in admin resources
5. **Missing CreateTenantDatabase listener** - New users won't get tenant databases if listener fails

## External Integrations

- **Google OAuth**: Configured in `config/services.php`, handled by `GoogleAuthController`
- **YouTube oEmbed API**: `https://www.youtube.com/oembed?url={video_url}&format=json` (no auth required)
- **Shopify**: Storefront token in `.env`, webhooks require `X-Shopify-Hmac-Sha256` header verification

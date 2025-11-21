# StudyTube - Integration Guide

## Quick Reference

This guide covers the key integrations and services used in StudyTube.

---

## 🎥 YouTube Integration

### Service: `YouTubeMetadataService`

**Purpose:** Extract video ID and fetch metadata from YouTube URLs.

**Methods:**

```php
extractVideoId(string $url): ?string
```
- Extracts video ID from various YouTube URL formats
- Returns `null` if invalid URL

```php
fetchMetadata(string $videoId): array
```
- Fetches video title, thumbnail using YouTube oEmbed API
- No API key required
- Falls back to default thumbnail if API fails

**Usage Example:**

```php
$service = new YouTubeMetadataService();
$videoId = $service->extractVideoId('https://youtube.com/watch?v=ABC123');
$metadata = $service->fetchMetadata($videoId);

// Returns:
// [
//   'title' => 'Video Title',
//   'thumbnail_url' => 'https://img.youtube.com/...',
//   'author_name' => 'Channel Name'
// ]
```

**API Endpoint:** `https://www.youtube.com/oembed?url={video_url}&format=json`

---

## 💳 Shopify Integration

### Service: `ShopifyPaymentService`

**Purpose:** Generate checkout URLs and verify webhooks.

**Configuration Required:**

In FilamentPHP admin or `.env`:
```
SHOPIFY_DOMAIN=your-store.myshopify.com
SHOPIFY_STOREFRONT_TOKEN=your_token
SHOPIFY_WEBHOOK_SECRET=your_secret
SHOPIFY_PREMIUM_VARIANT_ID=variant_id
```

**Methods:**

```php
generateCartPermalink(string $userUuid, string $variantId, int $quantity = 1): string
```
- Creates Shopify cart URL with embedded user UUID
- Format: `https://{domain}/cart/{variant}:{qty}?attributes[user_uuid]={uuid}`

```php
verifyWebhook(string $data, string $hmacHeader): bool
```
- Validates webhook HMAC-SHA256 signature
- Returns `true` if signature is valid

**Usage Example:**

```php
$service = new ShopifyPaymentService();
$checkoutUrl = $service->generateCartPermalink($user->uuid, 'variant_123');
// User is redirected to: https://store.myshopify.com/cart/variant_123:1?attributes[user_uuid]=abc-123
```

### Webhook Setup

**URL:** `POST /webhooks/shopify`

**Required Headers:**
```
X-Shopify-Hmac-Sha256: {signature}
X-Shopify-Topic: orders/paid
Content-Type: application/json
```

**Payload Structure:**
```json
{
  "id": 123456,
  "note_attributes": [
    {
      "name": "user_uuid",
      "value": "abc-123-def-456"
    }
  ],
  "total_price": "9.99",
  "financial_status": "paid"
}
```

**Handler Logic:**
1. Verify HMAC signature
2. Extract `user_uuid` from `note_attributes`
3. Find user by UUID
4. Update user's `plan_id` to premium plan

---

## 🔐 Google OAuth Integration

### Service: Laravel Socialite

**Configuration:** `config/services.php`

```php
'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_REDIRECT_URI'),
],
```

**Routes:**

```php
GET /auth/google              → Redirect to Google
GET /auth/google/callback     → Handle callback
```

**Flow:**

1. User clicks "Sign in with Google"
2. Redirected to Google OAuth consent screen
3. User authorizes
4. Google redirects to `/auth/google/callback`
5. `GoogleAuthController` handles:
   - Find/create user by `google_id` or `email`
   - Generate UUID if new user
   - Create tenant database (via `CreateTenantDatabase` listener)
   - Log user in
   - Redirect to `/topics`

**Controller:** `app/Http/Controllers/Auth/GoogleAuthController.php`

---

## 🗄️ Multi-Tenancy System

### Critical Components

**1. SetTenantDatabase Middleware**

**Location:** `app/Http/Middleware/SetTenantDatabase.php`

**Purpose:** Switches database connection to user's tenant DB on every request.

**Flow:**
```
Request → Auth Check → Get user.uuid → 
Config::set('database.connections.tenant.database', "user_{uuid}.sqlite") →
DB::reconnect('tenant') → Continue
```

**Registration:** `bootstrap/app.php` (web middleware)

---

**2. CreateTenantDatabase Listener**

**Location:** `app/Listeners/CreateTenantDatabase.php`

**Event:** `Illuminate\Auth\Events\Registered`

**Purpose:** Automatically creates tenant database on user registration.

**Actions:**
1. Get user's UUID
2. Create file: `database/tenants/user_{uuid}.sqlite`
3. Switch tenant connection to new file
4. Run migrations from `database/migrations/tenant/`

**Registration:** Automatically registered via event discovery

---

## 🎬 Video Player Integration

### Alpine.js Component

**Location:** `resources/views/topics/show.blade.php`

**YouTube IFrame API:** Loaded globally

```html
<script src="https://www.youtube.com/iframe_api"></script>
```

**Component Structure:**

```javascript
function videoPlayer(videoId) {
    return {
        player: null,           // YT.Player instance
        currentTime: 0,         // Current playback position (seconds)
        duration: 0,            // Video duration
        
        initPlayer()            // Creates YouTube player
        onPlayerReady(event)    // Player ready callback
        onPlayerStateChange()   // Tracks play/pause
        startTimeTracking()     // Updates currentTime every second
        stopTimeTracking()      // Stops tracking
        seekToTime(seconds)     // Jumps to timestamp
        formatTime(seconds)     // Returns "MM:SS"
        submitNote(event)       // Captures time on form submit
    }
}
```

**Key Features:**

1. **Real-time Tracking:** Updates `currentTime` every 1 second while playing
2. **Timestamp Seeking:** Click note timestamp → `seekToTime()` → video jumps
3. **Note Creation:** Form captures `currentTime` as hidden input

**Global Player Instance:** Required for timestamp seeking from notes list

```javascript
let globalPlayer = null;  // Shared across Alpine components
```

---

## 📊 Database Connections

### Master Connection (default)

```php
Config: database.connections.sqlite
File: database/database.sqlite
Tables: users, plans, payment_providers, sessions, cache, jobs
```

### Tenant Connection

```php
Config: database.connections.tenant
File: database/tenants/user_{uuid}.sqlite (dynamic)
Tables: topics, notes, learning_sessions
```

### Switching Logic

```php
// In SetTenantDatabase middleware:
$tenantDbPath = database_path("tenants/user_{$uuid}.sqlite");
Config::set('database.connections.tenant.database', $tenantDbPath);
DB::purge('tenant');
DB::reconnect('tenant');
```

### Model Configuration

```php
// Tenant models must specify connection:
class Topic extends Model {
    protected $connection = 'tenant';
}
```

---

## 🔧 Admin Panel (FilamentPHP)

**Access:** `/jabarrioss` (or configured panel ID)

**Resources:**

1. **UserResource** - Manage users, view plans, UUIDs
2. **PaymentProviderResource** - Configure Shopify settings

**Configuration:**

```php
Location: app/Providers/Filament/JabarriossPanelProvider.php
Panel ID: jabarrioss
Database: Uses master connection only
```

**Creating Admin User:**

```bash
php artisan filament:user
```

---

## 🚨 Error Handling

### Webhook Failures

**Logged in:** `storage/logs/laravel.log`

**Common Issues:**
- Invalid HMAC signature → Check `SHOPIFY_WEBHOOK_SECRET`
- User UUID not found → Check `note_attributes` in Shopify order
- Premium plan missing → Run `PlanSeeder`

### Tenant Database Errors

**Symptoms:**
- "Table not found" errors for topics/notes
- Empty database file created

**Debug:**
```bash
# Check if tenant DB exists
ls database/tenants/

# Check if migrations ran
sqlite3 database/tenants/user_{uuid}.sqlite ".tables"
```

**Fix:**
```bash
# Manually run tenant migrations
php artisan migrate --database=tenant --path=database/migrations/tenant
```

---

## 📝 Development Tips

### Testing Multi-Tenancy

```php
// Register two users, verify separate DBs
User::create(['name' => 'User 1', 'email' => 'user1@test.com']);
User::create(['name' => 'User 2', 'email' => 'user2@test.com']);

// Check tenant files
ls database/tenants/  // Should show 2 .sqlite files
```

### Testing Shopify Webhooks Locally

Use ngrok or similar tool:
```bash
ngrok http 8000
# Use ngrok URL in Shopify webhook configuration
```

### Debugging YouTube API

```php
// Test in Tinker:
php artisan tinker

$service = new App\Services\YouTubeMetadataService();
$metadata = $service->fetchMetadata('dQw4w9WgXcQ');
dump($metadata);
```

---

## 🔗 External APIs Used

| Service | Purpose | Requires Auth | Rate Limit |
|---------|---------|---------------|------------|
| YouTube oEmbed | Fetch video metadata | No | None (public) |
| Shopify Cart | Checkout permalinks | Store domain | N/A |
| Shopify Webhooks | Payment notifications | HMAC verification | N/A |
| Google OAuth | User authentication | OAuth credentials | Standard OAuth limits |

---

**For more details, see the inline code documentation in each service class.**

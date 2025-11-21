# StudyTube Development Roadmap

## Project Overview
Multi-tenant Learning Management System using TALL Stack (Tailwind, Alpine.js, Laravel 12, Blade)

## Technology Constraints
- ✅ Laravel 12 (Latest Stable)
- ✅ Blade Templates + Alpine.js (NO Vue/React/TypeScript)
- ✅ Tailwind CSS v4
- ✅ SQLite Multi-Tenant Architecture
- ✅ FilamentPHP for Admin Panel

---

## Phase 1: Foundation & Setup
- [ ] 1.1 Fresh Laravel 12 Installation
- [ ] 1.2 Configure SQLite (Master DB)
- [ ] 1.3 Install Laravel Breeze (Blade Stack)
- [ ] 1.4 Install Tailwind CSS v4
- [ ] 1.5 Install Alpine.js

## Phase 2: Database Architecture (CRITICAL)
### Master Database (`database/database.sqlite`)
- [ ] 2.1 Create `users` migration (add uuid, google_id, is_admin, plan_id)
- [ ] 2.2 Create `plans` migration
- [ ] 2.3 Create `payment_providers` migration
- [ ] 2.4 Create corresponding Models

### Tenant Database (`database/tenants/user_{uuid}.sqlite`)
- [ ] 2.5 Create tenant migrations (topics, notes, learning_sessions)
- [ ] 2.6 Create tenant Models with custom connection
- [ ] 2.7 **CRITICAL:** Build `SetTenantDatabase` Middleware
- [ ] 2.8 **CRITICAL:** Create `UserCreated` Event Listener for tenant provisioning

## Phase 3: Authentication & Tenant Provisioning
- [ ] 3.1 Install Laravel Socialite
- [ ] 3.2 Configure Google OAuth
- [ ] 3.3 Implement tenant database factory on user registration
- [ ] 3.4 Test multi-tenancy isolation

## Phase 4: Monetization (Shopify Headless)
- [ ] 4.1 Create `ShopifyPaymentService`
- [ ] 4.2 Generate cart permalinks with user_uuid attribute
- [ ] 4.3 Create webhook endpoint `/webhooks/shopify`
- [ ] 4.4 Implement webhook signature verification
- [ ] 4.5 Handle `orders/paid` event and update plan_id
- [ ] 4.6 Build Premium subscription blade view

## Phase 5: Core Learning Features
### Topic Management
- [ ] 5.1 Create `YouTubeMetadataService`
- [ ] 5.2 Build Topic creation controller/routes
- [ ] 5.3 Auto-fetch video metadata (title, thumbnail)
- [ ] 5.4 Create Topic listing view

### Video Player & Timestamped Notes (Alpine.js)
- [ ] 5.5 Integrate YouTube IFrame Player API
- [ ] 5.6 Create Alpine.js `videoPlayer()` component
- [ ] 5.7 Track real-time playback position
- [ ] 5.8 Build Note creation form (capture timestamp)
- [ ] 5.9 Display notes with MM:SS timestamp formatting
- [ ] 5.10 Implement `seekTo(seconds)` function
- [ ] 5.11 Add topic completion toggle

### Learning Analytics
- [ ] 5.12 Track LearningSession start/end/duration
- [ ] 5.13 Display study statistics

## Phase 6: Admin Dashboard
- [ ] 6.1 Install FilamentPHP
- [ ] 6.2 Configure to use Master Database only
- [ ] 6.3 Create User resource
- [ ] 6.4 Create PaymentProvider resource

## Phase 7: Testing & Polish
- [ ] 7.1 Test multi-tenant isolation
- [ ] 7.2 Test payment flow end-to-end
- [ ] 7.3 Test video player interactions
- [ ] 7.4 Security audit
- [ ] 7.5 Performance optimization

---

## Architecture Notes

### Database Switching Flow
```
Request → Auth Middleware → SetTenantDatabase Middleware → Database switches to user_{uuid}.sqlite → Controller
```

### Tenant Provisioning Flow
```
User Registration → UserCreated Event → Listener generates UUID → Creates SQLite file → Runs tenant migrations
```

### Payment Flow
```
User clicks Subscribe → ShopifyPaymentService generates permalink → User pays on Shopify → Webhook fires → Plan updated in Master DB
```

### Video Player Flow
```
Alpine.js tracks getCurrentTime() → User clicks "Add Note" → Saves content + timestamp_seconds → Notes display → Click timestamp → seekTo(seconds)
```

---

## Current Status
🚀 **Starting development...**

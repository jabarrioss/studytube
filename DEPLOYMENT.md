# StudyTube Deployment Checklist

## Pre-Deployment

### Environment Configuration
- [ ] Set `APP_ENV=production` in .env
- [ ] Set `APP_DEBUG=false` in .env
- [ ] Configure `APP_URL` to production URL
- [ ] Generate new `APP_KEY` for production

### Database
- [ ] Ensure `database/tenants/` directory exists and is writable
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Seed plans: `php artisan db:seed --class=PlanSeeder`
- [ ] Backup master database regularly

### Google OAuth
- [ ] Create Google OAuth credentials for production domain
- [ ] Add production URL to authorized redirect URIs
- [ ] Update `GOOGLE_CLIENT_ID` and `GOOGLE_CLIENT_SECRET` in .env
- [ ] Set `GOOGLE_REDIRECT_URI` to production callback URL

### Shopify Configuration
- [ ] Create Shopify product for Premium subscription
- [ ] Get product variant ID and update `SHOPIFY_PREMIUM_VARIANT_ID`
- [ ] Configure Shopify webhook for `orders/paid` event
- [ ] Set webhook URL to `https://yourdomain.com/webhooks/shopify`
- [ ] Copy webhook secret to `SHOPIFY_WEBHOOK_SECRET` in .env
- [ ] Add payment provider in Filament admin panel

### Security
- [ ] Review and update CORS settings if needed
- [ ] Ensure CSRF protection is enabled
- [ ] Configure rate limiting for API routes
- [ ] Set up SSL certificate (HTTPS)
- [ ] Configure secure session settings

### Performance
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Optimize autoloader: `composer install --optimize-autoloader --no-dev`
- [ ] Build production assets: `npm run build`

### File Permissions
```bash
chmod -R 775 storage bootstrap/cache
chmod -R 775 database/tenants
```

### FilamentPHP Admin
- [ ] Create admin user: `php artisan filament:user`
- [ ] Test admin panel access at `/jabarrioss`
- [ ] Configure payment providers in admin panel

## Post-Deployment

### Testing
- [ ] Test user registration (email + Google OAuth)
- [ ] Verify tenant database is created on registration
- [ ] Test topic creation with YouTube URL
- [ ] Test video player and timestamped notes
- [ ] Test note seeking functionality
- [ ] Test premium subscription flow (if Shopify is configured)
- [ ] Test webhook endpoint with Shopify test events
- [ ] Verify multi-tenancy isolation

### Monitoring
- [ ] Set up error logging (Sentry, Bugsnag, etc.)
- [ ] Configure Laravel Telescope (optional)
- [ ] Monitor database size growth
- [ ] Set up backup automation for databases
- [ ] Monitor webhook delivery success rate

### Documentation
- [ ] Update README with production URLs
- [ ] Document Shopify webhook configuration
- [ ] Create admin user guide
- [ ] Document backup and restore procedures

## Maintenance

### Regular Tasks
- [ ] Monitor `database/tenants/` directory size
- [ ] Review application logs regularly
- [ ] Update dependencies: `composer update` (test first!)
- [ ] Backup master and tenant databases
- [ ] Monitor Shopify webhook failures

### Scaling Considerations
- [ ] Consider moving to PostgreSQL/MySQL for master DB
- [ ] Implement queue workers for background jobs
- [ ] Add Redis for caching and sessions
- [ ] Consider CDN for YouTube thumbnails
- [ ] Implement database sharding if user count grows

## Emergency Procedures

### Rollback
```bash
# Restore previous code version
git checkout <previous-commit>

# Restore database backup
cp database/database.sqlite.backup database/database.sqlite

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Database Recovery
```bash
# Master database
cp /path/to/backup/database.sqlite database/database.sqlite

# Tenant databases
cp -r /path/to/backup/tenants/* database/tenants/
```

## Notes

- Always test Shopify webhooks using Shopify's webhook testing tool
- Monitor tenant database creation rate for potential abuse
- Keep FilamentPHP credentials secure
- Regularly update Google OAuth and Shopify credentials
- Test payment flow in Shopify test mode before going live

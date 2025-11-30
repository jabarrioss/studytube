# Paddle Payment Integration Setup

This guide walks you through setting up Paddle payment integration for StudyTube Premium subscriptions.

## Prerequisites

- Active Paddle account (https://paddle.com)
- Verified business information in Paddle dashboard
- Access to your Paddle Seller Dashboard

## Step 1: Get Paddle Credentials

### 1.1 Seller ID
1. Log into your Paddle dashboard
2. Navigate to **Developer Tools** → **Authentication**
3. Copy your **Seller ID** (format: `12345`)

### 1.2 Client-Side Token
1. In Paddle dashboard, go to **Developer Tools** → **Authentication**
2. Under **Client-side tokens**, click **Create client-side token**
3. Give it a name (e.g., "StudyTube Production")
4. Copy the token (format: `live_xxx` or `test_xxx`)

### 1.3 API Key (Server-Side)
1. In Paddle dashboard, go to **Developer Tools** → **Authentication**
2. Under **API keys**, click **Create API key**
3. Give it a name (e.g., "StudyTube Backend")
4. Select permissions: **Read** and **Write** for subscriptions, customers, and transactions
5. Copy the API key (format: `pdl_xxx`)
6. **Store this securely** - it won't be shown again!

### 1.4 Webhook Secret
1. Go to **Developer Tools** → **Notifications**
2. Click **Create notification destination**
3. Enter your webhook URL: `https://yourdomain.com/webhooks/paddle`
4. Select events to listen for:
   - `subscription.created`
   - `subscription.updated`
   - `subscription.cancelled`
   - `subscription.paused`
   - `subscription.resumed`
   - `transaction.completed`
   - `transaction.updated`
5. Copy the **Webhook Secret Key** (format: `pdl_ntfset_xxx`)

## Step 2: Create Premium Product

### 2.1 Create Product
1. In Paddle dashboard, go to **Catalog** → **Products**
2. Click **Create Product**
3. Fill in details:
   - **Name**: StudyTube Premium
   - **Description**: Premium access to advanced features
   - **Tax category**: Select appropriate category (e.g., "SaaS")

### 2.2 Create Price
1. After creating the product, click **Add price**
2. Configure pricing:
   - **Billing cycle**: Monthly
   - **Price**: $5.00 USD
   - **Billing interval**: 1 month
   - **Trial period**: Optional (e.g., 7 days)
3. Click **Save**
4. **Copy the Price ID** (format: `pri_01jwxxxxxxxxxxxxxxxxxx`)

## Step 3: Configure Environment Variables

Update your `.env` file with the credentials:

```env
PADDLE_SELLER_ID=12345
PADDLE_CLIENT_SIDE_TOKEN=live_xxx_or_test_xxx
PADDLE_API_KEY=pdl_xxx_your_api_key
PADDLE_WEBHOOK_SECRET=pdl_ntfset_xxx_your_webhook_secret
PADDLE_SANDBOX=false
PADDLE_PREMIUM_PRICE_ID=pri_01jwxxxxxxxxxxxxxxxxxx
```

### Development/Testing
For testing, use Paddle Sandbox:
```env
PADDLE_SANDBOX=true
PADDLE_CLIENT_SIDE_TOKEN=test_xxx
# Use sandbox credentials
```

## Step 4: Test the Integration

### 4.1 Local Testing with ngrok
Since Paddle webhooks require a public URL:

```bash
# Install ngrok if not installed
npm install -g ngrok

# Start your Laravel app
php artisan serve

# In another terminal, expose your local server
ngrok http 8000
```

Copy the ngrok URL (e.g., `https://abc123.ngrok.io`) and update your Paddle webhook destination to `https://abc123.ngrok.io/webhooks/paddle`.

### 4.2 Test Subscription Flow
1. Register or log in to StudyTube
2. Navigate to `/subscription` or click "Upgrade to Premium"
3. Click "Subscribe to Premium - $5/month"
4. Complete test payment using Paddle test cards:
   - **Successful**: `4242 4242 4242 4242`
   - **Declined**: `4000 0000 0000 0002`
   - Use any future expiry date and any CVC
5. Verify subscription shows as active in your dashboard

### 4.3 Test Webhook Handling
1. In Paddle dashboard, go to **Developer Tools** → **Events & logs**
2. Find a recent subscription event
3. Click **Replay event** to resend webhook
4. Check your Laravel logs: `tail -f storage/logs/laravel.log`
5. Verify webhook was received and processed

## Step 5: Production Deployment

### 5.1 Update Environment
1. Deploy your code to production server
2. Set production environment variables (use `.env.example` as template)
3. Set `PADDLE_SANDBOX=false` for live transactions
4. Update Paddle webhook URL to production domain

### 5.2 Cache Configuration
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 5.3 Verify SSL Certificate
Paddle requires HTTPS for webhooks. Ensure your domain has a valid SSL certificate:
```bash
curl -I https://yourdomain.com
# Should return 200 OK with valid certificate
```

## Step 6: Monitor and Maintain

### 6.1 Check Webhook Status
Regularly verify webhooks are being delivered:
1. Go to **Developer Tools** → **Events & logs**
2. Check for failed deliveries
3. Replay failed events if needed

### 6.2 Monitor Subscriptions
- Review active subscriptions in Paddle dashboard
- Check for failed payments and follow up with customers
- Monitor churn rate and renewal rates

### 6.3 Handle Failed Payments
Paddle automatically retries failed payments. Configure retry settings:
1. Go to **Settings** → **Billing**
2. Configure **Payment retry schedule**
3. Set up **Dunning emails** for failed payments

## Troubleshooting

### Issue: Checkout overlay not showing
**Solution**: Verify `PADDLE_CLIENT_SIDE_TOKEN` is correct and Paddle.js is loaded:
```javascript
// Check in browser console
console.log(typeof Paddle); // Should output 'object'
```

### Issue: Webhooks not being received
**Solutions**:
1. Verify webhook URL is publicly accessible
2. Check webhook secret matches `.env` value
3. Check Laravel logs for errors: `tail -f storage/logs/laravel.log`
4. Verify webhook destination is active in Paddle dashboard

### Issue: Subscription not activating after payment
**Solutions**:
1. Check `customers` and `subscriptions` tables in database
2. Verify webhook events are being received
3. Check that Price ID matches between Paddle and `.env`
4. Review Laravel queue jobs: `php artisan queue:failed`

### Issue: "Invalid API key" error
**Solutions**:
1. Regenerate API key in Paddle dashboard
2. Update `.env` with new key
3. Run `php artisan config:clear` and `php artisan config:cache`
4. Verify API key has necessary permissions

## Testing Checklist

Before going live, test these scenarios:

- [ ] New user can subscribe to Premium
- [ ] Subscription shows as active after payment
- [ ] User can access Premium features
- [ ] User can cancel subscription
- [ ] Cancelled subscription remains active until period end
- [ ] User can resume cancelled subscription
- [ ] Expired subscription downgrades to Free plan
- [ ] Failed payment triggers retry and notification
- [ ] Webhooks are received and processed correctly
- [ ] Transaction history displays correctly
- [ ] Invoice URLs are accessible

## Additional Resources

- [Laravel Cashier Paddle Documentation](https://laravel.com/docs/11.x/cashier-paddle)
- [Paddle API Documentation](https://developer.paddle.com/api-reference)
- [Paddle Webhooks Guide](https://developer.paddle.com/webhooks/overview)
- [Paddle Test Cards](https://developer.paddle.com/concepts/payment-methods/credit-debit-card#test-card-numbers)

## Support

For Paddle-specific issues:
- Paddle Support: support@paddle.com
- Paddle Developer Community: https://developer.paddle.com/community

For StudyTube integration issues:
- Check Laravel logs: `storage/logs/laravel.log`
- Review Paddle Events & logs in dashboard
- Contact your development team

# StudyTube - Quick Start Guide

## 🚀 Get Started in 5 Minutes

### Step 1: Dependencies Already Installed ✅
All Composer and NPM packages are already installed.

### Step 2: Start the Development Server

```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

### Step 3: Create Your First Account

**Option A: Email Registration**
1. Visit http://localhost:8000/register
2. Fill in name, email, password
3. Click "Register"

**Option B: Google OAuth** (requires configuration)
1. Visit http://localhost:8000/login
2. Click "Sign in with Google"
3. Authorize the application

### Step 4: Add Your First Learning Topic

1. After login, you'll see "My Learning Topics"
2. Click "Add New Topic"
3. Paste any YouTube URL (e.g., `https://www.youtube.com/watch?v=dQw4w9WgXcQ`)
4. Click "Add Topic"

### Step 5: Take Timestamped Notes

1. Click on your topic to open the video player
2. Play the video to the point where you want to add a note
3. Type your note in the text area below the video
4. Click "Add Note" - the timestamp is automatically captured!
5. Click on the timestamp in the sidebar to jump back to that moment

---

## 🎬 Demo Workflow

```
Register → Login → Add Topic (YouTube URL) → 
Watch Video → Add Timestamped Notes → 
Click Note Timestamps to Seek Video
```

---

## 🔧 Configuration (Optional)

### For Google OAuth:
1. Get credentials from Google Cloud Console
2. Add to `.env`:
```env
GOOGLE_CLIENT_ID=your_id
GOOGLE_CLIENT_SECRET=your_secret
```

### For Shopify Payments:
1. Set up Shopify store and product
2. Add to `.env`:
```env
SHOPIFY_DOMAIN=your-store.myshopify.com
SHOPIFY_PREMIUM_VARIANT_ID=variant_id
SHOPIFY_WEBHOOK_SECRET=your_secret
```

---

## 👨‍💼 Access Admin Panel

**URL:** http://localhost:8000/jabarrioss

**Login with the admin credentials you created during setup.**

### What you can do:
- View all users and their UUIDs
- See which users are on premium plans
- Configure Shopify payment provider settings
- Manage user accounts

---

## 📊 What's Happening Behind the Scenes

When you register:
1. ✅ User account created in master database
2. ✅ UUID automatically generated
3. ✅ Tenant database created at `database/tenants/user_{your_uuid}.sqlite`
4. ✅ Tenant migrations run automatically

When you add a topic:
1. ✅ YouTube video ID extracted from URL
2. ✅ Video metadata fetched (title, thumbnail)
3. ✅ Topic saved to YOUR tenant database

When you add a note:
1. ✅ Current video timestamp captured
2. ✅ Note saved with timestamp_seconds
3. ✅ Formatted as MM:SS for display

---

## 🔍 Verify Multi-Tenancy

Register 2-3 users, then check:

```bash
ls database/tenants/
```

You should see multiple `.sqlite` files:
```
user_abc-123-def.sqlite
user_xyz-789-ghi.sqlite
```

Each user's learning data is completely isolated!

---

## 💡 Tips

- **YouTube URLs:** Any format works (watch?v=, youtu.be/, embed/)
- **Notes:** Add as many as you want - they're sorted by timestamp
- **Timestamps:** Click any note timestamp to jump to that moment
- **Completion:** Mark topics complete when finished
- **Premium:** Visit `/premium` to see the subscription page

---

## 🆘 Troubleshooting

**"Table not found" error?**
- Your tenant database may not have been created
- Check `database/tenants/` directory
- Run migrations manually if needed

**YouTube video not loading?**
- Check the YouTube URL is valid
- Ensure you have internet connection
- Try a different video

**Google login not working?**
- You need to configure Google OAuth credentials
- See INTEGRATION.md for setup details

---

## 📚 Learn More

- **Full Features:** See `README.md`
- **Architecture:** See `SUMMARY.md`
- **Deployment:** See `DEPLOYMENT.md`
- **APIs:** See `INTEGRATION.md`

---

## ✨ Key Features to Try

1. **Multiple Topics:** Add several YouTube videos
2. **Rich Notes:** Take detailed notes with timestamps
3. **Quick Navigation:** Click timestamps to jump around the video
4. **Topic Management:** Mark completed, delete unwanted topics
5. **Premium Page:** Check out the subscription features

---

**Enjoy learning with StudyTube! 📚🎥**

# Yarnly

**Yarnly** is a full-stack social platform for yarn crafters — the place where crochet, knitting, and embroidery enthusiasts discover patterns, share finished projects, follow inspiring makers, and build their crafting portfolio. Built as a graduation project using Laravel 12.

---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Database Schema](#database-schema)
- [Authentication & Security](#authentication--security)
- [Roles & Permissions](#roles--permissions)
- [Notifications](#notifications)
- [Privacy Controls](#privacy-controls)
- [Internationalisation](#internationalisation)
- [Appearance & Theming](#appearance--theming)
- [Admin Panel](#admin-panel)
- [Installation](#installation)
- [Environment Variables](#environment-variables)
- [Running the Application](#running-the-application)
- [Running Tests](#running-tests)
- [License](#license)

---

## Overview

Yarnly is a community-driven platform inspired by the social mechanics of Instagram and Pinterest, tailored specifically for fibre artists. Users can:

- Browse thousands of crochet, knitting, and embroidery patterns with PDF downloads.
- Share photos of their finished projects in a public gallery.
- Follow other crafters and receive real-time in-app notifications.
- Organise their favourite patterns into themed collections.
- Customise their profile with an avatar, bio, accent colour, and theme preference.
- Switch the entire UI between **English** and **Bulgarian**.

---

## Features

### Pattern Library

- Three craft types: **Crochet**, **Knitting**, **Embroidery**.
- Per-craft subcategories:
  - Crochet — Blankets & Throws, Amigurumi, Bags & Totes, Wearables, Home Decor
  - Knitting — Wearables, Accessories, Home & Decor, Toys, Baby & Kids
  - Embroidery — Clothing Embroidery, Hoop Art & Wall Decor, Cross Stitch, Hand Techniques
- Filter patterns by category, difficulty, estimated hours, and sort order.
- PDF upload (max 10 MB) with an in-browser PDF viewer.
- Cover image upload (max 5 MB, PNG/JPG).
- Difficulty levels: Beginner, Intermediate, Advanced — each with a distinct badge colour.
- "Makers saved" counter incremented when a user favourites a pattern.
- Authors are notified when followers discover newly uploaded patterns.

### Community Gallery

- Post finished projects with up to **10 images** (JPEG/PNG/WebP, max 5 MB each).
- Attach a craft type, description, and comma-separated tags.
- **Like** and **save/bookmark** any post.
- Full comment thread on each post.
- Gallery tabs: **Recently Added**, **Top Rated**, **Following** (auth required).
- Search across models, crafters, and tags.
- Guest users are prompted to log in via a modal instead of a hard redirect.

### Collections

- Group your own uploaded patterns into named, themed collections.
- Set visibility to **Public** (browsable by anyone) or **Private** (only visible to yourself).
- Optional cover image per collection; falls back to the first pattern's image.
- Filter collections by craft type (crochet / knitting / embroidery).
- Followers are notified when you publish a new public collection.
- Favourite other users' public collections.
- Download all PDFs in a collection in one action.

### User Profiles

- My Profile page with tabs: Posts, Saved, Liked, Patterns, Collections.
- Public User Profile respects the owner's privacy preferences.
- Short **bio** (max 200 characters) displayed beneath the user's name.
- Customisable **avatar colour** — hex colour picker with preset swatches.
- Upload a profile picture (jpg/jpeg/png/gif/webp, max 5 MB).
- Follower / following counts with follow/unfollow button.
- Post, follower, and following statistics in the profile header.

### Social / Follow System

- Follow and unfollow any user.
- Following feed in the gallery shows only posts from people you follow.
- Follower and following lists are tracked via a `follows` pivot table.

### Personal Dashboard

- Quick stats: total patterns, posts, followers, following.
- Activity summary: likes received, comments received, comments given, patterns saved.
- "This Week" breakdown: new likes, new comments, new followers.
- Lists of your 5 most recent patterns and 4 most recent posts.
- Quick links to favourited patterns, liked posts, saved posts.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Language | PHP 8.2+ |
| Framework | Laravel 12 |
| Auth | Laravel Fortify (email verification, 2FA TOTP) |
| Frontend components | Livewire Flux + Livewire Volt |
| Reactive UI | Alpine.js 3 |
| CSS | Tailwind CSS 4 |
| Build tool | Vite 7 |
| Database | MySQL / MariaDB |
| File storage | Local disk (`storage/app/public`) |
| Queue | Database queue driver |
| Testing | Pest 4 + pest-plugin-laravel |
| Code style | Laravel Pint |

---

## Project Structure

```
yarnly/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/                   # Fortify auth controllers
│   │   │   ├── CollectionController.php
│   │   │   ├── FollowController.php
│   │   │   ├── NotificationController.php
│   │   │   ├── PatternController.php
│   │   │   ├── PostController.php
│   │   │   ├── PostCollectionController.php
│   │   │   ├── ProfileController.php
│   │   │   └── SearchController.php
│   │   ├── Middleware/
│   │   │   └── SetLocale.php           # Applies locale from cookie
│   │   └── Requests/
│   │       └── ProfileUpdateRequest.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Pattern.php
│   │   ├── Post.php
│   │   ├── PostImage.php
│   │   ├── PostLike.php
│   │   ├── PostComment.php
│   │   ├── PostFavorite.php
│   │   ├── PostCollection.php
│   │   └── Collection.php
│   ├── Notifications/                  # 6 notification classes
│   ├── Providers/
│   │   ├── AppServiceProvider.php
│   │   ├── FortifyServiceProvider.php
│   │   └── VoltServiceProvider.php
│   └── Services/
│       ├── NotificationPreferenceService.php
│       └── PrivacyPreferenceService.php
├── database/
│   ├── migrations/                     # 19 migration files
│   ├── factories/
│   └── seeders/
├── lang/
│   ├── bg.json                         # All Bulgarian translations (single file)
│   └── bg/                             # Blade-based BG string overrides
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       ├── adminPanel/                 # Admin dashboard + manage users
│       ├── auth/                       # Login, register, 2FA, password reset
│       ├── collections/                # Create, select patterns, view
│       ├── dashboard.blade.php         # User personal dashboard
│       ├── gallery/                    # Main gallery, create post, show post
│       ├── homepage/                   # Public landing page
│       ├── notifications/              # Notifications index
│       ├── patterns/                   # crochet/, knitting/, embroidery/
│       ├── profile/
│       │   ├── myprofile/              # show.blade.php, edit.blade.php
│       │   └── user/                   # Public user profile show.blade.php
│       └── partials/                   # auth-modal, shared snippets
├── routes/
│   ├── web.php
│   └── auth.php
└── tests/
    ├── Feature/
    └── Unit/
```

---

## Database Schema

### `users`

| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | |
| `name` | varchar | Full display name |
| `bio` | varchar(200) | nullable |
| `username` | varchar | unique, nullable |
| `email` | varchar | unique |
| `email_verified_at` | timestamp | nullable |
| `role` | enum | `admin` or `user` (default `user`) |
| `password` | varchar | bcrypt hashed |
| `profile_picture` | varchar | nullable, path in public storage |
| `avatar_color` | varchar(7) | nullable, hex colour e.g. `#7c3aed` |
| `theme_preference` | varchar | default `dark` |
| `two_factor_secret` | text | nullable (Fortify 2FA) |
| `two_factor_recovery_codes` | text | nullable |
| `remember_token` | varchar | |
| `created_at` / `updated_at` | timestamp | |

### `patterns`

| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | |
| `title` | varchar | |
| `description` | text | nullable |
| `craft_type` | varchar | `crochet`, `knitting`, or `embroidery` |
| `category` | varchar | subcategory slug |
| `difficulty` | varchar | `beginner`, `intermediate`, or `advanced` |
| `estimated_hours` | int | nullable |
| `tags` | varchar | comma-separated |
| `pdf_file` | varchar | storage path |
| `original_filename` | varchar | original upload name |
| `image_path` | varchar | nullable |
| `makers_saved` | int | default 0 |

### `posts`

| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | |
| `description` | text | nullable |
| `craft_type` | varchar | |
| `tags` | varchar | nullable, comma-separated |

### `post_images`
Stores up to 10 images per post with an `order` column for display sequence.

### `follows`
Pivot table (`follower_id`, `following_id`) that tracks the social graph between users.

### `post_likes`, `post_favorites`
Pivot tables linking users to posts for likes and saves respectively.

### `user_favorites`
Pivot table linking users to their favourite patterns.

### `collection_favorites`
Pivot table linking users to their favourite collections.

### `collections`
User-created pattern collections with `name`, `description`, `cover_image`, `is_public` flag, and `craft_type`.

### `collection_pattern`
Pivot table linking collections to their included patterns.

### `notifications`
Laravel's default polymorphic notifications table. Stores all six notification types as JSON `data` blobs alongside `notifiable_id`, `notifiable_type`, and `read_at`.

---

## Authentication & Security

Authentication is handled entirely by **Laravel Fortify**, providing:

- **Registration** with name, username, email, and email verification.
- **Login** with "Remember me" and session management.
- **Password reset** via signed email link.
- **Email verification** — protected routes require a verified email.
- **Two-Factor Authentication (TOTP)** — users can enable/disable 2FA from the Settings page. QR code scanning or manual key entry supported, plus printable recovery codes.
- **Password confirmation gate** for sensitive actions (account deletion, 2FA management).

All file uploads are validated server-side for MIME type and max size. PDFs are served through a controller action rather than direct public URLs, allowing access control to be enforced on downloads.

---

## Roles & Permissions

Two roles exist: `user` (default) and `admin`.

- **Users** can manage their own content — patterns, posts, collections, and profile.
- **Admins** have access to `/admin/dashboard` and `/admin/users`.
- Admins can promote/demote other users and delete accounts.
- An admin **cannot** change their own role or delete their own account (enforced server-side).
- Role checks are applied with `middleware(['auth', 'verified'])` and inline `Auth::user()->role` checks on admin routes.

---

## Notifications

Six distinct in-app notification types, each backed by a dedicated Laravel Notification class:

| Event | Class |
|---|---|
| Someone follows you | `NewFollowNotification` |
| Someone likes your post | `NewLikeNotification` |
| Someone comments on your post | `NewCommentNotification` |
| A followed user publishes a post | `NewPostFromFollowedNotification` |
| A followed user uploads a pattern | `NewPatternFromFollowedNotification` |
| A followed user creates a collection | `NewCollectionFromFollowedNotification` |

- Notifications are stored in the database and displayed via a bell icon in the navigation bar with an unread count badge.
- **Mark all as read** action on the notifications page.
- Each notification type can be individually disabled per-user via the **Notification Preferences** settings panel.
- Preferences are persisted as JSON files in `storage/app/notification_prefs/{userId}.json`.

---

## Privacy Controls

Five independent toggle settings, persisted as JSON files in `storage/app/privacy_prefs/{userId}.json`:

| Setting | Default | Effect when off |
|---|---|---|
| Searchable profile | On | Profile hidden from search and explore results |
| Show liked posts | On | Liked posts tab hidden on public profile |
| Show saved posts | On | Saved posts tab hidden on public profile |
| Show saved patterns | On | Favourited patterns tab hidden on public profile |
| Show saved collections | On | Saved collections tab hidden on public profile |

---

## Internationalisation

- Full UI available in **English** (default) and **Bulgarian**.
- Language selection saved per-user as a `locale` cookie; guests always see English.
- All translation strings live in a single `lang/bg.json` file covering every UI label across all pages.
- The `SetLocale` middleware reads the `locale` cookie and calls `App::setLocale()` on every request.
- Pluralisation is handled with explicit ternary expressions in Blade templates to avoid broken plural forms (e.g. "публикации" vs "публикация").

---

## Appearance & Theming

User appearance preferences are stored in the database and applied on every page load:

- **Colour mode**: Dark, Light, or System — toggles the Tailwind dark class.
- **Accent colour**: Default (violet), Indigo, Rose, Emerald, Amber, Sky — applied as a CSS variable.
- **Font size**: Small (compact), Medium (default), Large (comfortable) — applied as a `text-size` CSS variable.
- All preference changes are saved immediately via a dedicated settings form under **Settings → Appearance**.

---

## Admin Panel

### Dashboard (`/admin/dashboard`)

Live platform statistics at a glance:

- Total users, new users this month, new users today, admin count.
- Total patterns, new patterns this month, patterns grouped by craft type.
- Total posts, new posts this month, posts grouped by craft type.
- Total collections (new this month), total likes, total comments.
- Table of the 10 most recently joined users.
- Table of the 15 most recently uploaded patterns.

### Manage Users (`/admin/users`)

- Search by name or email address.
- Filter by role (all / user / admin).
- Sort by: newest (default), oldest, name A–Z, most patterns, most posts.
- Paginated results (20 per page) with user pattern/post counts.
- One-click **Promote to Admin** / **Revoke Admin** toggle per user.
- **Delete User** with confirmation, guarded against self-deletion.

---

## Installation

### Prerequisites

- PHP 8.2 or higher with extensions: `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `gd`
- [Composer](https://getcomposer.org)
- [Node.js](https://nodejs.org) 18+ and npm
- MySQL 8+ or MariaDB 10.4+

### Steps

**1. Clone the repository**

```bash
git clone https://github.com/your-username/yarnly.git
cd yarnly
```

**2. Install PHP dependencies**

```bash
composer install
```

**3. Install Node dependencies**

```bash
npm install
```

**4. Copy the environment file**

```bash
cp .env.example .env
```

**5. Generate the application key**

```bash
php artisan key:generate
```

**6. Configure your database** in `.env`, then run migrations:

```bash
php artisan migrate
```

**7. Create the public storage symlink**

```bash
php artisan storage:link
```

**8. Build frontend assets**

```bash
npm run build
```

---

## Environment Variables

Key variables to set in your `.env` file:

```dotenv
APP_NAME=Yarnly
APP_ENV=local
APP_KEY=                         # Generated by php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yarnly
DB_USERNAME=root
DB_PASSWORD=

CACHE_STORE=file
SESSION_DRIVER=database
QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS="noreply@yarnly.com"
MAIL_FROM_NAME="Yarnly"

FILESYSTEM_DISK=local
```

> Email verification and password reset require a working SMTP provider. Use [Mailtrap](https://mailtrap.io), [Mailgun](https://www.mailgun.com), or [Resend](https://resend.com) for development.

---

## Running the Application

### Development — all services at once

The `composer dev` script runs the Laravel server, queue worker, log watcher, and Vite dev server concurrently:

```bash
composer dev
```

Or with npm:

```bash
npm run dev-all
```

### Production

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan serve
```

### Queue worker (required for notifications)

The notification system dispatches jobs to the database queue. Run a worker:

```bash
php artisan queue:listen --tries=1
```

---

## Running Tests

Yarnly uses **Pest** for testing.

```bash
php artisan test
```

Or via Composer:

```bash
composer test
```

---

## License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).

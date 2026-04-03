# Yarnly

**Yarnly** is a full-stack social platform for yarn crafters — the place where crochet, knitting, and embroidery enthusiasts discover patterns, share finished projects, follow inspiring makers, and build their crafting portfolio. Built as a graduation project using **Laravel 12** with a Livewire + Alpine.js frontend.

---

## Table of Contents

- [Overview](#overview)
- [Application Pages & User Journeys](#application-pages--user-journeys)
- [Features In Depth](#features-in-depth)
  - [Pattern Library](#pattern-library)
  - [Community Gallery](#community-gallery)
  - [Post Collections (Albums)](#post-collections-albums)
  - [Pattern Collections](#pattern-collections)
  - [User Profiles](#user-profiles)
  - [Social Follow System](#social-follow-system)
  - [Personal Dashboard](#personal-dashboard)
  - [Notifications](#notifications)
  - [Privacy Controls](#privacy-controls)
  - [Appearance & Theming](#appearance--theming)
  - [Internationalisation](#internationalisation)
  - [Admin Panel](#admin-panel)
- [Tech Stack](#tech-stack)
- [Architecture & Design Decisions](#architecture--design-decisions)
- [Project Structure](#project-structure)
- [Route Map](#route-map)
- [Database Schema](#database-schema)
- [Eloquent Models & Relationships](#eloquent-models--relationships)
- [Authentication & Security](#authentication--security)
- [Roles & Permissions](#roles--permissions)
- [Services](#services)
- [Installation](#installation)
- [Environment Variables](#environment-variables)
- [Running the Application](#running-the-application)
- [Running Tests](#running-tests)
- [License](#license)

---

## Overview

Yarnly solves a real problem for the fibre arts community: before Yarnly, crafters had to spread themselves across Pinterest (patterns), Instagram (sharing projects), and spreadsheets (organising collections). Yarnly brings all of that into one cohesive, community-driven space.

**Core pillars:**

| Pillar | What it means for the user |
|---|---|
| Discover | Browse a curated, searchable library of crochet, knitting, and embroidery patterns with PDF downloads |
| Create | Upload your own patterns (PDF + cover image) and share them with the community |
| Share | Post photos of finished projects, get likes and comments, build a public portfolio |
| Connect | Follow makers you find inspiring, see only their posts in your personal feed |
| Organise | Curate your saved patterns into named collections grouped by craft type |
| Personalise | Choose your colour scheme, font size, language, and profile appearance |

---

## Application Pages & User Journeys

### Guest (unauthenticated) journey

1. Lands on the **Homepage** (`/`) — animated hero, platform stats (total patterns / users / posts), feature highlights, how-it-works walkthrough, and a live creator search bar.
2. Visits any of the three **Pattern Library** pages (`/patterns/crochet`, `/patterns/knitting`, `/patterns/embroidery`) — browses newest patterns, filters by subcategory, views a pattern's details and reads it in the in-browser PDF viewer.
3. Visits the **Gallery** (`/models/gallery`) — sees all community posts, can search; if they click **Following** or try to like/comment, a login/register modal slides in instead of a redirect.
4. Clicks **Log in** or **Create account** — taken to `/login` or `/register`.

### Authenticated user journey

1. After login → **Dashboard** (`/dashboard`) — personal activity overview.
2. **Create a pattern** → `/patterns/create` — fill in the form, upload a PDF and image.
3. **Create a post** → `/gallery/posts/create` — upload up to 10 project photos.
4. **View their profile** → `/profile` — see all their posts, saved/liked content, patterns they uploaded, and collections they created.
5. **Visit another user's profile** → `/users/{username}` — follow/unfollow, view their public content according to their privacy settings.
6. **Settings** → `/settings` — manage password, email, 2FA, notification preferences, privacy, appearance, and language.
7. **Notifications** → `/notifications` — view all activity, click any notification to go to the relevant resource.

---

## Features In Depth

### Pattern Library

The pattern library is split into three top-level craft pages, each with its own URL, view, and category system. The `PatternController` serves six public endpoints — one listing and one category-filtered view per craft type.

**Subcategory taxonomy:**

| Craft | Subcategories |
|---|---|
| Crochet | Blankets & Throws, Amigurumi, Bags & Totes, Wearables, Home Decor |
| Knitting | Wearables, Accessories, Home & Decor, Toys, Baby & Kids |
| Embroidery | Clothing Embroidery, Hoop Art & Wall Decor, Cross Stitch, Hand Techniques |

**What each craft page shows:**
- A "New this week" counter (patterns published within the current calendar week).
- A "Your queue" counter (the authenticated user's saved patterns of that craft type).
- A "Newest" grid (up to 30 most recent patterns).
- A horizontal category filter bar — clicking a category re-renders the page with filtered results via a `GET` parameter route.
- A "Community Sets" section showing public collections for that craft type.

**Pattern detail & download:**
- `GET /patterns/{id}/view` — renders the PDF in an `<iframe>` inside the app's layout (no raw file URL exposed).
- `GET /patterns/{id}/download` — streams the file via `response()->download()` using the `original_filename` so the user gets a human-readable filename.
- PDFs are stored in `storage/app/public/patterns/pdfs/` and cover images in `storage/app/public/patterns/images/`.

**Creating a pattern** (`POST /patterns`):
- Server-side validation: PDF must be `application/pdf`, max 10 MB; image must be PNG/JPG, max 5 MB.
- MIME type is double-checked with `getMimeType()` after the initial extension check.
- Tags are sanitised: trimmed, deduplicated, stripped of leading `#`, max 50 characters each, max 500 characters total.
- After storing, all of the author's followers receive a `NewPatternFromFollowedNotification`.
- A per-user limit of 25 active patterns is enforced before the form is even shown.

**Difficulty badge colours:**

| Difficulty | Badge colour |
|---|---|
| Beginner | Green |
| Intermediate | Amber/yellow |
| Advanced | Red |

---

### Community Gallery

The gallery (`/models/gallery`) is the main social feed of the platform.

**Tabs:**
- **Recently Added** — all posts ordered by `created_at` descending.
- **Top Rated** — ordered by like count descending.
- **Following** — only posts from users the authenticated user follows. Guests who click this tab see the login modal.

**Search:** A live AJAX search bar (`/search/users`) queries users by name or `@username`, returning JSON with profile picture, avatar colour, initials, and a link to their profile. Results respect the `searchable_profile` privacy setting.

**Post search:** The gallery search bar also accepts free text and filters the visible grid client-side by tag, description, and creator username using Alpine.js.

**Liking a post:**
- `POST /posts/{id}/like` / `DELETE /posts/{id}/like` — toggled on the gallery and post detail page.
- Current user must be authenticated. The author receives a `NewLikeNotification` (subject to their notification preferences).

**Saving/bookmarking a post:**
- `POST /posts/{id}/favorite` / `DELETE /posts/{id}/favorite`.
- Saved posts appear in the user's profile "Saved" tab and can be organised into **Post Collections**.

**Comments:**
- On the post detail page (`/gallery/posts/{id}`), comments load via `GET /posts/{id}/comments` returning JSON.
- New comments are submitted via `POST /posts/{id}/comments`; validated to `required|string|max:500`.
- The author receives a `NewCommentNotification`.
- Comment JSON response includes: `body`, `author` name, `initials`, `avatar` URL, `avatar_color`, and a human-readable `created_at` (e.g. "2 hours ago").

**Creating a post** (`POST /gallery/posts`):
- Upload 1–10 images (JPEG/PNG/WebP, max 5 MB each). Each image is stored in `storage/app/public/posts/` and linked to the post via `post_images` with an `order` column preserving the upload sequence.
- `tags` are stored as a comma-separated string and parsed into an array by `$post->tags_array` (strips leading `#`, filters empty entries).
- After creation, all followers receive a `NewPostFromFollowedNotification`.

**Deleting a post:** `DELETE /gallery/posts/{id}` — only the post owner can delete; also deletes all associated `PostImage` records and their files from storage.

---

### Post Collections (Albums)

Users can organise their **saved** posts into named bookmark albums called Post Collections.

- Create, rename, and delete post collections from the profile's Saved tab.
- Add/remove a saved post to/from a collection via a popover picker shown on each post card.
- Post collections are per-user and always private (they are personal bookmark groups, not shared with others).
- Displayed on the profile page under a dedicated "Collections" sub-tab within the Saved tab.

---

### Pattern Collections

Pattern collections are **shareable themed sets** of patterns that a user creates from their own uploaded patterns.

**Creation flow (two-step):**

1. **Step 1 — Select Patterns** (`/collections/select-patterns`): The user sees a grid of their own patterns with checkboxes. They select one or more and click "Continue to Collection Details". Can also add to an existing collection at this step.
2. **Step 2 — Collection Details** (`/collections/create`): Fill in name (required, max 255), description (optional, max 1000), craft type, visibility (public/private), and an optional cover image (JPEG/PNG/GIF, max 5 MB).

**Collections on pattern pages:**
- Each craft page shows a "Community Sets" grid of up to 30 public collections for that craft type, with the creator's avatar, name, and pattern count.

**Collection detail page** (`/collections/{id}`):
- Shows all patterns in the collection with their difficulty badge, "makers saved" count, and individual download links.
- A "Download All Patterns" button streams a zip-style download of all PDFs (or links each individually).
- Edit and delete controls are shown only to the collection owner.

**Favouriting collections:**
- Any authenticated user can favourite another user's public collection via `POST /collections/{id}/favorite`.
- Favourited collections appear in the user's profile "Saved" tab.
- After a new public collection is created, all of the author's followers receive a `NewCollectionFromFollowedNotification`.

---

### User Profiles

#### My Profile (`/profile`)

The authenticated user's own profile, rendered by `ProfileController@show`, with the following tabs:

| Tab | Content |
|---|---|
| Posts | All posts the user has shared, ordered by newest first |
| Saved | Saved/bookmarked posts, organised optionally into post collections |
| Liked | Posts the user has liked |
| Patterns | All patterns the user has uploaded |
| Collections | Pattern collections the user has created |

Additional "saved" sub-sections visible on the profile page:
- Favourite Patterns (patterns saved to the `user_favorites` pivot)
- Favourite Collections (collections saved to the `collection_favorites` pivot)

**Profile header data:**
- Profile picture (uploaded image or auto-generated initials avatar with the chosen `avatar_color`).
- Display name and `@username`.
- Short bio (max 200 characters, shown only when set).
- Posts count, Followers count, Following count.

#### Edit Profile (`/profile/edit`)

Fields editable:
- **Profile picture** — stored in `storage/app/public/profile_pictures/`, max 5 MB, jpg/jpeg/png/gif/webp.
- **Full name** (`name`, required, max 255).
- **Bio** (`bio`, optional, max 200 characters) — Alpine.js live character counter in the form.
- **Email** — changing email triggers re-verification.
- **Avatar colour** — hex colour input with 6 preset swatches (violet, indigo, rose, emerald, amber, sky) and a free-form hex picker. Falls back to `#7c3aed` (violet) when not set.

#### Public User Profile (`/users/{user}`)

Rendered by a separate view (not the same as My Profile) and controlled by the owner's privacy settings:

- Follow / Unfollow button with live follower count update via JSON response.
- The follow action dispatches `NewFollowNotification` to the followed user.
- Self-follow is guarded: returns a 422 JSON error if the user tries to follow themselves.
- Tabs visible to visitors depend on the owner's privacy preferences (`show_liked_posts`, `show_saved_posts`, etc.).

---

### Social Follow System

Implemented with a `follows` pivot table (`follower_id`, `following_id`) and two methods on the `User` model:

- `$user->follow(User $target)` — inserts a record, triggers notification.
- `$user->unfollow(User $target)` — deletes the record.
- `$user->isFollowing(User $target)` — boolean check.
- `$user->followers()` — `BelongsToMany` via `follows.following_id`.
- `$user->following()` — `BelongsToMany` via `follows.follower_id`.

Follow/unfollow requests respond with JSON (`{ following: bool, followers_count: int }`) when the request expects JSON, enabling the profile button to update without a page reload using Alpine.js.

---

### Personal Dashboard

The `/dashboard` route (auth + verified) computes and passes to the view:

| Variable | Description |
|---|---|
| `patternsCount` | Total patterns uploaded by the user |
| `postsCount` | Total posts shared by the user |
| `followersCount` | Total followers |
| `followingCount` | Total users followed |
| `likesReceived` | Lifetime likes on all the user's posts |
| `commentsReceived` | Lifetime comments on all the user's posts |
| `commentsGiven` | Comments the user has left on others' posts |
| `patternsSaved` | Sum of times the user's posts were saved + times their patterns were favourited |
| `patternsThisMonth` | Patterns uploaded in the current calendar month |
| `postsThisMonth` | Posts shared in the current calendar month |
| `likesThisWeek` | Likes on the user's posts since the start of the current week |
| `commentsThisWeek` | Comments on the user's posts since the start of the current week |
| `followersThisWeek` | New followers gained since the start of the current week |
| `recentPatterns` | 5 most recently uploaded patterns |
| `recentPosts` | 4 most recently shared posts (with images eager-loaded) |

---

### Notifications

#### Storage

Notifications use Laravel's built-in **database notification channel**. Each notification is stored as a row in the `notifications` table with:
- `id` — UUID string.
- `type` — fully-qualified PHP class name.
- `notifiable_type` / `notifiable_id` — polymorphic relationship to `App\Models\User`.
- `data` — JSON blob containing the message text and a `url` for the redirect.
- `read_at` — null until marked as read.

#### Delivery

All six notification classes implement `via()` returning `['database']`. Each builds a `toDatabase()` payload:

```php
// Example: NewLikeNotification
return [
    'message' => ":name liked your post.",
    'url'     => route('gallery.posts.show', $this->post->id),
    'actor'   => $this->actor->name,
];
```

#### Bell & unread count

The navigation bar bell icon queries `Auth::user()->unreadNotifications->count()` to show a badge. Visiting `/notifications` automatically marks all unread notifications as read via `$user->unreadNotifications->markAsRead()`.

Clicking an individual notification at `/notifications/{id}/mark-read` marks it read and redirects to `data.url`.

#### Preference gating

Before dispatching any notification, each notification class checks:

```php
app(NotificationPreferenceService::class)->check($notifiable, 'notify_likes')
```

If the preference is off, `via()` returns an empty array and the notification is silently skipped. Preferences are stored as JSON in `storage/app/notification_prefs/{userId}.json` with all keys defaulting to `true`.

---

### Privacy Controls

Privacy preferences are stored per-user as JSON in `storage/app/privacy_prefs/{userId}.json` and managed by `PrivacyPreferenceService`.

| Key | Default | When `false` |
|---|---|---|
| `searchable_profile` | `true` | User excluded from `/search/users` JSON results |
| `show_liked_posts` | `true` | "Liked" tab hidden on the user's public profile |
| `show_saved_posts` | `true` | "Saved" tab hidden on the user's public profile |
| `show_saved_patterns` | `true` | Favourite patterns section hidden on public profile |
| `show_saved_collections` | `true` | Favourite collections section hidden on public profile |

Both services (`NotificationPreferenceService` and `PrivacyPreferenceService`) follow the same pattern:
- `get(object $user): array` — reads JSON file, merges with defaults so missing keys always return a value.
- `save(int $userId, array $prefs): void` — validates only known keys, casts to bool, writes JSON.
- `check(object $user, string $key): bool` — convenience wrapper for a single key.

---

### Appearance & Theming

All appearance settings are stored in the `users` table (`theme_preference`) and applied on every page via a Blade layout that reads `Auth::user()->theme_preference`.

| Setting | Options | How it works |
|---|---|---|
| Colour mode | Dark / Light / System | Adds/removes the `dark` class on `<html>` |
| Accent colour | Violet, Indigo, Rose, Emerald, Amber, Sky | Sets a `--accent-*` CSS custom property |
| Font size | Small, Medium, Large | Sets a `data-font-size` attribute on `<html>` |

The seven accent colours correspond to Tailwind CSS 4 colour palettes and are prefixed in the stylesheet so the accent can change without a rebuild. Changes take effect immediately after saving the Appearance settings form.

---

### Internationalisation

Yarnly supports **English** (default) and **Bulgarian** using Laravel's `__()` helper.

**How it works:**
1. `SetLocale` middleware runs on every request. If `Auth::guest()`, locale is set to `en`. For authenticated users, it reads the `locale` cookie.
2. The cookie is written by the Language settings page (`/settings/language`) and lasts for the browser session.
3. `App::setLocale($locale)` is called only for whitelisted locales (`['en', 'bg']`) to prevent injection.
4. All Bulgarian strings live in `lang/bg.json` — a single flat JSON file with ~400 keys covering every UI string including navigation, forms, error messages, notification text, admin panel, and pattern pages.
5. Pluralisation uses explicit Blade ternaries (e.g. `$count === 1 ? __('post') : __('posts')`) because Laravel's `Str::plural()` does not handle Slavic languages correctly.

---

### Admin Panel

Admin routes are under `middleware(['auth', 'verified'])` with an additional `role === 'admin'` inline check.

#### Dashboard — `/admin/dashboard`

All stats are computed in the route closure and passed to `adminPanel.dashboard`:

- **Users**: total, new this month, new today, total admin count.
- **Patterns**: total, new this month, breakdown by craft type (`crochet` / `knitting` / `embroidery`) as a `pluck('total', 'category')` map.
- **Posts**: total, new this month, breakdown by craft type.
- **Collections**: total, new this month.
- **Engagement**: total likes, total comments platform-wide.
- **Recent users table**: 10 most recently joined users with their pattern counts.
- **Recent patterns table**: 15 most recently uploaded patterns with author and upload date.

#### Manage Users — `/admin/users`

A fully searchable, sortable, filterable, paginated user management interface:

- **Search**: `name LIKE %q%` OR `username LIKE %q%` (case-insensitive).
- **Role filter**: dropdown for all / user / admin.
- **Sort options**: newest (default), oldest, name A–Z, most patterns (via `withCount`), most posts (via `withCount`).
- **Pagination**: 20 users per page, total count displayed in the header.
- **Actions per user**:
  - **Promote / Revoke Admin** — `PATCH /admin/users/{user}/toggle-role` flips the `role` column between `user` and `admin`. Cannot target the currently-logged-in admin.
  - **Delete** — `DELETE /admin/users/{user}` removes the account and all associated data. Cannot target the currently-logged-in admin.

---

## Tech Stack

| Layer | Technology | Version | Notes |
|---|---|---|---|
| Language | PHP | 8.2+ | Strict types throughout |
| Framework | Laravel | 12 | |
| Auth | Laravel Fortify | ^1.30 | 2FA, email verify, password reset |
| UI components | Livewire Flux | ^2.1 | Prebuilt accessible components |
| Reactive PHP views | Livewire Volt | ^1.7 | Single-file Volt components |
| JS reactivity | Alpine.js | ^3.4 | Used for toggles, counters, modals |
| CSS framework | Tailwind CSS | ^4.0 | CSS-first config, no tailwind.config.js |
| Build tool | Vite | ^7.0 | `laravel-vite-plugin` integration |
| Database | MySQL / MariaDB | 8+ / 10.4+ | |
| File storage | Laravel local disk | — | `storage/app/public` symlinked to `public/storage` |
| Queue | Database | — | `QUEUE_CONNECTION=database` |
| Testing | Pest | ^4.1 | `pest-plugin-laravel` for Laravel helpers |
| Code style | Laravel Pint | ^1.18 | PSR-12 based |
| Dev tooling | Laravel Pail | ^1.2 | Tail logs in terminal |
| Dev tooling | Laravel Sail | ^1.41 | Optional Docker environment |

---

## Architecture & Design Decisions

**No JavaScript framework.** The entire frontend is server-rendered Blade + Livewire components. Alpine.js handles small reactive pieces (character counters, modals, tab switching, dropdown toggles) without any build-time compilation beyond Vite's CSS processing.

**Controller-per-concern.** Each major domain has its own controller (`PatternController`, `PostController`, `CollectionController`, `ProfileController`, `FollowController`, `NotificationController`, `SearchController`). Route logic that is unique and short lives inline in `web.php` (dashboard, admin dashboard, admin user actions) to avoid creating controllers with a single method.

**Service objects for cross-cutting preferences.** `NotificationPreferenceService` and `PrivacyPreferenceService` are injected wherever preferences need to be read or written, keeping the logic DRY across controllers and notification classes. They use flat JSON files rather than extra database columns to avoid migrating the `users` table for every new preference key.

**No API layer.** The app is not an SPA. JSON responses exist only for specific AJAX interactions: user search, post comments, like/follow toggles. All page loads are full server-rendered responses.

**Notifications as database records.** Using Laravel's built-in `database` channel means notifications are queryable, pageable, and grouped by `read_at` without any WebSocket infrastructure. Real-time delivery is out of scope for v1.

**Migrations are append-only.** Schema changes are made in separate migration files so that the migration history is preserved and `php artisan migrate:fresh` always produces a valid database.

---

## Project Structure

```
yarnly/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/                       # Fortify auth override controllers
│   │   │   ├── CollectionController.php    # Pattern collection CRUD + favouriting
│   │   │   ├── FollowController.php        # follow / unfollow actions
│   │   │   ├── NotificationController.php  # index + mark-read
│   │   │   ├── PatternController.php       # list by craft/category + view/download/create
│   │   │   ├── PostController.php          # gallery CRUD + like/save/comment
│   │   │   ├── PostCollectionController.php# post bookmark albums
│   │   │   ├── ProfileController.php       # my profile + edit + user profile
│   │   │   └── SearchController.php        # /search/users JSON endpoint
│   │   ├── Middleware/
│   │   │   └── SetLocale.php               # cookie-based locale switching
│   │   └── Requests/
│   │       ├── ProfileUpdateRequest.php    # name, bio, email validation
│   │       └── StorePostRequest.php        # post create validation
│   ├── Models/
│   │   ├── User.php                        # central model; all relationships defined here
│   │   ├── Pattern.php                     # CATEGORIES const, difficulty/category helpers
│   │   ├── Post.php                        # tags_array accessor, isLikedBy/isFavoritedBy
│   │   ├── PostImage.php
│   │   ├── PostLike.php
│   │   ├── PostComment.php
│   │   ├── PostFavorite.php
│   │   ├── PostCollection.php              # bookmark album (saved-post groups)
│   │   └── Collection.php                 # pattern collection; getCraftTypeColor/Label helpers
│   ├── Notifications/
│   │   ├── NewFollowNotification.php
│   │   ├── NewLikeNotification.php
│   │   ├── NewCommentNotification.php
│   │   ├── NewPostFromFollowedNotification.php
│   │   ├── NewPatternFromFollowedNotification.php
│   │   ├── NewCollectionFromFollowedNotification.php
│   │   └── NotificationBell.php           # Volt component for nav bar bell
│   ├── Providers/
│   │   ├── AppServiceProvider.php
│   │   ├── FortifyServiceProvider.php     # registers custom Fortify views
│   │   └── VoltServiceProvider.php
│   └── Services/
│       ├── NotificationPreferenceService.php
│       └── PrivacyPreferenceService.php
├── bootstrap/
│   ├── app.php                            # middleware registration
│   └── providers.php
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── fortify.php                        # Fortify feature flags
│   └── ...
├── database/
│   ├── migrations/                        # 19 sequential migration files
│   ├── factories/
│   │   └── UserFactory.php
│   └── seeders/
├── lang/
│   ├── bg.json                            # ~400 Bulgarian translation strings
│   └── bg/                               # validation.php, auth.php BG overrides
├── public/
│   ├── index.php
│   ├── storage -> ../storage/app/public   # symlink created by storage:link
│   └── build/                             # Vite compiled assets
├── resources/
│   ├── css/
│   │   └── app.css                        # Tailwind 4 directives + custom properties
│   ├── js/
│   │   └── app.js                         # Alpine.js bootstrap
│   └── views/
│       ├── adminPanel/
│       │   ├── dashboard.blade.php
│       │   └── users.blade.php
│       ├── auth/                           # login, register, 2FA, password reset (4 views)
│       ├── collections/
│       │   ├── create.blade.php
│       │   ├── select-patterns.blade.php
│       │   └── show.blade.php
│       ├── dashboard.blade.php
│       ├── gallery/
│       │   ├── gallery.blade.php           # main gallery with 3 tabs
│       │   └── posts/
│       │       ├── create.blade.php
│       │       └── show.blade.php
│       ├── homepage/
│       │   └── home.blade.php
│       ├── layouts/
│       │   ├── app.blade.php               # authenticated layout
│       │   └── guest.blade.php             # unauthenticated layout
│       ├── notifications/
│       │   └── index.blade.php
│       ├── partials/
│       │   └── auth-modal.blade.php        # guest login/register slide-over
│       ├── patterns/
│       │   ├── create.blade.php
│       │   ├── crochet/
│       │   │   ├── crochet_patterns.blade.php
│       │   │   └── pattern_viewer.blade.php
│       │   ├── knitting/
│       │   │   └── knitting_patterns.blade.php
│       │   └── embroidery/
│       │       └── embroidery_patterns.blade.php
│       ├── profile/
│       │   ├── my-collections.blade.php
│       │   ├── myprofile/
│       │   │   ├── show.blade.php          # tabbed own profile page
│       │   │   └── edit.blade.php          # profile edit form
│       │   └── user/
│       │       └── show.blade.php          # public user profile
│       └── settings/                       # password, email, privacy, appearance, language
├── routes/
│   ├── web.php                             # all application routes
│   └── auth.php                            # Fortify auth routes
├── storage/
│   ├── app/
│   │   ├── public/                         # user-uploaded files
│   │   ├── notification_prefs/             # per-user JSON preference files
│   │   └── privacy_prefs/                  # per-user JSON preference files
│   └── logs/
└── tests/
    ├── Pest.php
    ├── TestCase.php
    ├── Feature/
    └── Unit/
```

---

## Route Map

| Method | URI | Controller / Closure | Auth required |
|---|---|---|---|
| GET | `/` | Closure (homepage) | No |
| GET | `/search/users` | `SearchController@users` | No |
| GET | `/patterns/crochet` | `PatternController@crochet` | No |
| GET | `/patterns/crochet/{category}` | `PatternController@crochetByCategory` | No |
| GET | `/patterns/knitting` | `PatternController@knitting` | No |
| GET | `/patterns/knitting/{category}` | `PatternController@knittingByCategory` | No |
| GET | `/patterns/embroidery` | `PatternController@embroidery` | No |
| GET | `/patterns/embroidery/{category}` | `PatternController@embroideryByCategory` | No |
| GET | `/models/gallery` | `PatternController@gallery` | No |
| GET | `/patterns/{pattern}/view` | `PatternController@view` | No |
| GET | `/patterns/{pattern}/download` | `PatternController@download` | No |
| GET | `/dashboard` | Closure | auth + verified |
| GET | `/admin/dashboard` | Closure | auth + verified |
| GET | `/admin/users` | Closure | auth + verified |
| PATCH | `/admin/users/{user}/toggle-role` | Closure | auth + verified |
| DELETE | `/admin/users/{user}` | Closure | auth + verified |
| GET | `/profile` | `ProfileController@show` | auth + verified |
| GET | `/profile/edit` | `ProfileController@edit` | auth + verified |
| PATCH | `/profile` | `ProfileController@update` | auth + verified |
| DELETE | `/profile` | `ProfileController@destroy` | auth + verified |
| GET | `/users/{user}` | `ProfileController@showUser` | No |
| GET | `/gallery/posts/create` | `PostController@create` | auth + verified |
| POST | `/gallery/posts` | `PostController@store` | auth + verified |
| GET | `/gallery/posts/{post}` | `PostController@show` | No |
| DELETE | `/gallery/posts/{post}` | `PostController@destroy` | auth + verified |
| GET | `/posts/{post}/comments` | `PostController@comments` | No |
| POST | `/posts/{post}/comments` | `PostController@storeComment` | auth + verified |
| POST | `/posts/{post}/like` | `PostController@like` | auth + verified |
| DELETE | `/posts/{post}/like` | `PostController@unlike` | auth + verified |
| POST | `/posts/{post}/favorite` | `PostController@addFavorite` | auth + verified |
| DELETE | `/posts/{post}/favorite` | `PostController@removeFavorite` | auth + verified |
| POST | `/users/{user}/follow` | `FollowController@follow` | auth + verified |
| DELETE | `/users/{user}/follow` | `FollowController@unfollow` | auth + verified |
| GET | `/patterns/create` | `PatternController@create` | auth + verified |
| POST | `/patterns` | `PatternController@store` | auth + verified |
| GET | `/collections/select-patterns` | `CollectionController@selectPatterns` | auth + verified |
| GET | `/collections/create` | `CollectionController@create` | auth + verified |
| POST | `/collections` | `CollectionController@store` | auth + verified |
| GET | `/my-collections` | `CollectionController@myCollections` | auth + verified |
| GET | `/notifications` | `NotificationController@index` | auth + verified |
| GET | `/notifications/{id}/mark-read` | `NotificationController@markRead` | auth + verified |
| GET | `/settings` | Closure / Volt | auth + verified |

---

## Database Schema

### `users`

| Column | Type | Nullable | Default | Notes |
|---|---|---|---|---|
| `id` | bigint unsigned PK | No | auto | |
| `name` | varchar(255) | No | — | Full display name |
| `bio` | varchar(200) | Yes | null | Short bio, max 200 chars |
| `username` | varchar(255) | Yes | null | Unique, used in profile URL |
| `email` | varchar(255) | No | — | Unique |
| `email_verified_at` | timestamp | Yes | null | Set after email click |
| `role` | enum('admin','user') | No | `user` | |
| `password` | varchar(255) | No | — | bcrypt hashed |
| `profile_picture` | varchar(255) | Yes | null | Relative path in public storage |
| `avatar_color` | varchar(7) | Yes | null | Hex colour, e.g. `#7c3aed` |
| `theme_preference` | varchar(255) | Yes | `dark` | `dark`, `light`, or `system` |
| `two_factor_secret` | text | Yes | null | Encrypted TOTP secret |
| `two_factor_recovery_codes` | text | Yes | null | Encrypted array of recovery codes |
| `two_factor_confirmed_at` | timestamp | Yes | null | When 2FA was enabled |
| `remember_token` | varchar(100) | Yes | null | |
| `created_at` / `updated_at` | timestamp | Yes | null | |

### `patterns`

| Column | Type | Nullable | Notes |
|---|---|---|---|
| `id` | bigint PK | No | |
| `user_id` | FK → users | No | Cascade delete |
| `title` | varchar(255) | No | |
| `description` | text | Yes | |
| `craft_type` | varchar(255) | No | `crochet`, `knitting`, `embroidery` |
| `category` | varchar(255) | No | Subcategory slug |
| `difficulty` | varchar(255) | No | `beginner`, `intermediate`, `advanced` |
| `estimated_hours` | int | Yes | min 1, max 200 |
| `tags` | varchar(500) | Yes | Comma-separated, clean (no `#`) |
| `pdf_file` | varchar(255) | No | `patterns/pdfs/{uuid}.pdf` |
| `original_filename` | varchar(255) | No | Shown to the user on download |
| `image_path` | varchar(255) | Yes | `patterns/images/{uuid}.jpg` |
| `makers_saved` | int | No | Default 0 |

### `posts`

| Column | Type | Nullable | Notes |
|---|---|---|---|
| `id` | bigint PK | No | |
| `user_id` | FK → users | No | |
| `description` | text | Yes | |
| `craft_type` | varchar(255) | No | |
| `tags` | varchar(255) | Yes | Comma-separated |

### `post_images`

| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | |
| `post_id` | FK → posts | Cascade delete |
| `image_path` | varchar(255) | `posts/{uuid}.jpg` |
| `order` | int | 0-indexed, preserves upload sequence |

### `follows`

| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | |
| `follower_id` | FK → users | The user who follows |
| `following_id` | FK → users | The user being followed |
| `created_at` | timestamp | |

### `post_likes`

| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | |
| `post_id` | FK → posts | |
| `created_at` | timestamp | |

### `post_favorites`

| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | |
| `post_id` | FK → posts | |
| `created_at` | timestamp | |

### `post_comments`

| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | |
| `post_id` | FK → posts | |
| `body` | text | max 500 chars |
| `created_at` / `updated_at` | timestamp | |

### `user_favorites`

| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | |
| `pattern_id` | FK → patterns | |
| `created_at` / `updated_at` | timestamp | |

### `collections`

| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | |
| `name` | varchar(255) | |
| `description` | text | nullable |
| `craft_type` | varchar(255) | crochet / knitting / embroidery |
| `cover_image_path` | varchar(255) | nullable |
| `is_public` | tinyint(1) | 0 = private, 1 = public |
| `created_at` / `updated_at` | timestamp | |

### `collection_pattern`

Pivot table linking `collections` to `patterns` (many-to-many with timestamps).

### `collection_favorites`

| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | |
| `collection_id` | FK → collections | |
| `created_at` / `updated_at` | timestamp | |

### `post_collections`

| Column | Type | Notes |
|---|---|---|
| `id` | bigint PK | |
| `user_id` | FK → users | Owner of the album |
| `name` | varchar(255) | Album name |
| `created_at` / `updated_at` | timestamp | |

### `post_collection_post`

Pivot table linking `post_collections` to `posts` (saved posts organised into albums).

### `notifications`

Laravel's standard polymorphic notifications table. Key columns:

| Column | Type | Notes |
|---|---|---|
| `id` | char(36) UUID PK | |
| `type` | varchar(255) | FQCN of the notification class |
| `notifiable_type` | varchar(255) | Always `App\Models\User` |
| `notifiable_id` | bigint | User ID |
| `data` | text | JSON: `{message, url, actor}` |
| `read_at` | timestamp | null = unread |

---

## Eloquent Models & Relationships

### `User`

```
patterns()              → HasMany(Pattern)
favoritePatterns()      → BelongsToMany(Pattern, user_favorites)
posts()                 → HasMany(Post)
likedPosts()            → BelongsToMany(Post, post_likes)
favoritedPosts()        → BelongsToMany(Post, post_favorites)
postComments()          → HasMany(PostComment)
collections()           → HasMany(Collection)
favoriteCollections()   → BelongsToMany(Collection, collection_favorites)
postCollections()       → HasMany(PostCollection)
followers()             → BelongsToMany(User, follows, following_id, follower_id)
following()             → BelongsToMany(User, follows, follower_id, following_id)
notifications()         → MorphMany (Laravel built-in)
```

**Computed helpers:** `initials()`, `avatarColor()`, `hasProfileImage()`, `getIsAdminAttribute()`, `hasFavorited()`, `hasFavoritedCollection()`, `hasLikedPost()`, `hasFavoritedPost()`, `isFollowing()`.

### `Pattern`

```
user()                  → BelongsTo(User)
```

**Constants:** `Pattern::CATEGORIES` — nested array defining valid craft types and their subcategory slugs and labels.

**Helpers:** `getCategoryLabel()`, `getDifficultyColor()`.

### `Post`

```
user()                  → BelongsTo(User)
images()                → HasMany(PostImage, ordered by `order`)
likes()                 → HasMany(PostLike)
favorites()             → HasMany(PostFavorite)
comments()              → HasMany(PostComment, ordered oldest first)
```

**Accessors:** `getLikesCountAttribute()`, `getCommentsCountAttribute()`, `getTagsArrayAttribute()` (strips `#`, trims whitespace, filters empty).

**Helpers:** `isLikedBy(User)`, `isFavoritedBy(User)`.

### `Collection`

```
user()                  → BelongsTo(User)
patterns()              → BelongsToMany(Pattern, collection_pattern)
```

**Helpers:** `getCraftTypeLabel()`, `getCraftTypeColor()` (returns Tailwind colour name for badge rendering), `hasPattern(Pattern)`.

---

## Authentication & Security

Authentication is handled by **Laravel Fortify** configured in `config/fortify.php` and `FortifyServiceProvider`.

### Features enabled

| Feature | Description |
|---|---|
| Registration | Name, username, email, password; auto-login after register |
| Email verification | Signed URL emailed on register; protected routes use `verified` middleware |
| Login | Standard email + password; rate-limited by Fortify |
| Remember me | Persistent login cookie |
| Password reset | Signed email link, tokens stored in `password_reset_tokens` |
| Password updates | Available from Settings; requires current password confirmation |
| Profile updates | Name, bio, email changes via `ProfileUpdateRequest` |
| Two-factor auth | TOTP (Google Authenticator, Authy, etc.); QR code + manual key + 8 recovery codes |
| Password confirmation | Sensitive actions require recent password confirmation (15-minute window) |

### File upload security

- All uploads are validated for MIME type server-side (extension alone is not trusted).
- PDFs are double-checked with `$file->getMimeType() === 'application/pdf'`.
- Uploaded files are stored with random UUIDs as filenames in `storage/app/public/` — never in the `public/` directory directly.
- The `original_filename` is stored separately for human-readable downloads.
- PDF serving uses `response()->download()` through a controller, not a direct URL, so access can be controlled in the future.

### CSRF

All forms include `@csrf`. Vite's axios config includes the `X-CSRF-TOKEN` header automatically for AJAX requests.

### SQL injection

All database queries use Eloquent ORM or the query builder with parameter binding. No raw SQL with user input.

### XSS

All Blade variables are output with `{{ }}` (double braces), which HTML-encodes by default. Raw output `{!! !!}` is not used for user-supplied data.

---

## Roles & Permissions

| Role | Capabilities |
|---|---|
| `user` | Manage own patterns, posts, collections, profile; follow/unfollow; like/comment/save |
| `admin` | All user capabilities + access to `/admin/dashboard` and `/admin/users`; promote/demote other users; delete any account |

**Guards:**
- An admin cannot demote themselves (`$user->id === Auth::id()` check returns 403).
- An admin cannot delete themselves (same check).
- Admin routes are not protected by a dedicated middleware gate; they use inline `abort_if($user->role !== 'admin', 403)` or equivalent.

---

## Services

### `NotificationPreferenceService`

Path: `app/Services/NotificationPreferenceService.php`

Manages per-user notification opt-in/out preferences stored as JSON.

```php
// Default values (all opt-in)
const DEFAULTS = [
    'notify_followers'       => true,
    'notify_likes'           => true,
    'notify_comments'        => true,
    'notify_new_posts'       => true,
    'notify_new_patterns'    => true,
    'notify_new_collections' => true,
];

get(object $notifiable): array    // merge stored with defaults
save(int $userId, array $prefs): void
check(object $notifiable, string $key): bool
```

### `PrivacyPreferenceService`

Path: `app/Services/PrivacyPreferenceService.php`

Manages per-user profile visibility preferences stored as JSON.

```php
const DEFAULTS = [
    'searchable_profile'     => true,
    'show_liked_posts'       => true,
    'show_saved_posts'       => true,
    'show_saved_patterns'    => true,
    'show_saved_collections' => true,
];

get(object $user): array
save(int $userId, array $prefs): void
check(object $user, string $key): bool
```

Both services resolve via `app(ServiceClass::class)` (automatic constructor injection) wherever they are needed.

---

## Installation

### Prerequisites

- **PHP 8.2+** with extensions: `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `gd` (or `imagick`)
- **[Composer](https://getcomposer.org)** 2.x
- **[Node.js](https://nodejs.org)** 18+ and **npm** 9+
- **MySQL 8+** or **MariaDB 10.4+**

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

**6. Create the database**

Create a MySQL database named `yarnly` (or whatever you configure in `.env`):

```sql
CREATE DATABASE yarnly CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**7. Configure environment**

Edit `.env` with your database credentials and mail settings (see [Environment Variables](#environment-variables)).

**8. Run database migrations**

```bash
php artisan migrate
```

**9. Create the public storage symlink**

```bash
php artisan storage:link
```

This symlinks `public/storage` → `storage/app/public` so uploaded files are web-accessible.

**10. Build frontend assets**

```bash
npm run build
```

**11. (Optional) Seed the database**

```bash
php artisan db:seed
```

---

## Environment Variables

Full `.env` reference with explanations:

```dotenv
# ─── Application ───────────────────────────────────────────────────────────────
APP_NAME=Yarnly
APP_ENV=local                       # local | staging | production
APP_KEY=                            # Auto-generated by php artisan key:generate
APP_DEBUG=true                      # Set to false in production
APP_URL=http://localhost:8000       # Must match your actual URL (for signed URLs & emails)
APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

# ─── Database ──────────────────────────────────────────────────────────────────
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yarnly
DB_USERNAME=root
DB_PASSWORD=

# ─── Cache, Sessions & Queues ──────────────────────────────────────────────────
CACHE_STORE=file                    # file | redis | database
SESSION_DRIVER=database             # database | file | cookie | redis
SESSION_LIFETIME=120                # Minutes
QUEUE_CONNECTION=database           # Needed for notification dispatch

# ─── Mail ──────────────────────────────────────────────────────────────────────
# Required for: email verification, password reset, 2FA setup emails
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io          # Replace with your provider
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null                # tls | ssl | null
MAIL_FROM_ADDRESS="noreply@yarnly.com"
MAIL_FROM_NAME="Yarnly"

# ─── File Storage ──────────────────────────────────────────────────────────────
FILESYSTEM_DISK=local               # local is fine for development; use s3 for production
```

**Mail providers for development:**
- [Mailtrap](https://mailtrap.io) — captures emails in a sandbox inbox (free tier available)
- [Mailgun](https://www.mailgun.com) — real delivery, generous free tier
- [Resend](https://resend.com) — modern developer-first email API

**For production**, additionally set:
```dotenv
APP_ENV=production
APP_DEBUG=false
SESSION_DRIVER=database
CACHE_STORE=redis           # Recommended for production
QUEUE_CONNECTION=redis      # Recommended for production
```

---

## Running the Application

### Development — all services at once

The custom `composer dev` script starts all required processes concurrently using `concurrently`:

```bash
composer dev
```

This runs simultaneously:
- `php artisan serve` — Laravel development server on `http://localhost:8000`
- `php artisan queue:listen --tries=1` — processes notification jobs
- `php artisan pail --timeout=0` — tails application logs in the terminal
- `npm run dev` — Vite HMR dev server for CSS/JS hot reload

Alternatively, using npm directly:

```bash
npm run dev-all
```

### Running services individually

```bash
# Laravel server
php artisan serve

# Vite dev server (CSS + JS hot reload)
npm run dev

# Queue worker (required for notifications)
php artisan queue:listen --tries=1

# Log watcher
php artisan pail
```

### Production build & deployment

```bash
# 1. Install production-only dependencies
composer install --no-dev --optimize-autoloader

# 2. Build minified assets
npm run build

# 3. Cache configuration
php artisan config:cache
php artisan route:cache
php artisan event:cache
php artisan view:cache

# 4. Run pending migrations
php artisan migrate --force

# 5. Ensure storage symlink exists
php artisan storage:link

# 6. Start the queue worker as a daemon (use Supervisor in production)
php artisan queue:work --tries=3 --timeout=60
```

---

## Running Tests

Yarnly uses the **Pest** testing framework.

```bash
# Run all tests
php artisan test

# Or via Composer
composer test

# Run with coverage (requires Xdebug or PCOV)
php artisan test --coverage

# Run only feature tests
php artisan test --testsuite=Feature

# Run only unit tests
php artisan test --testsuite=Unit
```

Before each test run, `composer test` clears the config cache (`php artisan config:clear`) to ensure a fresh environment.

---

## License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).

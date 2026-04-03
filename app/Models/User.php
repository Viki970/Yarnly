<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $role
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Pattern> $favoritePatterns
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Collection> $favoriteCollections
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Collection> $collections
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Post> $posts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Post> $likedPosts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Post> $favoritedPosts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $following
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $followers
 * @method BelongsToMany favoritePatterns()
 * @method BelongsToMany favoriteCollections()
 * @method HasMany collections()
 * @method HasMany posts()
 * @method BelongsToMany likedPosts()
 * @method BelongsToMany favoritedPosts()
 * @method BelongsToMany following()
 * @method BelongsToMany followers()
 * @method bool hasFavorited(Pattern $pattern)
 * @method bool hasFavoritedCollection(Collection $collection)
 * @method bool hasLikedPost(Post $post)
 * @method bool hasFavoritedPost(Post $post)
 * @method bool isFollowing(User $user)
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'bio',
        'username',
        'email',
        'password',
        'role',
        'profile_picture',
        'avatar_color',
        'theme_preference',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Returns the background color hex for the avatar initials circle.
     * Stored in the dedicated avatar_color column as "#rrggbb".
     * Returns null when no colour is set (falls back to the default CSS gradient).
     */
    public function avatarColor(): ?string
    {
        return $this->avatar_color ?: null;
    }

    /**
     * True when the user has an actual uploaded profile image.
     */
    public function hasProfileImage(): bool
    {
        return (bool) $this->profile_picture;
    }

    /**
     * Check if the user is an admin
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->role === 'admin';
    }

    public function patterns(): HasMany
    {
        return $this->hasMany(Pattern::class);
    }

    /**
     * Get the patterns this user has favorited
     */
    public function favoritePatterns(): BelongsToMany
    {
        return $this->belongsToMany(Pattern::class, 'user_favorites', 'user_id', 'pattern_id')
                    ->withTimestamps();
    }

    /**
     * Check if user has favorited a specific pattern
     */
    public function hasFavorited(Pattern $pattern): bool
    {
        return $this->favoritePatterns()->where('patterns.id', $pattern->id)->exists();
    }

    /**
     * Get the collections this user has favorited
     */
    public function favoriteCollections(): BelongsToMany
    {
        return $this->belongsToMany(Collection::class, 'collection_favorites', 'user_id', 'collection_id')
                    ->withTimestamps();
    }

    /**
     * Check if user has favorited a specific collection
     */
    public function hasFavoritedCollection(Collection $collection): bool
    {
        return $this->favoriteCollections()->where('collections.id', $collection->id)->exists();
    }

    /**
     * Get the collections created by this user
     */
    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }

    /**
     * Get the posts created by this user
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the posts this user has liked
     */
    public function likedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_likes', 'user_id', 'post_id')
                    ->withTimestamps();
    }

    /**
     * Check if user has liked a specific post
     */
    public function hasLikedPost(Post $post): bool
    {
        return $this->likedPosts()->where('posts.id', $post->id)->exists();
    }

    /**
     * Get the posts this user has favorited
     */
    public function favoritedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_favorites', 'user_id', 'post_id')
                    ->withTimestamps();
    }

    /**
     * Check if user has favorited a specific post
     */
    public function hasFavoritedPost(Post $post): bool
    {
        return $this->favoritedPosts()->where('posts.id', $post->id)->exists();
    }

    /**
     * Comments left by this user
     */
    public function postComments(): HasMany
    {
        return $this->hasMany(PostComment::class);
    }

    /**
     * Post collections (saved-post bookmarks organized into named groups)
     */
    public function postCollections(): HasMany
    {
        return $this->hasMany(\App\Models\PostCollection::class);
    }

    /**
     * Users that this user is following
     */
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')
                    ->withTimestamps();
    }

    /**
     * Users that follow this user
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')
                    ->withTimestamps();
    }

    /**
     * Check if this user is following the given user
     */
    public function isFollowing(User $user): bool
    {
        return $this->following()->where('following_id', $user->id)->exists();
    }

    /**
     * Follow the given user (no-op if already following or self)
     */
    public function follow(User $user): void
    {
        if ($this->id !== $user->id) {
            $this->following()->syncWithoutDetaching([$user->id]);
        }
    }

    /**
     * Unfollow the given user
     */
    public function unfollow(User $user): void
    {
        $this->following()->detach($user->id);
    }
}

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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, CrochetPattern> $favoritePatterns
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Collection> $favoriteCollections
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Collection> $collections
 * @method BelongsToMany favoritePatterns()
 * @method BelongsToMany favoriteCollections()
 * @method HasMany collections()
 * @method bool hasFavorited(CrochetPattern $pattern)
 * @method bool hasFavoritedCollection(Collection $collection)
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
        'email',
        'password',
        'role',
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
     * Check if the user is an admin
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Get the patterns this user has favorited
     */
    public function favoritePatterns(): BelongsToMany
    {
        return $this->belongsToMany(CrochetPattern::class, 'user_favorites', 'user_id', 'crochet_pattern_id')
                    ->withTimestamps();
    }

    /**
     * Check if user has favorited a specific pattern
     */
    public function hasFavorited(CrochetPattern $pattern): bool
    {
        return $this->favoritePatterns()->where('crochet_patterns.id', $pattern->id)->exists();
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
}

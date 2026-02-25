<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'craft_type',
        'cover_image_path',
        'is_public',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who created this collection
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the patterns in this collection
     */
    public function patterns()
    {
        return $this->belongsToMany(Pattern::class, 'collection_pattern', 'collection_id', 'pattern_id')
                    ->withTimestamps();
    }

    /**
     * Get the count of patterns in this collection
     */
    public function getPatternsCountAttribute()
    {
        return $this->patterns()->count();
    }

    /**
     * Check if a specific pattern is in this collection
     */
    public function hasPattern(Pattern $pattern): bool
    {
        return $this->patterns()->where('patterns.id', $pattern->id)->exists();
    }

    /**
     * Get the craft type label for display
     */
    public function getCraftTypeLabel()
    {
        return match($this->craft_type) {
            'crochet' => 'Crochet',
            'knitting' => 'Knitting',
            'embroidery' => 'Embroidery',
            default => ucfirst($this->craft_type),
        };
    }

    /**
     * Get the craft type color for display
     */
    public function getCraftTypeColor()
    {
        return match($this->craft_type) {
            'crochet' => 'emerald',
            'knitting' => 'blue',
            'embroidery' => 'purple',
            default => 'zinc',
        };
    }

    /**
     * Get the users who have favorited this collection
     */
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'collection_favorites', 'collection_id', 'user_id')
                    ->withTimestamps();
    }

    /**
     * Check if collection is favorited by a specific user
     */
    public function isFavoritedBy($userId): bool
    {
        // Handle both User objects and user IDs
        $userId = $userId instanceof User ? $userId->id : $userId;
        return $this->favoritedByUsers()->where('users.id', $userId)->exists();
    }

    /**
     * Get the count of users who favorited this collection
     */
    public function getFavoritesCountAttribute()
    {
        return $this->favoritedByUsers()->count();
    }
}
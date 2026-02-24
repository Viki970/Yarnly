<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrochetPattern extends Model
{
    protected $table = 'crochet_patterns';

    protected $fillable = [
        'title',
        'description',
        'category',
        'difficulty',
        'estimated_hours',
        'tags',
        'pdf_file',
        'original_filename',
        'image_path',
        'makers_saved',
        'user_id',
    ];

    protected $casts = [
        'makers_saved' => 'integer',
        'estimated_hours' => 'integer',
    ];

    /**
     * Get the user who created this pattern
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Get the category label for display
     */
    public function getCategoryLabel()
    {
        return match($this->category) {
            'blankets' => 'Blankets & Throws',
            'amigurumi' => 'Amigurumi',
            'bags' => 'Bags & Totes',
            'wearables' => 'Wearables',
            'home-decor' => 'Home decor',
            default => ucfirst($this->category),
        };
    }

    /**
     * Get the difficulty badge color
     */
    public function getDifficultyColor()
    {
        return match($this->difficulty) {
            'beginner' => 'emerald',
            'intermediate' => 'teal',
            'advanced' => 'orange',
            default => 'zinc',
        };
    }

    /**
     * Get the users who have favorited this pattern
     */
    public function favoritedByUsers()
    {
        return $this->belongsToMany(\App\Models\User::class, 'user_favorites', 'crochet_pattern_id', 'user_id')
                    ->withTimestamps();
    }

    /**
     * Check if pattern is favorited by a specific user
     */
    public function isFavoritedBy($userId): bool
    {
        if (!$userId) return false;
        return $this->favoritedByUsers()->where('users.id', $userId)->exists();
    }

    /**
     * All patterns in the crochet_patterns table are crochet by nature.
     * This accessor lets collection-level filtering by craft_type work correctly.
     */
    public function getCraftTypeAttribute(): string
    {
        return 'crochet';
    }
}

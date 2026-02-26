<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    protected $table = 'patterns';

    public const CATEGORIES = [
        'crochet'    => [
            'blankets'   => 'Blankets & Throws',
            'amigurumi'  => 'Amigurumi',
            'bags'       => 'Bags & Totes',
            'wearables'  => 'Wearables',
            'home-decor' => 'Home Decor',
        ],
        'knitting' => [
            'wearables'  => 'Wearables',
            'accessories' => 'Accessories',
            'home-decor' => 'Home & Decor',
            'toys'       => 'Toys',
            'baby-kids'  => 'Baby & Kids',
        ],
        'embroidery' => [
            'clothing-embroidery'   => 'Clothing Embroidery',
            'hoop-art-wall-decor'   => 'Hoop Art & Wall Decor',
            'cross-stitch'          => 'Cross Stitch',
            'hand-techniques'       => 'Hand Techniques',
        ],
    ];

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
        'craft_type',
    ];

    protected $casts = [
        'makers_saved' => 'integer',
        'estimated_hours' => 'integer',
        'craft_type' => 'string',
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
        foreach (self::CATEGORIES as $craftCategories) {
            if (isset($craftCategories[$this->category])) {
                return $craftCategories[$this->category];
            }
        }
        return ucfirst($this->category);
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
        return $this->belongsToMany(\App\Models\User::class, 'user_favorites', 'pattern_id', 'user_id')
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


}

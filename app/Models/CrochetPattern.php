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
        'pdf_file',
        'image_path',
        'makers_saved',
    ];

    protected $casts = [
        'makers_saved' => 'integer',
        'estimated_hours' => 'integer',
    ];

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
}

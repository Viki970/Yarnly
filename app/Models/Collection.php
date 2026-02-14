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
        return $this->belongsToMany(CrochetPattern::class, 'collection_pattern', 'collection_id', 'crochet_pattern_id')
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
    public function hasPattern(CrochetPattern $pattern): bool
    {
        return $this->patterns()->where('crochet_patterns.id', $pattern->id)->exists();
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
}
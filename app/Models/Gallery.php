<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Gallery extends Model
{
use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'category',
        'image_path',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Optional: Scope to easily grab only active photos
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

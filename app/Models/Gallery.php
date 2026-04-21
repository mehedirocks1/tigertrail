<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    // Pro-Tip: You can replace $fillable with `protected $guarded = [];` 
    // to never worry about Mass Assignment errors in Filament again!
    protected $fillable = [
        'title',
        'subtitle',
        'category',
        'image_path',
        'is_featured', // Perfect for triggering that "Champions" border scale effect!
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
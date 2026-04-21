<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HeroSlide extends Model
{
    use HasFactory;

    // Explicitly allow these fields to be saved from Filament
    protected $fillable = [
        'image_path',
        'title',         // e.g., "Save the Tiger"
        'subtitle',      // e.g., "Save Sundarbans"
        'description',   // e.g., "Bridging fitness, awareness..."
        'order',
        'is_active',
    ];

    // Ensure proper data types
    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    // Optional scope for cleanly querying only active slides
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
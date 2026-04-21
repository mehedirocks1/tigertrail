<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brochure extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'image_path', 
        'file_path', 
        'is_active'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope a query to only include active brochures.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
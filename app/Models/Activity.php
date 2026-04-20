<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Activity extends Model
{
use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'description',
        'image_path',
        'link_text',
        'link_url',
        'is_active',
        'sort_order',
    ];

    // Helper scope to only get active activities
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

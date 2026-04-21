<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'title',
        'subtitle',
        'category',
        'col_span',
        'row_span',
        'is_highlight',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_highlight' => 'boolean',
        'is_active' => 'boolean',
        'col_span' => 'integer',
        'row_span' => 'integer',
        'order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
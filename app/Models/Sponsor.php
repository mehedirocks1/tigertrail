<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // যোগ করা হয়েছে
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; // যোগ করা হয়েছে

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'type', 
        'logo_path', 
        'website_url', 
        'sort_order', 
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer', // এটিও যোগ করতে পারেন নির্ভুল ক্যালকুলেশনের জন্য
    ];

    /**
     * Scope a query to only include active sponsors ordered by sort order.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order', 'asc');
    }
}
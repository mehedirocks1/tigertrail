<?php

namespace Modules\Events\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Events\App\Models\Attendee;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'event_date' => 'datetime',
        'registration_deadline' => 'datetime',
        'categories' => 'array',
        'is_flagship' => 'boolean',
        'base_registration_fee' => 'decimal:2',
    ];

    public function attendees(): HasMany
    {
        return $this->hasMany(Attendee::class);
    }





/**
     * Get the results for the event.
     */
    public function results()
    {
        return $this->hasMany(EventResult::class);
    }




}
<?php

namespace Modules\Events\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    /**
     * Mass assignment protection.
     */
    protected $guarded = [];

    /**
     * Casting database values to native PHP types.
     * Essential for the 'categories' array to work in Blade and Filament.
     */
    protected $casts = [
        'event_date' => 'datetime',
        'registration_deadline' => 'datetime',
        'categories' => 'array', 
        'is_flagship' => 'boolean',
        'base_registration_fee' => 'decimal:2',
    ];

    /**
     * Get the attendees that registered for this event.
     */
    public function attendees(): HasMany
    {
        // FIX: You must use the fully qualified class name or import it at the top.
        // Since both are in Modules\Events\App\Models, this is the safest way:
        return $this->hasMany(\Modules\Events\App\Models\Attendee::class);
    }
}
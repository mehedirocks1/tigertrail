<?php

namespace Modules\Events\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Events\Database\Factories\AttendeeFactory;

class Attendee extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     * Leaving this empty allows all columns to be mass-assigned.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'waiver_accepted' => 'boolean',
        'terms_accepted' => 'boolean',
        'registration_fee' => 'decimal:2',
        'previous_marathons' => 'integer',
    ];

    /**
     * Get the event that this attendee is registered for.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // protected static function newFactory(): AttendeeFactory
    // {
    //     // return AttendeeFactory::new();
    // }
}
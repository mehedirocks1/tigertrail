<?php

namespace Modules\Events\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Attendee extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     * (Modern Laravel 12 Syntax)
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'waiver_accepted' => 'boolean',
            'terms_accepted' => 'boolean',
            'registration_fee' => 'decimal:2',
            'previous_marathons' => 'integer',
        ];
    }

    /**
     * Get the event that this attendee is registered for.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Virtual Attribute: Get the attendee's full name.
     * Usage: $attendee->full_name
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => trim("{$this->first_name} {$this->last_name}"),
        );
    }
}
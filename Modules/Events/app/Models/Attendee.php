<?php

namespace Modules\Events\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
// 1. Import the Prunable classes and Storage facade
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class Attendee extends Model
{
    // 2. Add the Prunable trait here
    use HasFactory, Prunable;

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

    /**
     * 3. Define the Prunable Query
     * Tell Laravel which records are considered abandoned.
     */
    public function prunable(): Builder
    {
        // Target attendees who are still "Pending" 2 hours after they started registering
        return static::where('payment_status', 'Pending')
                     ->where('created_at', '<=', now()->subHours(2));
    }

    /**
     * 4. Clean up associated files before the database row is deleted
     */
    protected function pruning(): void
    {
        // Delete the uploaded runner ID photo from the public disk
        if ($this->photo_path) {
            Storage::disk('public')->delete($this->photo_path);
        }
    }
}
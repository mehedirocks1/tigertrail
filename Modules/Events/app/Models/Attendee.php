<?php

namespace Modules\Events\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attendee extends Model
{
    use HasFactory, Prunable;

    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
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
     * =========================
     * RELATIONS
     * =========================
     */
/*
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
*/
    /**
     * ✅ BIB জেনারেশনের জন্য এই রিলেশনটি অত্যন্ত গুরুত্বপূর্ণ
     */
    public function bibAssignments(): HasMany
    {
        return $this->hasMany(BibAssignment::class, 'attendee_id');
    }

    /**
     * =========================
     * ACCESSORS
     * =========================
     */

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => trim("{$this->first_name} {$this->last_name}"),
        );
    }

    /**
     * =========================
     * PRUNING LOGIC
     * =========================
     */

    public function prunable(): Builder
    {
        // ✅ ডাটাবেস অনুযায়ী পেমেন্ট স্ট্যাটাস চেক (Case Sensitive safe)
        return static::whereIn('payment_status', ['Pending', 'pending'])
                     ->where('created_at', '<=', now()->subHours(2));
    }

    protected function pruning(): void
    {
        if ($this->photo_path) {
            Storage::disk('public')->delete($this->photo_path);
        }
    }

    /**
     * =========================
     * SCOPES
     * =========================
     */

    public function scopeSuccessful($query)
    {
        // ✅ আপনার ডাটাবেসে 'Success' (S বড় হাতের) আছে, তাই iLike বা whereIn ব্যবহার করা নিরাপদ
        return $query->whereIn('payment_status', ['Success', 'success']);
    }





public function event()
{
    return $this->belongsTo(Event::class, 'event_id');
}



}
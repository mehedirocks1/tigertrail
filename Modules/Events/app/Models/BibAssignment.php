<?php

namespace Modules\Events\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BibAssignment extends Model
{
    protected $table = 'bib_assignments';

    // সব ফিল্ডে ডেটা ইনসার্ট করার পারমিশন
    protected $guarded = [];

    protected $casts = [
        'bib_number'        => 'integer',
        'event_id'          => 'integer',
        'attendee_id'       => 'integer',
        'bib_management_id' => 'integer',
        'is_kit_collected'  => 'boolean',
        'collected_at'      => 'datetime',
    ];

    /**
     * ✅ Attendee এর সাথে রিলেশন (SL নম্বর দেখার জন্য জরুরি)
     */
    public function attendee(): BelongsTo
    {
        return $this->belongsTo(Attendee::class, 'attendee_id');
    }

    /**
     * ✅ Bib Management এর সাথে রিলেশন
     */
    public function bibManagement(): BelongsTo
    {
        return $this->belongsTo(BibManagement::class, 'bib_management_id');
    }

    /**
     * ✅ Event এর সাথে রিলেশন
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
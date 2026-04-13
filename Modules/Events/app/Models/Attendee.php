<?php

namespace Modules\Events\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendee extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'date_of_birth' => 'date',
        'waiver_accepted' => 'boolean',
        'terms_accepted' => 'boolean',
        'registration_fee' => 'decimal:2',
        'previous_marathons' => 'integer',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
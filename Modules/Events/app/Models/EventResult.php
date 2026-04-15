<?php

namespace Modules\Events\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Events\App\Models\Event; // ইভেন্ট মডেলটি ইমপোর্ট করা হলো

class EventResult extends Model
{
    use HasFactory;

    // Filament যেন সব ফিল্ডে ডেটা সেভ করতে পারে, তাই guarded ফাঁকা রাখা হলো
    protected $guarded = [];

    /**
     * Get the event that owns the result.
     * এটি Filament এর Select::make('event_id')->relationship() এর জন্য জরুরি
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
<?php

namespace Modules\Events\App\Models;

use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;

class BibManagement extends Model
{
    // টেবিল নামটি স্পষ্টভাবে ডিফাইন করে দিন
    protected $table = 'bib_managements';

    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            // ১. পেমেন্ট সাকসেস কিন্তু বিব নেই এমন অ্যাটেন্ডি ধরা
            $attendees = Attendee::where('event_id', $model->event_id)
                ->where('race_category', $model->category) // আপনার ডাটাবেজে race_category না শুধু category তা চেক করে নিন
                ->where('payment_status', 'success')
                ->whereNull('serial_number')
                ->orderBy('id', 'asc')
                ->get();

            $currentBib = $model->start_from;
            $count = 0;

            // ২. লুপ চালিয়ে বিব দিয়ে দেওয়া
            foreach ($attendees as $attendee) {
                $attendee->update([
                    'serial_number' => $currentBib
                ]);
                $currentBib++;
                $count++;
            }

            // ৩. কতজন জেনারেট হলো তা মডেলে সেভ রাখা
            $model->total_generated = $count;
        });
    }
}
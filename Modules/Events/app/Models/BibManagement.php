<?php

namespace Modules\Events\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Events\App\Models\Attendee; 

class BibManagement extends Model
{
    protected $table = 'bib_managements';
    protected $guarded = [];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(BibAssignment::class, 'bib_management_id');
    }

    protected static function booted()
    {
        static::created(function ($model) {
            
            /**
             * ✅ লজিক: 
             * ১. পেমেন্ট স্ট্যাটাস 'Success' হতে হবে (S বড় হাতের)।
             * ২. যাদের আগে কখনও এই ইভেন্টে BIB দেওয়া হয়নি।
             */
            $query = Attendee::query()
                ->where('event_id', $model->event_id)
                ->where('payment_status', 'Success') 
                ->whereDoesntHave('bibAssignments', function($q) use ($model) {
                    $q->where('event_id', $model->event_id);
                })
                ->orderBy('created_at');

            // যদি ক্যাটাগরি ফিল্টার থাকে
            if (!empty($model->category)) {
                $query->where('race_category', $model->category);
            }

            $attendees = $query->get();

            if ($attendees->isEmpty()) {
                return;
            }

            $bib = (int) $model->start_from;
            $generatedCount = 0;

            foreach ($attendees as $attendee) {
                
                $assignment = new BibAssignment();
                $assignment->bib_management_id = $model->id;
                $assignment->event_id          = $model->event_id;
                $assignment->attendee_id       = $attendee->id;
                $assignment->bib_number        = $bib;
                
                // ✅ আপনার dd() থেকে পাওয়া কি (Key) অনুযায়ী ম্যাপিং
                $assignment->first_name        = $attendee->first_name;
                $assignment->last_name         = $attendee->last_name;
                $assignment->phone             = $attendee->phone;
                $assignment->email             = $attendee->email;
                $assignment->race_category     = $attendee->race_category;
                $assignment->t_shirt_size      = $attendee->t_shirt_size;
                $assignment->blood_group       = $attendee->blood_group;
                $assignment->gender            = $attendee->gender;
                $assignment->photo_path        = $attendee->photo_path;
                
                // সেভ করা হচ্ছে
                $assignment->save(); 

                $bib++; 
                $generatedCount++;
            }

            // টোটাল কাউন্ট আপডেট (updateQuietly ব্যবহার করা হয়েছে যাতে আবার ইভেন্ট ট্রিগার না হয়)
            $model->updateQuietly([
                'total_generated' => $generatedCount
            ]);
        });
    }
}
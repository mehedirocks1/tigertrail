<?php

namespace Modules\Events\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class BibManagement extends Model
{
    protected $table = 'bib_managements';
    protected $guarded = [];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(BibAssignment::class, 'bib_management_id');
    }

    protected static function booted()
    {
        // ১. ক্রিয়েট হওয়ার আগে টোটাল কাউন্ট করে নেওয়া
        static::creating(function ($model) {
            $model->total_generated = static::getEligibleAttendeesQuery($model)->count();
        });

        // ২. ক্রিয়েট হওয়ার পর আসল বিআইবি এসাইনমেন্ট তৈরি করা (Snapshot logic)
        static::created(function ($model) {
            DB::transaction(function () use ($model) {
                $attendees = static::getEligibleAttendeesQuery($model)->get();
                $currentBib = $model->start_from;

                foreach ($attendees as $attendee) {
                    BibAssignment::create([
                        'bib_management_id' => $model->id,
                        'attendee_id'       => $attendee->id,
                        'bib_number'        => $currentBib++, // সিরিয়াল অনুযায়ী বিব বাড়ছে
                        
                        // অ্যাটেন্ডি টেবিল থেকে স্ন্যাপশট নেওয়া হচ্ছে (Permanent Data)
                        'first_name'        => $attendee->first_name,
                        'last_name'         => $attendee->last_name,
                        'phone'             => $attendee->phone,
                        'email'             => $attendee->email,
                        'race_category'     => $attendee->race_category,
                        't_shirt_size'      => $attendee->t_shirt_size,
                        'blood_group'       => $attendee->blood_group,
                        'gender'            => $attendee->gender,
                        'photo_path'        => $attendee->photo_path,
                    ]);
                }
            });
        });
    }

    /**
     * কমন কুয়েরি লজিক: কারা বিআইবি পাওয়ার যোগ্য
     */
    protected static function getEligibleAttendeesQuery($model)
    {
        $query = Attendee::where('event_id', $model->event_id)
            ->where('payment_status', 'Success') // পেমেন্ট সফল হতে হবে
            ->whereDoesntHave('bibAssignment'); // যাদের আগে বিব দেওয়া হয়নি

        if (!empty($model->category) && $model->category !== 'All Categories') {
            $query->where('race_category', $model->category);
        }

        return $query;
    }

    /**
     * একচুয়াল কাউন্ট জানার জন্য অ্যাট্রিবিউট
     */
    public function getGeneratedCountAttribute(): int
    {
        return $this->assignments()->count();
    }
}
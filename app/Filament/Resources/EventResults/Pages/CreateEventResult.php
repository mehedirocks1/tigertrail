<?php

namespace App\Filament\Resources\EventResults\Pages;

use App\Filament\Resources\EventResults\EventResultResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateEventResult extends CreateRecord
{
    protected static string $resource = EventResultResource::class;

    // মাল্টিপল ডাটা সেভ করার ওভাররাইড লজিক
    protected function handleRecordCreation(array $data): Model
    {
        $eventId = $data['event_id'];
        $category = $data['category'];
        $results = $data['results'] ?? [];

        $lastCreatedModel = null;

        // ট্রানজেকশন ব্যবহার করা হলো যাতে ভুল হলে সব বাতিল হয়ে যায়
        DB::transaction(function () use ($eventId, $category, $results, &$lastCreatedModel) {
            foreach ($results as $result) {
                // event_results টেবিলের সঠিক কলামে ডেটাগুলো বসানো হচ্ছে
                $lastCreatedModel = static::getModel()::create([
                    'event_id'     => $eventId,
                    'category'     => $category,
                    'bib_number'   => $result['bib_number'],
                    'athlete_name' => $result['athlete_name'],
                    'rank'         => $result['rank'],
                    'net_time'     => $result['net_time'],
                    'pace'         => $result['pace'],
                ]);
            }
        });

        // ফিলামেন্টের নিয়ম অনুযায়ী মডেল রিটার্ন করা হচ্ছে
        return $lastCreatedModel ?? new (static::getModel()); 
    }

    // সেভ হওয়ার পর লিস্টে ফিরে যাবে
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
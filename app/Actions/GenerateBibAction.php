<?php

namespace App\Actions;

use Modules\Events\App\Models\Attendee;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;

class GenerateBibAction
{
    public static function handle(array $data): void
    {
        DB::transaction(function () use ($data) {
            $attendees = Attendee::query()
                ->where('event_id', $data['event_id'])
                ->where('race_category', $data['category'])
                ->where('payment_status', 'success')
                ->whereNull('serial_number')
                ->orderBy('created_at')
                ->lockForUpdate()
                ->get();

            $bib = (int) $data['start_from'];

            foreach ($attendees as $attendee) {
                $attendee->update([
                    'serial_number' => $bib++
                ]);
            }
        });

        Notification::make()
            ->title('BIB Generated Successfully')
            ->success()
            ->send();
    }
}
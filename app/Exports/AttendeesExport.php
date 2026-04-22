<?php

namespace App\Exports;

use Modules\Events\App\Models\Attendee;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AttendeesExport implements FromQuery, WithHeadings, WithMapping, WithEvents
{
    protected $eventId;
    protected int $rowNumber = 0;

    public function __construct($eventId = null)
    {
        $this->eventId = $eventId;
    }

    // ✅ Filtered query
    public function query()
    {
        return Attendee::query()
            ->when($this->eventId, fn ($q) => $q->where('event_id', $this->eventId))
            ->orderBy('created_at', 'desc');
    }

    // ✅ Headers (added SL)
    public function headings(): array
    {
        return [
            'SL',
            'First Name',
            'Last Name',
            'Phone',
            'Email',
            'Event',
            'Category',
            'Age Group',
            'T-Shirt Size',
            'Fee',
            'Registered At',
        ];
    }

    // ✅ Row mapping (SL + text-safe phone)
    public function map($attendee): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $attendee->first_name,
            $attendee->last_name,
            "'" . $attendee->phone, // ✅ force text format (no auto change)
            $attendee->email,
            $attendee->event?->title,
            $attendee->race_category,
            $attendee->age_category,
            $attendee->t_shirt_size,
            $attendee->registration_fee,
            $attendee->created_at?->format('Y-m-d H:i'),
        ];
    }

    // ✅ Extra protection for Excel formatting
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('D')->getNumberFormat()
                    ->setFormatCode('@'); // Phone column = TEXT
            },
        ];
    }
}
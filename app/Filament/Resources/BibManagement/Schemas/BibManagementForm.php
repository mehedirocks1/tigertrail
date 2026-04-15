<?php

namespace App\Filament\Resources\BibManagement\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Modules\Events\App\Models\Event;
use Modules\Events\App\Models\Attendee;

class BibManagementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Generate BIB Range')
                    ->description('Assign BIB numbers to successful payments that don\'t have one yet.')
                    ->schema([
                        // ১. ইভেন্ট সিলেকশন
                        Select::make('event_id')
                            ->label('Target Event')
                            ->relationship('event', 'title')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live() // ক্যাটাগরি লোড করার জন্য লাইভ রাখা হয়েছে
                            ->columnSpan(2),

                        // ২. ক্যাটাগরি সিলেকশন (ইভেন্টের ওপর ভিত্তি করে ডাইনামিক)
                        Select::make('category')
                            ->label('Race Category')
                            ->required()
                            ->live()
                            ->options(function (Get $get) {
                                $eventId = $get('event_id');
                                if (! $eventId) return [];
                                
                                $event = Event::find($eventId);
                                if (! $event || empty($event->categories)) return [];

                                return array_combine($event->categories, $event->categories);
                            })
                            ->columnSpan(1),

                        // ৩. কোথা থেকে শুরু হবে
                        TextInput::make('start_from')
                            ->label('Start BIB From')
                            ->numeric()
                            ->default(1001)
                            ->minValue(1)
                            ->required()
                            ->columnSpan(1),

                        // ৪. একটি হেল্পার টেক্সট বা স্ট্যাটাস দেখানোর জন্য (ঐচ্ছিক)
                        Placeholder::make('status_info')
                            ->label('Quick Status')
                            ->content(function (Get $get) {
                                $eventId = $get('event_id');
                                $category = $get('category');

                                if (!$eventId || !$category) return 'Select event & category first.';

                                $count = Attendee::where('event_id', $eventId)
                                    ->where('race_category', $category) // আপনার কলাম নাম অনুযায়ী race_category
                                    ->where('payment_status', 'success')
                                    ->whereNull('serial_number')
                                    ->count();

                                return "Found {$count} attendees waiting for a BIB.";
                            })
                            ->columnSpanFull(),
                    ])->columns(4),
            ]);
    }
}
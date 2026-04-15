<?php

namespace App\Filament\Resources\EventResults\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get; 
use Filament\Schemas\Components\Utilities\Set; 
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Modules\Events\App\Models\Event;
use Modules\Events\App\Models\Attendee; 

class EventResultForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Race Details')
                    ->description('Select the event and category to load attendees.')
                    ->schema([
                        // 1. Event Selection
                        Select::make('event_id')
                            ->relationship('event', 'title') 
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live() 
                            // ইভেন্ট পাল্টালে ক্যাটাগরি এবং নিচের ফর্ম ক্লিয়ার হয়ে যাবে
                            ->afterStateUpdated(function (Set $set) {
                                $set('category', null);
                                $set('attendee_id', null);
                                $set('bib_number', null);
                                $set('athlete_name', null);
                            }) 
                            ->columnSpan(2),
                            
                        TextInput::make('rank')
                            ->label('Official Rank')
                            ->numeric()
                            ->minValue(1)
                            ->required(),

                        // 2. Dynamic Category
                        Select::make('category')
                            ->label('Race Category')
                            ->required()
                            ->live() // এটি লাইভ করা হলো যাতে ক্যাটাগরি সিলেক্ট করলে Attendee লোড হয়
                            // ক্যাটাগরি পাল্টালে Attendee সিলেকশন ক্লিয়ার হবে
                            ->afterStateUpdated(function (Set $set) {
                                $set('attendee_id', null);
                                $set('bib_number', null);
                                $set('athlete_name', null);
                            })
                            ->options(function (Get $get) {
                                $eventId = $get('event_id');
                                if (! $eventId) return []; 
                                
                                $event = Event::find($eventId);
                                if (! $event || empty($event->categories)) return [];

                                return array_combine($event->categories, $event->categories);
                            }),

                        // 3. ✨ Auto-fill Attendee List ✨
                        Select::make('attendee_id')
                            ->label('Select Attendee (Click to Auto-fill)')
                            ->placeholder('Search by Name or BIB...')
                            ->searchable()
                            ->live()
                            // এই ফিল্ডটি তখনই দেখাবে যখন Event এবং Category সিলেক্ট করা থাকবে
                            ->visible(fn (Get $get) => filled($get('event_id')) && filled($get('category')))
                            ->columnSpan(2)
                            ->options(function (Get $get) {
                                $eventId = $get('event_id');
                                $category = $get('category');

                                if (!$eventId || !$category) return [];

                                // ডেটাবেজ থেকে ওই ইভেন্ট ও ক্যাটাগরির সব Attendee-কে আনছি
                                return Attendee::where('event_id', $eventId)
                                    ->where('race_category', $category)
                                    ->get()
                                    ->mapWithKeys(function ($attendee) {
                                        // ডেটাবেজের serial_number থেকে ডেটা নিচ্ছে, কিন্তু অপশনে BIB লেখা দেখাচ্ছে
                                        return [$attendee->id => "BIB: {$attendee->serial_number} - {$attendee->name}"];
                                    });
                            })
                            // ইউজার কাউকে সিলেক্ট করার সাথে সাথেই নিচের ফিল্ডগুলো ফিল হয়ে যাবে
                            ->afterStateUpdated(function ($state, Set $set) {
                                if ($state) {
                                    $attendee = Attendee::find($state);
                                    if ($attendee) {
                                        // Attendee টেবিলের serial_number-কে ফর্মের bib_number ফিল্ডে সেট করে দিচ্ছে
                                        $set('bib_number', $attendee->serial_number);
                                        $set('athlete_name', $attendee->name);
                                    }
                                }
                            }),
                    ])->columns(2),

                Section::make('Athlete Information')
                    ->description('Auto-filled from selection above, or enter manually.')
                    ->schema([
                        TextInput::make('bib_number')
                            ->label('BIB Number')
                            ->required()
                            ->maxLength(255),
                            
                        TextInput::make('athlete_name')
                            ->label('Athlete Name')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Timing')
                    ->schema([
                        TextInput::make('net_time')
                            ->label('Net Time')
                            ->placeholder('e.g., 00:28:45')
                            ->required(),
                            
                        TextInput::make('pace')
                            ->label('Pace per KM')
                            ->placeholder('e.g., 3:50 /km')
                            ->required(),
                    ])->columns(2),
            ]);
    }
}
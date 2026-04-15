<?php

namespace App\Filament\Resources\EventResults\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
// নিচের দুটি লাইন আপডেট করা হয়েছে (Forms এর বদলে Schemas/Components/Utilities)
use Filament\Schemas\Components\Utilities\Get; 
use Filament\Schemas\Components\Utilities\Set; 
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Modules\Events\App\Models\Event;

class EventResultForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Race Details')
                    ->description('Select the event to load its specific categories.')
                    ->schema([
                        // 1. Event Selection (Live)
                        Select::make('event_id')
                            ->relationship('event', 'title') 
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live() 
                            ->afterStateUpdated(fn (Set $set) => $set('category', null)) 
                            ->columnSpan(2),
                            
                        TextInput::make('rank')
                            ->label('Official Rank')
                            ->numeric()
                            ->minValue(1)
                            ->required(),

                        // 2. Dynamic Category based on Event
                        Select::make('category')
                            ->label('Race Category')
                            ->required()
                            ->options(function (Get $get) {
                                $eventId = $get('event_id');
                                
                                if (! $eventId) {
                                    return []; 
                                }
                                
                                $event = Event::find($eventId);
                                
                                if (! $event || empty($event->categories)) {
                                    return [];
                                }

                                return array_combine($event->categories, $event->categories);
                            }),
                    ])->columns(2),

                Section::make('Athlete Information')
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
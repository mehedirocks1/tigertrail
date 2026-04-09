<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Support\Enums\FontWeight;

class EventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Event Details')
                    ->description('Core information about the event.')
                    ->schema([

                        TextEntry::make('title')
                            ->size('lg') // ✅ v4 fix
                            ->weight(FontWeight::Bold),

                        TextEntry::make('slug')
                            ->color('gray'),

                        TextEntry::make('event_date')
                            ->label('Event Date & Time')
                            ->dateTime('F j, Y, g:i a')
                            ->icon('heroicon-o-calendar'),

                        TextEntry::make('registration_deadline')
                            ->label('Registration Deadline')
                            ->dateTime('F j, Y, g:i a')
                            ->color('danger')
                            ->icon('heroicon-o-clock'),

                        IconEntry::make('is_flagship')
                            ->label('Flagship Event')
                            ->boolean(),

                    ])
                    ->columns(2),

                Section::make('Location & Configuration')
                    ->schema([

                        TextEntry::make('location')
                            ->icon('heroicon-o-map-pin'),

                        TextEntry::make('venue')
                            ->icon('heroicon-o-building-office-2'),

                        TextEntry::make('base_registration_fee')
                            ->label('Base Registration Fee')
                            ->money('BDT')
                            ->weight(FontWeight::Bold)
                            ->color('success'),

                        TextEntry::make('categories')
                            ->label('Race Categories')
                            ->badge()
                            ->separator(',')
                            ->columnSpanFull(),

                    ])
                    ->columns(2),

            ]);
    }
}
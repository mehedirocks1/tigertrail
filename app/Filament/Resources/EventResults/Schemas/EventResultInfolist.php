<?php

namespace App\Filament\Resources\EventResults\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
// ডেটা দেখানোর জন্য TextEntry ইমপোর্ট করা হলো
use Filament\Schemas\Components\TextEntry; 

class EventResultInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Race Details')
                    ->description('Overview of the event and achieved rank.')
                    ->schema([
                        TextEntry::make('event.title')
                            ->label('Event Name')
                            ->weight('bold')
                            ->color('primary')
                            ->size('lg'),

                        TextEntry::make('rank')
                            ->label('Official Rank')
                            ->badge()
                            ->size('lg')
                            // র‍্যাংক অনুযায়ী ডাইনামিক কালার ব্যাজ
                            ->color(fn (string $state): string => match ($state) {
                                '1' => 'warning', // Gold
                                '2' => 'gray',    // Silver
                                '3' => 'danger',  // Bronze
                                default => 'success',
                            }),

                        TextEntry::make('category')
                            ->label('Race Category')
                            ->badge()
                            ->color('info'),
                    ])->columns(3),

                Section::make('Athlete Information')
                    ->schema([
                        TextEntry::make('bib_number')
                            ->label('BIB Number')
                            ->fontFamily('mono')
                            ->copyable() // ক্লিক করলেই BIB কপি হয়ে যাবে
                            ->copyMessage('BIB copied to clipboard!')
                            ->icon('heroicon-m-identification'),

                        TextEntry::make('athlete_name')
                            ->label('Athlete Name')
                            ->weight('bold')
                            ->size('lg'),
                    ])->columns(2),

                Section::make('Timing')
                    ->schema([
                        TextEntry::make('net_time')
                            ->label('Net Time')
                            ->fontFamily('mono')
                            ->icon('heroicon-m-clock')
                            ->color('success'),

                        TextEntry::make('pace')
                            ->label('Pace per KM')
                            ->fontFamily('mono')
                            ->icon('heroicon-m-bolt')
                            ->color('gray'),
                    ])->columns(2),
            ]);
    }
}
<?php

namespace App\Filament\Resources\EventResults\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;

class EventResultInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                // ১. প্রোফাইল এবং হাইলাইট সেকশন
                Section::make('Athlete Performance')
                    ->schema([
                        Grid::make(3) // ৩ কলামের গ্রিড
                            ->schema([
                                // ছবি
                                ImageEntry::make('photo_path')
                                    ->label('Photo')
                                    ->circular()
                                    ->size(100)
                                    ->defaultImageUrl(url('/images/default-avatar.png'))
                                    ->columnSpan(1),

                                // নাম এবং র‍্যাংক
                                Grid::make(1)
                                    ->schema([
                                        TextEntry::make('athlete_name')
                                            ->label('Full Name')
                                            ->weight('black')
                                            ->size('xl'),
                                            
                                        TextEntry::make('rank')
                                            ->label('Official Rank')
                                            ->badge()
                                            ->size('lg')
                                            ->color(fn ($state) => match ((string) $state) {
                                                '1' => 'warning', // Gold
                                                '2' => 'gray',    // Silver
                                                '3' => 'danger',  // Bronze
                                                default => 'success',
                                            }),
                                    ])
                                    ->columnSpan(2),
                            ]),
                    ]),

                // ২. বিস্তারিত তথ্য (Info Grid)
                Grid::make(2)
                    ->schema([
                        
                        Section::make('Race Details')
                            ->schema([
                                TextEntry::make('event.title')
                                    ->label('Event Name')
                                    ->icon('heroicon-m-trophy')
                                    ->color('primary')
                                    ->weight('bold'),

                                TextEntry::make('bib_number')
                                    ->label('BIB Number')
                                    ->icon('heroicon-m-identification')
                                    ->fontFamily('mono')
                                    ->copyable()
                                    ->color('primary'),

                                TextEntry::make('category')
                                    ->label('Race Category')
                                    ->badge()
                                    ->color('info'),
                            ])
                            ->columnSpan(1),

                        Section::make('Timing & Pace')
                            ->schema([
                                TextEntry::make('net_time')
                                    ->label('Official Net Time')
                                    ->size('lg')
                                    ->weight('black')
                                    ->color('success')
                                    ->icon('heroicon-m-clock'),

                                TextEntry::make('pace')
                                    ->label('Average Pace (/km)')
                                    ->size('lg')
                                    ->weight('black')
                                    ->color('warning')
                                    ->icon('heroicon-m-bolt'),
                                    
                                TextEntry::make('created_at')
                                    ->label('Recorded Date')
                                    ->dateTime('d M Y, h:i A')
                                    ->color('gray')
                                    ->size('sm'),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }
}
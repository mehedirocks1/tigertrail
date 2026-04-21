<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contact Message Details')
                    ->schema([

                        TextEntry::make('name')
                            ->label('Sender Name')
                            ->icon('heroicon-m-user'),

                        TextEntry::make('email')
                            ->label('Email Address')
                            ->icon('heroicon-m-envelope')
                            ->copyable(),

                        TextEntry::make('subject')
                            ->label('Subject')
                            ->weight('bold')
                            ->color('primary'),

                        TextEntry::make('message')
                            ->label('Message')
                            ->columnSpanFull()
                            ->markdown()
                            ->prose(),

                        IconEntry::make('is_read')
                            ->label('Read Status')
                            ->boolean()
                            ->trueIcon('heroicon-s-check-circle')
                            ->falseIcon('heroicon-o-exclamation-circle')
                            ->trueColor('success')
                            ->falseColor('warning'),

                        TextEntry::make('created_at')
                            ->label('Received At')
                            ->dateTime('d M, Y h:i A')
                            ->icon('heroicon-m-clock')
                            ->placeholder('-'),

                        TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->dateTime('d M, Y h:i A')
                            ->placeholder('-'),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
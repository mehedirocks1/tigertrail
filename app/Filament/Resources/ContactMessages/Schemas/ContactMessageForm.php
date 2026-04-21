<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Message Details')
                    ->description('Review and manage incoming contact messages.')
                    ->schema([

                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Sender Name')
                                ->required()
                                ->maxLength(255)
                                ->prefixIcon('heroicon-m-user'),

                            TextInput::make('email')
                                ->label('Email Address')
                                ->email()
                                ->required()
                                ->prefixIcon('heroicon-m-envelope'),
                        ]),

                        TextInput::make('subject')
                            ->label('Subject')
                            ->required()
                            ->columnSpanFull()
                            ->prefixIcon('heroicon-m-chat-bubble-left-right'),

                        Textarea::make('message')
                            ->label('Message Content')
                            ->required()
                            ->rows(8)
                            ->columnSpanFull()
                            ->placeholder('Read the message carefully...'),

                        Toggle::make('is_read')
                            ->label('Mark as Read')
                            ->helperText('Enable after reviewing the message.')
                            ->inline(false),

                    ])
                    ->columns(1)
                    ->columnSpanFull(),
            ]);
    }
}
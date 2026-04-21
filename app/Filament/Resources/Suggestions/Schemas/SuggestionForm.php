<?php

namespace App\Filament\Resources\Suggestions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class SuggestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Suggestion Details')
                    ->description('Full details of the user submission.')
                    ->schema([

                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Sender Name')
                                ->required(),

                            TextInput::make('phone')
                                ->label('Mobile Number')
                                ->tel()
                                ->required(),

                            TextInput::make('email')
                                ->label('Email Address')
                                ->email()
                                ->required()
                                ->columnSpanFull(),
                        ]),

                        Textarea::make('message')
                            ->label('Suggestion / Message')
                            ->required()
                            ->rows(8) // bigger height
                            ->columnSpanFull(),

                    ])
                    ->columns(1) // FULL WIDTH SECTION
                    ->columnSpanFull(), // parent container full width
            ]);
    }
}
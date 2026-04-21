<?php

namespace App\Filament\Resources\RaceKits\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RaceKitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Kit Item Name')
                    ->placeholder('e.g., Event T-Shirt')
                    ->required()
                    ->maxLength(255),

                TextInput::make('subtitle')
                    ->label('Short Description')
                    ->placeholder('e.g., Premium Jersey')
                    ->maxLength(255),

                FileUpload::make('image_path')
                    ->label('Kit Image')
                    ->image()
                    ->disk('public') // Required for Laragon/Windows visibility
                    ->directory('kits')
                    ->nullable() // Allowed null for the "UPLOAD AT INDEX" fallback
                    ->imageEditor() // Allows cropping to keep kit images uniform
                    ->columnSpanFull(),

                TextInput::make('order')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0)
                    ->required(),

                Toggle::make('is_active')
                    ->label('Visible on Website')
                    ->default(true)
                    ->required(),
            ]);
    }
}
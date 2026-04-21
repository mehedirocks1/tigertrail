<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HeroSlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image_path')
                    ->image()
                    ->disk('public')
                    ->directory('hero-slides')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('title')
                    ->label('Main Title')
                    ->placeholder('e.g., Save the Tiger')
                    ->maxLength(255)
                    ->nullable(),

                TextInput::make('subtitle')
                    ->label('Subtitle')
                    ->placeholder('e.g., Save Sundarbans')
                    ->maxLength(255)
                    ->nullable(),

                Textarea::make('description')
                    ->label('Description')
                    ->placeholder('e.g., Bridging fitness, awareness, and conservation...')
                    ->rows(3)
                    ->columnSpanFull()
                    ->nullable(),

                TextInput::make('order')
                    ->label('Display Order')
                    ->required()
                    ->numeric()
                    ->default(0),

                Toggle::make('is_active')
                    ->label('Visible on Website')
                    ->default(true)
                    ->required(),
            ]);
    }
}
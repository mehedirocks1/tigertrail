<?php

namespace App\Filament\Resources\Testimonials\Schemas;

// --- CRITICAL IMPORTS START ---
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select; // This was likely missing!
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
// --- CRITICAL IMPORTS END ---
class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('title')
                    ->label('Runner Title')
                    ->placeholder('e.g., Marathon Runner')
                    ->maxLength(255),

                Select::make('rating')
                    ->options([
                        5 => '5 Stars',
                        4 => '4 Stars',
                        3 => '3 Stars',
                        2 => '2 Stars',
                        1 => '1 Star',
                    ])
                    ->default(5)
                    ->required(),

                Textarea::make('review')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),

                FileUpload::make('avatar_path')
                    ->label('User Avatar')
                    ->image()
                    ->avatar() // Makes the upload UI circular
                    ->disk('public')
                    ->directory('testimonials')
                    ->columnSpanFull(),

                Toggle::make('is_approved')
                    ->label('Visible on Website')
                    ->default(true),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Rewards\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RewardForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Reward Title')
                    ->placeholder('e.g., Finisher Medal')
                    ->required()
                    ->maxLength(255),

                TextInput::make('description')
                    ->label('Short Description')
                    ->placeholder('e.g., For All Finishers')
                    ->maxLength(255),

                FileUpload::make('image_path')
                    ->label('Reward Image')
                    ->image()
                    ->disk('public') // Ensures visibility on frontend
                    ->directory('rewards')
                    ->nullable() // Allowed null so the "UPLOAD AT INDEX" fallback works
                    ->imageEditor() // Optional: Allows cropping in the dashboard
                    ->columnSpanFull(),

                TextInput::make('order')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0)
                    ->required(),

                Toggle::make('is_active')
                    ->label('Visible in Marquee')
                    ->default(true)
                    ->required(),
            ]);
    }
}
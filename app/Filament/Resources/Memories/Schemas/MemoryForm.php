<?php

namespace App\Filament\Resources\Memories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MemoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Overlay Text')
                    ->placeholder('e.g., Champions, Race Start, Finisher Circle')
                    ->maxLength(50)
                    ->helperText('This text appears on featured (highlighted) images.'),

                FileUpload::make('image_path')
                    ->label('Memory Photo')
                    ->image()
                    ->disk('public')
                    ->directory('memories')
                    ->required()
                    // Fixed size control: Force 3:4 aspect ratio
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '3:4',
                    ])
                    ->columnSpanFull(),

                Toggle::make('is_featured')
                    ->label('Featured / Highlighted')
                    ->helperText('If enabled, this image will be larger and have the Tiger Orange border.')
                    ->default(false),

                TextInput::make('order')
                    ->label('Display Order')
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
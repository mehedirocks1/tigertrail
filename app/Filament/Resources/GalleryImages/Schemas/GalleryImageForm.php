<?php

namespace App\Filament\Resources\GalleryImages\Schemas;

use App\Models\GalleryImage;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get; // Updated v5 Namespace
use Filament\Schemas\Schema;

class GalleryImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image_path')
                    ->image()
                    ->disk('public')
                    ->directory('gallery')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('title')
                    ->maxLength(255)
                    ->nullable(),

                TextInput::make('subtitle')
                    ->maxLength(255)
                    ->nullable(),

                Select::make('category')
                    ->label('Category')
                    ->options(function (Get $get) {
                        // 1. Fetch existing categories
                        $options = GalleryImage::whereNotNull('category')
                            ->pluck('category', 'category')
                            ->unique()
                            ->toArray();

                        // 2. Prevent validation drop for newly created categories
                        $currentState = $get('category');
                        if ($currentState && !isset($options[$currentState])) {
                            $options[$currentState] = $currentState;
                        }

                        return $options;
                    })
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('new_category')
                            ->label('Add New Category')
                            ->placeholder('e.g. Marathon 2026')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->createOptionUsing(function (array $data) {
                        return $data['new_category'];
                    })
                    ->required(),

                Select::make('col_span')
                    ->label('Width (Columns)')
                    ->options([
                        '1' => 'Normal (1 Col)',
                        '2' => 'Wide (2 Cols)',
                    ])
                    ->default(1)
                    ->required(),

                Select::make('row_span')
                    ->label('Height (Rows)')
                    ->options([
                        '1' => 'Normal (1 Row)',
                        '2' => 'Tall (2 Rows)',
                    ])
                    ->default(1)
                    ->required(),

                Toggle::make('is_highlight')
                    ->label('Highlight Effect')
                    ->default(false),

                TextInput::make('order')
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
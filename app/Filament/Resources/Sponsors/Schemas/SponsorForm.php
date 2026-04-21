<?php

namespace App\Filament\Resources\Sponsors\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class SponsorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Sponsor Information')
                    ->description('Manage sponsor details and category-specific logo alignment.')
                    ->schema([

                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Sponsor Name')
                                ->required(),

                            Select::make('type')
                                ->label('Sponsor Category')
                                ->options([
                                    'title' => 'Title Sponsor',
                                    'powered_by' => 'Powered By',
                                    'organizer' => 'Organizer',
                                ])
                                ->required()
                                ->native(false)
                                ->live()
                                ->afterStateUpdated(fn ($state, callable $set) => $set('logo_path', null)),
                        ]),

                        FileUpload::make('logo_path')
                            ->label('Sponsor Logo')
                            ->image()
                            ->disk('public')
                            ->directory('sponsors')
                            ->visibility('public')
                            ->required()
                            ->imageEditor()
                            ->helperText(fn ($get) => match ($get('type')) {
                                'title'      => 'Recommended Height: 100px',
                                'powered_by' => 'Recommended Height: 64px',
                                'organizer'  => 'Recommended Height: 48px',
                                default      => 'Select category first',
                            })
                            ->columnSpanFull(),

                        Grid::make(2)->schema([
                            TextInput::make('website_url')
                                ->label('Website URL')
                                ->url()
                                ->prefix('https://')
                                ->placeholder('example.com'),

                            TextInput::make('sort_order')
                                ->label('Display Order')
                                ->numeric()
                                ->default(0)
                                ->minValue(0),

                            Toggle::make('is_active')
                                ->label('Visible on Website')
                                ->default(true)
                                ->columnSpanFull(),
                        ]),

                    ])
                    ->columns(1) // FULL WIDTH SECTION
                    ->columnSpanFull(), // FULL WIDTH OUTER
            ]);
    }
}


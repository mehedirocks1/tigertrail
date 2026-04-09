<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Schemas\Schema;
// Layout components moved to Filament\Schemas\Components in v4
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid; 
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Str;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Event Status')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Event Visibility')
                            ->helperText('Enable to show this event on the frontend.')
                            ->default(true)
                            ->onColor('success'),
                        
                        Toggle::make('is_flagship')
                            ->label('Is Flagship Event?')
                            ->helperText('Flagship events require a description for the homepage.')
                            ->live() 
                            ->inline(false)
                            ->default(false)
                            ->onColor('warning'),
                    ])->columns(2),

                Section::make('Event Details')
                    ->description('Core information about the marathon or walkathon.')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        DateTimePicker::make('event_date')
                            ->label('Event Date & Time*')
                            ->placeholder('DD/MM/YYYY HH:MM')
                            ->native(false)
                            ->displayFormat('d/m/Y H:i')
                            ->required(),

                        DateTimePicker::make('registration_deadline')
                            ->label('Registration Deadline')
                            ->placeholder('DD/MM/YYYY HH:MM')
                            ->native(false)
                            ->displayFormat('d/m/Y H:i')
                            ->required(),

                        Textarea::make('description')
                            ->label('Event Description')
                            ->placeholder('Highlight the importance of this event...')
                            ->required(fn (callable $get) => $get('is_flagship'))
                            ->columnSpanFull()
                            ->rows(3),

                    ])->columns(2),

                Section::make('Location & Configuration')
                    ->description('Where is it happening and what are the costs?')
                    ->schema([
                        TextInput::make('location')
                            ->default('Dhaka, BD')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('venue')
                            ->placeholder('e.g. Hatirjheel Circuit')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('base_registration_fee')
                            ->label('Base Registration Fee')
                            ->numeric()
                            ->prefix('BDT')
                            ->required()
                            ->default(1000.00),

                        TagsInput::make('categories')
                            ->label('Race Categories')
                            ->placeholder('Enter distance (e.g. 5K, 7.5K) and press enter')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Participant Restrictions')
                    ->description('Choose which age groups are permitted to register.')
                    ->schema([
                        // FIXED: Grid::make() now works with the correct namespace import above
                        Grid::make(3)
                            ->schema([
                                Toggle::make('allow_infants')
                                    ->label('Infants (7-10)')
                                    ->default(true)
                                    ->onColor('info'),

                                Toggle::make('allow_kids')
                                    ->label('Kids (10-14)')
                                    ->default(true)
                                    ->onColor('info'),

                                Toggle::make('allow_adults')
                                    ->label('Adults (14+)')
                                    ->default(true)
                                    ->onColor('info'),
                            ]),
                    ]),
            ]);
    }
}
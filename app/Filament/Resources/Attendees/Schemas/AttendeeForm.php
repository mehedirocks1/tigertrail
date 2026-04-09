<?php

namespace App\Filament\Resources\Attendees\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

class AttendeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Registration Status & Photo')
                    ->schema([
                        Select::make('event_id')
                            ->label('Registered Event')
                            ->relationship('event', 'title')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),

                        FileUpload::make('photo_path')
                            ->label('Runner ID Photo')
                            ->image()
                            ->directory('attendee-photos')
                            ->maxSize(5120)
                            ->columnSpanFull(),

                        TextInput::make('registration_fee')
                            ->label('Registration Fee')
                            ->numeric()
                            ->prefix('BDT')
                            ->required(),

                        Toggle::make('waiver_accepted')
                            ->label('Waiver Accepted')
                            ->required(),

                        Toggle::make('terms_accepted')
                            ->label('Terms Accepted')
                            ->required(),
                    ])->columns(2),

                Section::make('Personal Information')
                    ->schema([
                        TextInput::make('first_name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('last_name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(20),

                        DatePicker::make('date_of_birth')
                            ->required(),

                        TextInput::make('age_category')
                            ->label('Age Category')
                            ->required()
                            ->maxLength(255),

                        Select::make('gender')
                            ->options([
                                'Male' => 'Male',
                                'Female' => 'Female',
                                'Other' => 'Other',
                            ])
                            ->required(),

                        TextInput::make('nationality')
                            ->maxLength(100),
                    ])->columns(2),

                Section::make('Race Details')
                    ->schema([
                        Select::make('race_category')
                            ->label('Race Category')
                            ->options([
                                '5K' => '5K Walk/Run',
                                '7.5K' => '7.5K Mini Marathon',
                                '10K' => '10K Run',
                                'Half Marathon' => '21K Half Marathon',
                            ])
                            ->required(),

                        Select::make('t_shirt_size')
                            ->label('T-Shirt Size')
                            ->options([
                                'S' => 'Small (S)',
                                'M' => 'Medium (M)',
                                'L' => 'Large (L)',
                                'XL' => 'Extra Large (XL)',
                                'XXL' => 'Double XL (XXL)',
                            ])
                            ->required(),

                        TextInput::make('expected_finish_time')
                            ->placeholder('e.g. 01:30')
                            ->maxLength(255),

                        TextInput::make('club_or_team')
                            ->label('Club / Team')
                            ->maxLength(255),

                        TextInput::make('previous_marathons')
                            ->numeric()
                            ->minValue(0),
                    ])->columns(2),

                Section::make('Health & Emergency')
                    ->schema([
                        Select::make('blood_group')
                            ->options([
                                'A+' => 'A+', 'A-' => 'A-',
                                'B+' => 'B+', 'B-' => 'B-',
                                'O+' => 'O+', 'O-' => 'O-',
                                'AB+' => 'AB+', 'AB-' => 'AB-',
                            ])
                            ->required(),

                        TextInput::make('medical_conditions')
                            ->maxLength(255),

                        TextInput::make('emergency_contact_name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('emergency_contact_phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),

                        TextInput::make('emergency_contact_relation')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Mailing Address')
                    ->schema([
                        TextInput::make('address_line')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('city')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('state_or_district')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('postal_code')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('country')
                            ->required()
                            ->maxLength(255)
                            ->default('Bangladesh'),
                    ])->columns(2),
            ]);
    }
}
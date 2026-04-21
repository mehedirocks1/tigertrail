<?php

namespace App\Filament\Resources\Brochures\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BrochureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Brochure Title')
                    ->required()
                    ->default('Read Our Previous Tiger Run Brochure')
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Short Description')
                    ->placeholder('e.g., Learn about our impact and previous event highlights...')
                    ->rows(3)
                    ->columnSpanFull(),

                FileUpload::make('image_path')
                    ->label('Cover Image (Visual Preview)')
                    ->image()
                    ->disk('public')
                    ->directory('brochures/covers')
                    ->imageEditor() // Allows cropping the brochure cover
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('file_path')
                    ->label('Brochure PDF File')
                    ->disk('public')
                    ->directory('brochures/pdfs')
                    ->acceptedFileTypes(['application/pdf']) // Restrict to PDF only
                    ->preserveFilenames() // Keeps the actual name of the uploaded PDF
                    ->maxSize(10240) // Limit to 10MB
                    ->required()
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Visible on Website')
                    ->default(true)
                    ->required(),
            ]);
    }
}
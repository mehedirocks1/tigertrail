<?php

namespace App\Filament\Resources\Activities\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema; // Note: In newer Filament V3, this is usually Filament\Forms\Form

class ActivityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('category')
                    ->required(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                
                // এখানে disk('public') যুক্ত করা হয়েছে
                FileUpload::make('image_path')
                    ->image()
                    ->disk('public') // ডিস্ক পাবলিক করা হলো
                    ->directory('activities') // (ঐচ্ছিক) public ফোল্ডারের ভেতরে 'activities' ফোল্ডারে সেভ হবে
                    ->required(),
                    
                TextInput::make('link_text')
                    ->required()
                    ->default('Learn More'),
                TextInput::make('link_url')
                    ->url(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
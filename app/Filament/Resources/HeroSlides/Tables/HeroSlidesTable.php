<?php

namespace App\Filament\Resources\HeroSlides\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HeroSlidesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Slide Image')
                    ->disk('public'), // Ensures it looks in storage/app/public

                TextColumn::make('title')
                    ->label('Main Title')
                    ->searchable()
                    ->sortable()
                    ->default('Save the Tiger'),

                TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(30)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('order')
                    ->label('Order')
                    ->numeric()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Active Status')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Add table filters here if needed
            ])
            ->actions([ // Standard v5 method for row actions
                EditAction::make(),
                DeleteAction::make(), // Row-level delete button
            ])
            ->bulkActions([ // Standard v5 method for bulk actions
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
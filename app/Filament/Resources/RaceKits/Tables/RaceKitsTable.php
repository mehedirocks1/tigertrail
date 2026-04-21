<?php

namespace App\Filament\Resources\RaceKits\Tables;

use Filament\Actions\DeleteAction; // Unified v5 Namespace
use Filament\Actions\EditAction;   // Unified v5 Namespace
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RaceKitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Kit Item')
                    ->disk('public'), // Ensures thumbnails show in storage/app/public

                TextColumn::make('name')
                    ->label('Item Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('subtitle')
                    ->label('Description')
                    ->searchable(),

                TextColumn::make('order')
                    ->label('Sort Order')
                    ->numeric()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Status')
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
                //
            ])
            ->actions([ 
                // Row-level actions (v5 syntax)
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([ 
                // Grouped actions for multiple selection
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
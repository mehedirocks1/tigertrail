<?php

namespace App\Filament\Resources\Memories\Tables;

// ১. Unified Actions (v5 Standard)
// এই নেমস্পেসগুলোই আপনার ActionGroup এবং Row Actions-এর জন্য কাজ করবে
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;

// ২. Table Specific (Bulk Actions)
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

// ৩. Columns & Table
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class MemoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Photo')
                    ->disk('public')
                    ->square(),

                TextColumn::make('title')
                    ->label('Overlay Text')
                    ->searchable()
                    ->placeholder('No title set'),

                ToggleColumn::make('is_featured')
                    ->label('Featured'),

                TextColumn::make('order')
                    ->label('Sort')
                    ->numeric()
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Status'),
            ])
            ->reorderable('order') 
            ->defaultSort('order', 'asc')
            ->actions([ 
                // এখানে ActionGroup ব্যবহার করলে এর ভেতরের অ্যাকশনগুলো 
                // ওপরের Filament\Actions নেমস্পেস থেকে আসতে হবে
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ])
                ->icon('heroicon-m-ellipsis-vertical')
                ->color('gray'),
            ])
            ->bulkActions([ 
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
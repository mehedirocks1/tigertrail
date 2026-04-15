<?php

namespace App\Filament\Resources\EventResults\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
// ডাইনামিক ফিল্টারের জন্য EventResult মডেলটি ইমপোর্ট করা হলো
use Modules\Events\App\Models\EventResult; 

class EventResultsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('rank')
                    ->label('Rank')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'warning', // Gold
                        '2' => 'gray',    // Silver
                        '3' => 'danger',  // Bronze
                        default => 'success',
                    }),

                TextColumn::make('bib_number')
                    ->label('BIB')
                    ->searchable()
                    ->fontFamily('mono')
                    ->copyable() // ক্লিক করলেই কপি হবে
                    ->copyMessage('BIB Copied!'),

                TextColumn::make('athlete_name')
                    ->label('Athlete Name')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                TextColumn::make('net_time')
                    ->label('Net Time')
                    ->fontFamily('mono')
                    ->sortable(),

                TextColumn::make('pace')
                    ->label('Pace')
                    ->fontFamily('mono')
                    ->color('gray'),

                // ইভেন্টের নাম ডিফল্টভাবে হাইড করা থাকবে (toggle করে দেখা যাবে)
                TextColumn::make('event.title')
                    ->label('Event')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('rank', 'asc')
            ->filters([
                SelectFilter::make('event_id')
                    ->label('Filter by Event')
                    ->relationship('event', 'title'),
                    
                // ডাটাবেজ থেকে আসা ডাইনামিক ক্যাটাগরি ফিল্টার
                SelectFilter::make('category')
                    ->label('Filter by Category')
                    ->options(fn () => EventResult::query()
                        ->select('category')
                        ->distinct()
                        ->whereNotNull('category')
                        ->pluck('category', 'category')
                        ->toArray()
                    ),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
<?php

namespace App\Filament\Resources\BibManagement\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
// ফিলামেন্ট ৫.৫ এর সঠিক নেমস্পেস
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class BibManagementTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Generated Date')
                    ->dateTime('d M, Y h:i A')
                    ->sortable()
                    ->color('gray'),

                TextColumn::make('event.title')
                    ->label('Event')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->color('info')
                    ->searchable(),

                TextColumn::make('start_from')
                    ->label('Start BIB')
                    ->fontFamily('mono')
                    ->alignCenter(),

                TextColumn::make('total_generated')
                    ->label('Assigned Count')
                    ->badge()
                    ->color('success')
                    ->alignCenter()
                    ->suffix(' Athletes'),

                // এন্ডিং নাম্বারটি ক্যালকুলেট করে দেখানো হচ্ছে
                TextColumn::make('end_number')
                    ->label('End BIB')
                    ->fontFamily('mono')
                    ->getStateUsing(fn ($record) => $record->start_from + ($record->total_generated > 0 ? $record->total_generated - 1 : 0))
                    ->alignCenter(),
            ])
            ->defaultSort('created_at', 'desc') // সর্বশেষ জেনারেশন সবার উপরে থাকবে
            ->filters([
                SelectFilter::make('event_id')
                    ->label('Filter by Event')
                    ->relationship('event', 'title'),
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
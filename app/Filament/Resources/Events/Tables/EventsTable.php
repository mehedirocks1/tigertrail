<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('title')
                    ->label('Event Name')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold),

                TextColumn::make('event_date')
                    ->label('Event Date')
                    ->dateTime('M j, Y g:i A')
                    ->sortable(),

                TextColumn::make('registration_deadline')
                    ->label('Deadline')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->color('danger')
                    ->toggleable(),

                TextColumn::make('location')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('base_registration_fee')
                    ->label('Fee')
                    ->money('BDT')
                    ->sortable(),

                TextColumn::make('categories')
                    ->label('Categories')
                    ->badge()
                    ->formatStateUsing(fn ($state) => is_array($state)
                        ? implode(', ', $state)
                        : $state)
                    ->searchable(),

                IconColumn::make('is_flagship')
                    ->label('Flagship')
                    ->boolean()
                    ->sortable(),

            ])

            ->filters([
                TernaryFilter::make('is_flagship')
                    ->label('Flagship Status'),
            ])

            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])

            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
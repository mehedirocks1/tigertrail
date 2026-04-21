<?php

namespace App\Filament\Resources\Sponsors\Tables;

// Filament v5.x Table Action Namespaces
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;

// ২. Bulk Actions - এগুলো এখনো টেবিলের সিলেকশন লজিকের সাথে যুক্ত
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

// ৩. Columns & Table
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class SponsorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo_path')
                    ->label('Logo')
                    ->disk('public')
                    ->height(40),

                TextColumn::make('name')
                    ->label('Sponsor Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Tier')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'title' => 'success',
                        'powered_by' => 'warning',
                        'organizer' => 'info',
                        default => 'gray',
                    })
                    ->searchable(),

                TextColumn::make('website_url')
                    ->label('Link')
                    ->icon('heroicon-m-link')
                    ->color('primary')
                    ->limit(20),

                TextColumn::make('sort_order')
                    ->label('Sort')
                    ->numeric()
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Status'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            // Drag-and-drop sorting feature
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc')
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ])
                ->icon('heroicon-m-ellipsis-vertical')
                ->color('gray')
                ->tooltip('Options'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
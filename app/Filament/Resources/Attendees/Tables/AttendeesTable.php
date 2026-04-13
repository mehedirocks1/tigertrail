<?php

namespace App\Filament\Resources\Attendees\Tables;

use Modules\Events\App\Models\Attendee;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;

// Import the Excel Export Actions
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class AttendeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query, Table $table) {
                $filters = $table->getLivewire()->tableFilters;

                if (empty($filters['event_id']['value'])) {
                    $query->whereRaw('1 = 0');
                }
            })
            ->emptyStateHeading('No Event Selected')
            ->emptyStateDescription('Please choose an event from the filter dropdown above to load the attendee list.')
            ->emptyStateIcon('heroicon-o-funnel')
            
            ->columns([
                // NEW: Serial Number Column
                TextColumn::make('index')
                    ->label('SL')
                    ->rowIndex(), // Automatically generates 1, 2, 3, etc.

                ImageColumn::make('photo_path')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl(url('https://ui-avatars.com/api/?name=Runner&background=F97316&color=fff')),

                TextColumn::make('first_name')
                    ->label('First Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('last_name')
                    ->label('Last Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('event.title')
                    ->label('Event')
                    ->searchable()
                    ->sortable()
                    ->limit(20)
                    ->toggleable(),

                TextColumn::make('race_category')
                    ->label('Category')
                    ->badge()
                    ->color('warning')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->searchable(),

                TextColumn::make('email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('age_category')
                    ->label('Age Group')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('t_shirt_size')
                    ->label('T-Shirt')
                    ->badge()
                    ->color('success')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('registration_fee')
                    ->label('Fee')
                    ->money('BDT')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Registered On')
                    ->dateTime('M j, Y h:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('event_id')
                    ->label('Filter by Event')
                    ->relationship('event', 'title')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('race_category')
                    ->label('Filter by Distance')
                    ->options(fn () => Attendee::query()
                        ->whereNotNull('race_category')
                        ->distinct()
                        ->pluck('race_category', 'race_category')
                        ->toArray()
                    ),
            ], layout: FiltersLayout::AboveContent)
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Export to Excel')
                    ->color('success')
                    ->icon('heroicon-o-document-arrow-down')
                    ->hidden(fn ($livewire) => empty($livewire->tableFilters['event_id']['value'])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->label('Export Selected to Excel'),
                ]),
            ]);
    }
}
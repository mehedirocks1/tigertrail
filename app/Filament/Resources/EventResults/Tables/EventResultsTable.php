<?php

namespace App\Filament\Resources\EventResults\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Builder;
use Modules\Events\App\Models\EventResult;

class EventResultsTable
{
    public static function configure(Table $table): Table
    {
        return $table

            // ✅ FIXED v5 QUERY HANDLING
            ->modifyQueryUsing(function (Builder $query, $livewire) {

                $eventId = $livewire->getTableFilterState('event_id')['value'] ?? null;

                if (blank($eventId)) {
                    $query->whereRaw('1 = 0');
                    return;
                }

                $query->where('event_id', $eventId);
            })

            ->emptyStateHeading('Select an Event')
            ->emptyStateDescription('Please choose an event from the filter above and click "Apply" to view the results.')
            ->emptyStateIcon('heroicon-o-trophy')

            ->columns([

                ImageColumn::make('photo_path')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-avatar.png')),

                TextColumn::make('rank')
                    ->label('Rank')
                    ->sortable()
                    ->badge()
                    ->color(fn ($state) => match ((string) $state) {
                        '1' => 'warning',
                        '2' => 'gray',
                        '3' => 'danger',
                        default => 'success',
                    }),

                TextColumn::make('bib_number')
                    ->label('BIB')
                    ->searchable()
                    ->fontFamily('mono')
                    ->copyable()
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

                TextColumn::make('event.title')
                    ->label('Event')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->groups([
                Group::make('event.title')->collapsible(),
                Group::make('category')->collapsible(),
            ])

            ->defaultGroup('category')
            ->defaultSort('rank', 'asc')

            ->filters([
                SelectFilter::make('event_id')
                    ->label('Select Event First')
                    ->relationship('event', 'title')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('category')
                    ->label('Filter by Category')
                    ->options(fn () =>
                        EventResult::query()
                            ->select('category')
                            ->distinct()
                            ->whereNotNull('category')
                            ->pluck('category', 'category')
                            ->toArray()
                    ),
            ])

            ->filtersLayout(FiltersLayout::AboveContent)

            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
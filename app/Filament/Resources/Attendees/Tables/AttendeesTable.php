<?php

namespace App\Filament\Resources\Attendees\Tables;

use Modules\Events\App\Models\Attendee;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;

use App\Exports\AttendeesExport;
use Maatwebsite\Excel\Facades\Excel;

class AttendeesTable
{
    public static function configure(Table $table): Table
    {
        return $table

            // ✅ FIX: proper filtering for table
            ->modifyQueryUsing(function (Builder $query, Table $table) {
                $filters = $table->getLivewire()->tableFilters ?? [];

                $eventId = $filters['event_id']['value'] ?? null;

                if (!$eventId) {
                    $query->whereRaw('1 = 0');
                    return;
                }

                $query->where('event_id', $eventId);
            })

            ->emptyStateHeading('No Event Selected')
            ->emptyStateDescription('Please choose an event from the filter dropdown above to load the attendee list.')
            ->emptyStateIcon('heroicon-o-funnel')

            ->columns([
                TextColumn::make('sl')
                    ->label('SL')
                    ->state(fn ($rowLoop) => $rowLoop->iteration),

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

            // ✅ FIXED EXPORT (NO pxlrbt bug)
            ->headerActions([
                \Filament\Actions\Action::make('export')
                    ->label('Export to Excel')
                    ->color('success')
                    ->icon('heroicon-o-document-arrow-down')
                    ->hidden(function ($livewire) {
                        return empty($livewire->tableFilters['event_id']['value'] ?? null);
                    })
                    ->action(function ($livewire) {

                        $eventId = $livewire->tableFilters['event_id']['value'] ?? null;

                        return Excel::download(
                            new AttendeesExport($eventId),
                            'attendees.xlsx'
                        );
                    }),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
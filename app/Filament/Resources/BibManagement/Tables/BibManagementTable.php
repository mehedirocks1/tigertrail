<?php

namespace App\Filament\Resources\BibManagement\Tables;

use Filament\Tables\Table; // সঠিক ক্লাস
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout; 
use Illuminate\Database\Eloquent\Builder;
use Modules\Events\App\Models\Event;
use Modules\Events\App\Models\BibAssignment;

class BibManagementTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $filters = request()->get('tableFilters');
                $eventId = $filters['event_id']['value'] ?? null;

                if (blank($eventId)) {
                    return $query->whereRaw('1 = 0');
                }

                return $query->whereHas('bibManagement', function ($q) use ($eventId) {
                    $q->where('event_id', $eventId);
                });
            })
            ->columns([
                ImageColumn::make('photo_path')
                    ->label('Photo')
                    ->circular()
                    ->disk('public') // আপনার ডিস্ক অনুযায়ী
                    ->defaultImageUrl(url('/images/default-avatar.png')),

                TextColumn::make('bib_number')
                    ->label('BIB')
                    ->badge()
                    ->color('success')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('first_name')
                    ->label('Full Name')
                    ->formatStateUsing(fn ($record) => trim(($record->first_name ?? '') . ' ' . ($record->last_name ?? '')))
                    ->description(fn ($record) => "T-Shirt: " . ($record->t_shirt_size ?? 'N/A'))
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where('first_name', 'like', "%{$search}%")
                                     ->orWhere('last_name', 'like', "%{$search}%");
                    }),

                TextColumn::make('phone')
                    ->label('Mobile')
                    ->copyable()
                    ->searchable(),

                TextColumn::make('race_category')
                    ->label('Category')
                    ->badge(),

                ToggleColumn::make('is_kit_collected')
                    ->label('Kit Taken')
                    ->onColor('success')
                    ->offColor('danger'),

                TextColumn::make('collected_at')
                    ->label('Time')
                    ->dateTime('h:i A, d M')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('event_id')
                    ->label('Select Event')
                    ->options(fn () => Event::pluck('title', 'id')) 
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'],
                            fn (Builder $query, $value): Builder => $query->whereHas('bibManagement', fn ($q) => $q->where('event_id', $value))
                        );
                    })
                    ->searchable()
                    ->preload(),

                SelectFilter::make('race_category')
                    ->label('Category')
                    ->options(fn () => BibAssignment::distinct()->pluck('race_category', 'race_category')->toArray()),
                    
                SelectFilter::make('is_kit_collected')
                    ->label('Collection Status')
                    ->options([
                        '1' => 'Collected',
                        '0' => 'Pending',
                    ]),
            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->emptyStateHeading('Please select an event to view the BIB list');
    }
}
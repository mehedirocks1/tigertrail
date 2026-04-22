<?php

namespace App\Filament\Resources\BibManagement\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;
use Modules\Events\App\Models\Event;
use Modules\Events\App\Models\BibAssignment;

class BibManagementTable
{
    /**
     * ✅ মেথড ১: এটি BIB জেনারেশন বা ব্যাচ ম্যানেজমেন্টের জন্য (id, event_id, status)
     * এটি কল হবে BibManagementResource থেকে
     */
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('event.title')->label('Event')->searchable(),
                TextColumn::make('category')->label('Category')->badge()->placeholder('Global'),
                TextColumn::make('start_from')->label('Start')->alignCenter(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        default => 'primary',
                    }),
                IconColumn::make('is_locked')
                    ->label('Locked')
                    ->boolean()
                    ->trueIcon('heroicon-o-lock-closed')
                    ->falseIcon('heroicon-o-lock-open'),
                TextColumn::make('created_at')->label('Created')->dateTime('d M, Y'),
            ])
            ->filters([
                SelectFilter::make('event_id')
                    ->label('Event')
                    ->options(fn () => Event::pluck('title', 'id')),
            ])
            ->filtersLayout(FiltersLayout::AboveContent);
    }

    /**
     * ✅ মেথড ২: এটি শুধু এটেন্ডি বা BIB লিস্ট দেখানোর জন্য (BIB, Name, Category)
     * এটি কল হবে BibAssignmentResource থেকে
     */
    public static function configureAssignmentTable(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query, $livewire) {
                $eventId = data_get($livewire, 'tableFilters.event_id.value');
                if (!$eventId) return $query->whereRaw('1 = 0'); // ইভেন্ট ছাড়া খালি থাকবে
                return $query->where('event_id', $eventId);
            })
            ->columns([
                TextColumn::make('bib_number')
                    ->label('BIB')
                    ->badge()
                    ->color('success')
                    ->weight('bold')
                    ->searchable(),

                TextColumn::make('first_name')
                    ->label('Name')
                    ->formatStateUsing(fn ($record) => trim($record->first_name . ' ' . $record->last_name))
                    ->description(fn ($record) => $record->phone)
                    ->searchable(['first_name', 'last_name', 'phone']),

                TextColumn::make('race_category')
                    ->label('Category')
                    ->badge(),

                ToggleColumn::make('is_kit_collected')
                    ->label('Collected'),
            ])
            ->filters([
                SelectFilter::make('event_id')
                    ->label('Event')
                    ->options(fn () => Event::pluck('title', 'id'))
                    ->searchable()
                    ->preload(),
            ])
            ->filtersLayout(FiltersLayout::AboveContent);
    }
}
<?php

namespace App\Filament\Resources\BibManagement\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;
use Modules\Events\App\Models\Event;
use Carbon\Carbon;

class BibManagementTable
{
    /**
     * ✅ মেথড ১: BIB জেনারেশন বা ব্যাচ ম্যানেজমেন্টের জন্য
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
     * ✅ মেথড ২: আপডেট করা এটেন্ডি BIB লিস্ট (বয়স এবং টি-শার্ট ফিক্সড)
     */
    public static function configureAssignmentTable(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query, $livewire) {
                $eventId = data_get($livewire, 'tableFilters.event_id.value');
                if (!$eventId) return $query->whereRaw('1 = 0');
                
                return $query->where('event_id', $eventId)->with(['attendee']);
            })
            ->columns([
                // SL (Attendee টেবিলের সিরিয়াল)
                TextColumn::make('attendee.serial_number')
                    ->label('SL')
                    ->sortable(),

                // ফটো
                ImageColumn::make('attendee.photo_path')
                    ->label('Photo')
                    ->circular()
                    ->disk('public'),

                // BIB নম্বর
                TextColumn::make('bib_number')
                    ->label('BIB')
                    ->badge()
                    ->color('success')
                    ->weight('bold')
                    ->sortable()
                    ->searchable(),

                // নাম
                TextColumn::make('attendee.first_name')
                    ->label('Name')
                    ->formatStateUsing(fn ($record) => trim(($record->attendee->first_name ?? '') . ' ' . ($record->attendee->last_name ?? '')))
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('attendee', function ($q) use ($search) {
                            $q->where('first_name', 'like', "%{$search}%")
                              ->orWhere('last_name', 'like', "%{$search}%");
                        });
                    }),

                // মোবাইল নম্বর
                TextColumn::make('attendee.phone')
                    ->label('Mobile')
                    ->searchable()
                    ->copyable(),

                // Race Category
                TextColumn::make('race_category')
                    ->label('Race Category')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                // ✅ বয়স (date_of_birth থেকে ক্যালকুলেশন)
                TextColumn::make('attendee.date_of_birth')
                    ->label('Age')
                    ->formatStateUsing(function ($state) {
                        if (!$state) return 'N/A';
                        return Carbon::parse($state)->age; // কার্বন অটোমেটিক বয়স বের করে দেবে
                    })
                    ->alignCenter(),

                // বয়স ক্যাটাগরি
                TextColumn::make('attendee.age_category')
                    ->label('Age Category')
                    ->placeholder('N/A'),

                // ✅ টি-শার্ট সাইজ (t_shirt_size কলাম নাম আপডেট করা হয়েছে)
                TextColumn::make('attendee.t_shirt_size')
                    ->label('T-Shirt')
                    ->badge()
                    ->color('gray')
                    ->alignCenter(),

                // কিট কালেকশন টগল
                ToggleColumn::make('is_kit_collected')
                    ->label('Collected')
                    ->onColor('success')
                    ->offColor('danger'),
            ])
            ->filters([
                SelectFilter::make('event_id')
                    ->label('Event')
                    ->options(fn () => Event::pluck('title', 'id'))
                    ->searchable()
                    ->preload(),
            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->persistFiltersInSession()
            ->deferLoading();
    }
}
<?php

namespace App\Filament\Resources\BibManagement\Schemas;

use Filament\Schemas\Schema;

// ✅ লেআউট (Layout) কম্পোনেন্টগুলো এখন Schemas ফোল্ডারে
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

// ✅ ডেটা এন্ট্রি (Entry) কম্পোনেন্টগুলো Infolists ফোল্ডারে
use Filament\Infolists\Components\TextEntry;

class BibManagementInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('BIB Generation Summary')
                    ->description('Details of the BIB numbers assigned in this batch.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('event.title')
                                    ->label('Event Name')
                                    ->weight('bold')
                                    ->color('primary'),

                                TextEntry::make('category')
                                    ->label('Race Category')
                                    ->badge()
                                    ->color('info'),

                                TextEntry::make('created_at')
                                    ->label('Generated Date')
                                    ->dateTime('d M, Y - h:i A')
                                    ->color('gray'),
                            ]),

                        Grid::make(3)
                            ->schema([
                                TextEntry::make('start_from')
                                    ->label('Started From')
                                    ->fontFamily('mono')
                                    ->icon('heroicon-m-hashtag'),

                                TextEntry::make('total_generated')
                                    ->label('Total Athletes Assigned')
                                    ->badge()
                                    ->color('success')
                                    ->weight('extrabold')
                                    ->suffix(' Athletes'),

                                // ক্যালকুলেশন দেখানো হচ্ছে (শেষ নম্বর কত ছিল)
                                TextEntry::make('end_number')
                                    ->label('Ending BIB')
                                    ->fontFamily('mono')
                                    ->getStateUsing(fn ($record) => $record->start_from + ($record->total_generated > 0 ? $record->total_generated - 1 : 0))
                                    ->icon('heroicon-m-arrow-right-circle'),
                            ])
                            ->extraAttributes(['class' => 'mt-4 pt-4 border-t border-gray-100']),
                    ]),

                Section::make('System Logs')
                    ->collapsed() // ডিফল্টভাবে এটি বন্ধ থাকবে
                    ->schema([
                        TextEntry::make('id')
                            ->label('Batch Reference ID')
                            ->prefix('#GEN-'),
                            
                        TextEntry::make('updated_at')
                            ->label('Last Processed')
                            ->since(),
                    ])->columns(2),
            ]);
    }
}
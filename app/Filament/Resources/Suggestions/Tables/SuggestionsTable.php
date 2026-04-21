<?php

namespace App\Filament\Resources\Suggestions\Tables;

// Filament v5 Unified Actions (No 'Tables' namespace as requested)
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;

// Table Columns
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SuggestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Sender Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->label('Mobile')
                    ->icon('heroicon-m-phone')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email Address')
                    ->icon('heroicon-m-envelope')
                    ->searchable(),

                TextColumn::make('message')
                    ->label('Suggestion')
                    ->limit(40) // মেসেজ বড় হলে এখানে কেটে যাবে
                    ->tooltip(fn ($record): string => $record->message), // হোভার করলে পুরোটা দেখা যাবে

                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M, Y h:i A')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                // এডিট ফেলে দিয়ে শুধু ভিউ আর ডিলিট রাখা হয়েছে
                ViewAction::make()
                    ->color('info')
                    ->tooltip('View full suggestion'),
                
                DeleteAction::make()
                    ->tooltip('Remove suggestion'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
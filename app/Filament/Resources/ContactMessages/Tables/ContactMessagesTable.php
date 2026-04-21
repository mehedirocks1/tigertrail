<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->label('Sender')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->icon('heroicon-m-envelope')
                    ->copyable(),

                TextColumn::make('subject')
                    ->label('Subject')
                    ->searchable()
                    ->limit(30),

                TextColumn::make('message')
                    ->label('Message')
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->message),

                IconColumn::make('is_read')
                    ->label('Status')
                    ->boolean()
                    ->sortable()
                    ->trueIcon('heroicon-s-check-circle')
                    ->falseIcon('heroicon-o-exclamation-circle')
                    ->trueColor('success')
                    ->falseColor('warning'),

                TextColumn::make('created_at')
                    ->label('Received At')
                    ->dateTime('d M, Y h:i A')
                    ->sortable()
                    ->toggleable(),

            ])
            ->defaultSort('created_at', 'desc')

            ->actions([
                ActionGroup::make([

                    ViewAction::make()
                        ->label('View')
                        ->icon('heroicon-m-eye')
                        ->color('info')
                        ->modalHeading('Contact Message Details')
                        ->modalWidth('lg')

                        // load data into modal
                        ->fillForm(fn ($record) => [
                            'name' => $record->name,
                            'email' => $record->email,
                            'subject' => $record->subject,
                            'message' => $record->message,
                            'is_read' => $record->is_read,
                        ])

                        // form inside modal
                        ->form([

                            \Filament\Forms\Components\TextInput::make('name')
                                ->label('Sender')
                                ->disabled(),

                            \Filament\Forms\Components\TextInput::make('email')
                                ->label('Email')
                                ->disabled(),

                            \Filament\Forms\Components\TextInput::make('subject')
                                ->label('Subject')
                                ->disabled(),

                            \Filament\Forms\Components\Textarea::make('message')
                                ->label('Message')
                                ->disabled()
                                ->rows(6)
                                ->columnSpanFull(),

                            \Filament\Forms\Components\Toggle::make('is_read')
                                ->label('Mark as Read')
                                ->live()
                                ->afterStateUpdated(function ($state, $record) {
                                    $record->update([
                                        'is_read' => $state,
                                    ]);
                                }),

                        ])

                        // auto mark read when opening
                        ->mountUsing(function ($record) {
                            if (!$record->is_read) {
                                $record->update(['is_read' => true]);
                            }
                        }),

                    DeleteAction::make(),

                ])
                ->icon('heroicon-m-ellipsis-vertical')
                ->color('gray')
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
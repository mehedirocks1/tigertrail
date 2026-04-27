<?php

namespace App\Filament\Resources\EventResults\Pages;

use App\Filament\Resources\EventResults\EventResultResource;
use Filament\Resources\Pages\EditRecord;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;

use Modules\Events\App\Models\EventResult;

class EditEventResult extends EditRecord
{
    protected static string $resource = EventResultResource::class;

    protected function getHeaderActions(): array
    {
        return [

            /**
             * =========================
             * 1. SINGLE EDIT (THIS RECORD)
             * =========================
             */
            Action::make('single_edit')
                ->label('Quick Edit')
                ->icon('heroicon-m-pencil-square')
                ->color('primary')
                ->form([
                    Section::make('Edit Current Result')->schema([

                        TextInput::make('rank')
                            ->numeric()
                            ->required(),

                        TextInput::make('net_time')
                            ->required(),

                        TextInput::make('pace')
                            ->required(),
                    ]),
                ])
                ->fillForm(function () {
                    return $this->record->only(['rank', 'net_time', 'pace']);
                })
                ->action(function (array $data) {
                    $this->record->update($data);

                    $this->notify('success', 'Record updated successfully');
                }),

            /**
             * =========================
             * 2. BULK EDIT (CATEGORY WISE)
             * =========================
             */
            Action::make('bulk_edit')
                ->label('Bulk Edit (Category)')
                ->icon('heroicon-m-users')
                ->color('warning')
                ->form([
                    Section::make('Bulk Update Category')->schema([

                        Select::make('category')
                            ->label('Select Category')
                            ->options(
                                EventResult::query()
                                    ->whereNotNull('category')
                                    ->pluck('category', 'category')
                                    ->toArray()
                            )
                            ->required(),

                        TextInput::make('rank')
                            ->numeric(),

                        TextInput::make('net_time'),

                        TextInput::make('pace'),
                    ]),
                ])
                ->action(function (array $data) {

                    $query = EventResult::query();

                    if (!empty($data['category'])) {
                        $query->where('category', $data['category']);
                    }

                    $updateData = collect($data)
                        ->only(['rank', 'net_time', 'pace'])
                        ->filter(fn ($value) => !is_null($value))
                        ->toArray();

                    $query->update($updateData);

                    $this->notify('success', 'Bulk update completed');
                }),

            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
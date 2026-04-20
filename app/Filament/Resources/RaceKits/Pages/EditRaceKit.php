<?php

namespace App\Filament\Resources\RaceKits\Pages;

use App\Filament\Resources\RaceKits\RaceKitResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRaceKit extends EditRecord
{
    protected static string $resource = RaceKitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

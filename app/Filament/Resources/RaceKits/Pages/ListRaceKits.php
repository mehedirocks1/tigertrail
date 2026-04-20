<?php

namespace App\Filament\Resources\RaceKits\Pages;

use App\Filament\Resources\RaceKits\RaceKitResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRaceKits extends ListRecords
{
    protected static string $resource = RaceKitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

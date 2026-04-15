<?php

namespace App\Filament\Resources\EventResults\Pages;

use App\Filament\Resources\EventResults\EventResultResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEventResult extends ViewRecord
{
    protected static string $resource = EventResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

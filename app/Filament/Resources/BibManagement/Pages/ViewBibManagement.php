<?php

namespace App\Filament\Resources\BibManagement\Pages;

use App\Filament\Resources\BibManagement\BibManagementResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBibManagement extends ViewRecord
{
    protected static string $resource = BibManagementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

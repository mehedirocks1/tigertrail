<?php

namespace App\Filament\Resources\BibManagement\Pages;

use App\Filament\Resources\BibManagement\BibManagementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBibManagement extends ListRecords
{
    protected static string $resource = BibManagementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

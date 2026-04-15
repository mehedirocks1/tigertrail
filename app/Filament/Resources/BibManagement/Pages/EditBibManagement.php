<?php

namespace App\Filament\Resources\BibManagement\Pages;

use App\Filament\Resources\BibManagement\BibManagementResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBibManagement extends EditRecord
{
    protected static string $resource = BibManagementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\BibAssignments\Pages;

use App\Filament\Resources\BibAssignments\BibAssignmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageBibAssignments extends ManageRecords
{
    protected static string $resource = BibAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
<?php

namespace App\Filament\Resources\Attendees\Schemas;
use Modules\Events\App\Models\Attendee;
use Filament\Schemas\Schema;

class AttendeeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }
}

<?php

namespace App\Filament\Resources\EventResults;

// শুধুমাত্র সঠিক মডিউলার মডেলটি ইমপোর্ট করা হলো
use Modules\Events\App\Models\EventResult; 

use App\Filament\Resources\EventResults\Pages\CreateEventResult;
use App\Filament\Resources\EventResults\Pages\EditEventResult;
use App\Filament\Resources\EventResults\Pages\ListEventResults;
use App\Filament\Resources\EventResults\Pages\ViewEventResult;
use App\Filament\Resources\EventResults\Schemas\EventResultForm;
use App\Filament\Resources\EventResults\Schemas\EventResultInfolist;
use App\Filament\Resources\EventResults\Tables\EventResultsTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EventResultResource extends Resource
{
    protected static ?string $model = EventResult::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Result';

    public static function form(Schema $schema): Schema
    {
        return EventResultForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EventResultInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EventResultsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEventResults::route('/'),
            'create' => CreateEventResult::route('/create'),
            'view' => ViewEventResult::route('/{record}'),
            'edit' => EditEventResult::route('/{record}/edit'),
        ];
    }
}
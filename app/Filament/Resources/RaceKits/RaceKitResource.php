<?php

namespace App\Filament\Resources\RaceKits;

use App\Filament\Resources\RaceKits\Pages\CreateRaceKit;
use App\Filament\Resources\RaceKits\Pages\EditRaceKit;
use App\Filament\Resources\RaceKits\Pages\ListRaceKits;
use App\Filament\Resources\RaceKits\Schemas\RaceKitForm;
use App\Filament\Resources\RaceKits\Tables\RaceKitsTable;
use App\Models\RaceKit;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RaceKitResource extends Resource
{
    protected static ?string $model = RaceKit::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'racekit';

    public static function form(Schema $schema): Schema
    {
        return RaceKitForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RaceKitsTable::configure($table);
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
            'index' => ListRaceKits::route('/'),
            'create' => CreateRaceKit::route('/create'),
            'edit' => EditRaceKit::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources\BibManagement;

use App\Filament\Resources\BibManagement\Pages\CreateBibManagement;
use App\Filament\Resources\BibManagement\Pages\EditBibManagement;
use App\Filament\Resources\BibManagement\Pages\ListBibManagement;
use App\Filament\Resources\BibManagement\Pages\ViewBibManagement;
use App\Filament\Resources\BibManagement\Schemas\BibManagementForm;
use App\Filament\Resources\BibManagement\Schemas\BibManagementInfolist;
use App\Filament\Resources\BibManagement\Tables\BibManagementTable;
use Modules\Events\App\Models\BibManagement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BibManagementResource extends Resource
{
    protected static ?string $model = BibManagement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Bib';

    // ✅ $form এর বদলে $schema ব্যবহার করা হলো
    public static function form(Schema $schema): Schema
    {
        // যদি আপনার BibManagementForm ফাইলে configure() মেথড থাকে
        return BibManagementForm::configure($schema); 
    }

    public static function infolist(Schema $schema): Schema
    {
        return BibManagementInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // যদি আপনার BibManagementTable ফাইলে configure() মেথড থাকে
        return BibManagementTable::configure($table);
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
            'index'  => ListBibManagement::route('/'),
            'create' => CreateBibManagement::route('/create'),
            'view'   => ViewBibManagement::route('/{record}'),
            'edit'   => EditBibManagement::route('/{record}/edit'),
        ];
    }
}
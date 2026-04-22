<?php

namespace App\Filament\Resources\BibAssignments;

use App\Filament\Resources\BibAssignments\Pages\ManageBibAssignments;
use Filament\Resources\Resource;
use Filament\Schemas\Schema; // ✅ অবশ্যই Schema ইমপোর্ট করবেন
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Events\App\Models\BibAssignment;
use App\Filament\Resources\BibManagement\Tables\BibManagementTable;
use Filament\Support\Icons\Heroicon;

class BibAssignmentResource extends Resource
{
    protected static ?string $model = BibAssignment::class;

    /**
     * v5.5 এর জন্য নিখুঁত টাইপ হিন্ট (BackedEnum)
     */
    protected static \BackedEnum|string|null $navigationIcon = Heroicon::OutlinedUsers;

    /**
     * v5.5 এর জন্য নিখুঁত টাইপ হিন্ট (UnitEnum)
     */
    protected static \UnitEnum|string|null $navigationGroup = 'Event Management';

    protected static ?string $navigationLabel = 'Attendee BIB List';

    protected static ?string $recordTitleAttribute = 'bib_number';

    /**
     * আপনার এরর মেসেজ অনুযায়ী এখানে অবশ্যই Schema ব্যবহার করতে হবে।
     */
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // এখানে আপনার ফর্ম কম্পোনেন্ট থাকবে
            ]);
    }

   public static function table(Table $table): Table
{
    // ✅ এখানে অবশ্যই configureAssignmentTable কল করবেন
    return BibManagementTable::configureAssignmentTable($table);
}

    public static function getPages(): array
    {
        return [
            'index' => ManageBibAssignments::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
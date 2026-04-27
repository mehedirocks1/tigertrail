<?php

namespace App\Filament\Resources\EventResults\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Actions;
use Filament\Actions\Action;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\FileUpload;

use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

use Modules\Events\App\Models\Event;
use Modules\Events\App\Models\BibAssignment;

class EventResultForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Race Selection & Search')
                ->description('ইভেন্ট এবং ক্যাটাগরি সিলেক্ট করুন। ক্যাটাগরি না থাকলে বা সব দেখতে চাইলে "All Categories" সিলেক্ট করুন।')
                ->schema([

                    Actions::make([
                        Action::make('download_sample')
                            ->label('Download Sample')
                            ->icon('heroicon-m-arrow-down-tray')
                            ->color('gray')
                            ->url(fn () => url('/samples/event_results_sample.xlsx'))
                            ->openUrlInNewTab(),

                        Action::make('import_excel')
                            ->label('Bulk Import & Preview')
                            ->icon('heroicon-m-document-plus')
                            ->color('success')
                            ->form([
                                FileUpload::make('excel_file')
                                    ->label('Upload Result Excel')
                                    ->disk('public')
                                    ->directory('temp-imports')
                                    ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/csv'])
                                    ->required()
                            ])
                            ->action(function (array $data, Set $set, Get $get) {
                                $eventId = $get('event_id');
                                $category = $get('category');

                                if (!$eventId || !$category) {
                                    Notification::make()->title('Warning')->body('Select Event & Category first.')->warning()->send();
                                    return;
                                }

                                $filePath = Storage::disk('public')->path($data['excel_file']);
                                $importData = Excel::toArray([], $filePath)[0];
                                unset($importData[0]); 

                                $currentResults = $get('results') ?? [];

                                foreach ($importData as $row) {
                                    $bibNumber = trim($row[0] ?? '');
                                    if (empty($bibNumber)) continue;

                                    $assignment = BibAssignment::where('event_id', $eventId)
                                        ->when($category !== 'all', fn($q) => $q->where('race_category', $category))
                                        ->where('bib_number', $bibNumber)
                                        ->first();

                                    if ($assignment) {
                                        if (!collect($currentResults)->contains('attendee_id', $assignment->attendee_id)) {
                                            $currentResults[(string) Str::uuid()] = [
                                                'attendee_id'   => $assignment->attendee_id,
                                                'bib_number'    => $assignment->bib_number,
                                                'athlete_name'  => trim($assignment->first_name . ' ' . $assignment->last_name),
                                                'photo_path'    => $assignment->photo_path,
                                                'rank'          => $row[2] ?? null,
                                                'net_time'      => $row[3] ?? null,
                                                'pace'          => $row[4] ?? null,
                                            ];
                                        }
                                    }
                                }

                                $set('results', $currentResults);
                                Storage::disk('public')->delete($data['excel_file']);
                                Notification::make()->title('Import Done')->success()->send();
                            }),
                    ])->columnSpanFull()->alignment('end'),

                    Select::make('event_id')
                        ->relationship('event', 'title')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->live()
                        ->afterStateUpdated(function (Set $set) {
                            $set('category', null);
                            $set('results', []);
                        }),

                    Select::make('category')
                        ->label('Race Category')
                        ->required()
                        ->live()
                        ->afterStateUpdated(fn (Set $set) => $set('results', []))
                        ->options(function (Get $get) {
                            $event = Event::find($get('event_id'));
                            if (!$event) return [];
                            
                            $categories = $event->categories ?? [];
                            
                            return array_merge(
                                ['all' => 'All Categories / No Category'], 
                                array_combine($categories, $categories)
                            );
                        }),

                    Select::make('search_attendee')
                        ->label('Quick Add (Manual)')
                        ->placeholder('Type BIB or Name to add manually...')
                        ->searchable()
                        ->dehydrated(false)
                        ->visible(fn (Get $get) => filled($get('event_id')) && filled($get('category')))
                        ->getSearchResultsUsing(function (string $search, Get $get) {
                            $category = $get('category');
                            $search = trim($search);

                            return BibAssignment::where('event_id', $get('event_id'))
                                ->when($category !== 'all', fn($q) => $q->where('race_category', $category))
                                ->where(fn($q) => $q->where('bib_number', 'like', "%{$search}%")->orWhere('first_name', 'like', "%{$search}%"))
                                ->limit(20)
                                ->get()
                                ->mapWithKeys(fn($a) => [$a->attendee_id => "BIB: {$a->bib_number} - {$a->first_name}"])
                                ->toArray();
                        })
                        ->getOptionLabelUsing(function ($value): ?string {
                            $assignment = BibAssignment::where('attendee_id', $value)->first();
                            return $assignment ? "BIB: {$assignment->bib_number} - {$assignment->first_name}" : null;
                        })
                        ->live()
                        ->afterStateUpdated(function ($state, Set $set, Get $get) {
                            if (!$state) return;
                            $assignment = BibAssignment::where('attendee_id', $state)->first();
                            if (!$assignment) return;

                            $results = $get('results') ?? [];
                            if (collect($results)->contains('attendee_id', $assignment->attendee_id)) {
                                $set('search_attendee', null);
                                return;
                            }

                            $results[(string) Str::uuid()] = [
                                'attendee_id'   => $assignment->attendee_id,
                                'bib_number'    => $assignment->bib_number,
                                'athlete_name'  => $assignment->first_name . ' ' . $assignment->last_name,
                                'photo_path'    => $assignment->photo_path,
                                'rank' => null, 'net_time' => null, 'pace' => null,
                            ];
                            $set('results', $results);
                            $set('search_attendee', null);
                        })
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Result Entries (Preview & Edit)')
                ->schema([
                    Repeater::make('results')
                        ->hiddenLabel()
                        ->addable(false) 
                        ->deletable(true)
                        ->reorderable(false)
                        ->columns(7)
                        ->schema([
                            Hidden::make('attendee_id'),
                            Hidden::make('photo_path'),
                            Placeholder::make('photo')
                                ->label('Photo')
                                ->content(fn (Get $get) => new HtmlString(
                                    $get('photo_path') 
                                        ? '<img src="/storage/'.$get('photo_path').'" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">' 
                                        : '👤'
                                )),
                            TextInput::make('bib_number')->label('BIB')->readonly(),
                            TextInput::make('athlete_name')->label('Name')->readonly()->columnSpan(2),
                            TextInput::make('rank')->numeric()->required(),
                            TextInput::make('net_time')->placeholder('00:00:00')->required(),
                            TextInput::make('pace')->placeholder('4:30')->required(),
                        ]),
                ]),
        ]);
    }
}
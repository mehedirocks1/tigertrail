<?php

namespace App\Filament\Resources\BibManagement\Schemas;

use Closure;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Utilities\Get; 

use Modules\Events\App\Models\Event;
use Modules\Events\App\Models\Attendee;
use Modules\Events\App\Models\BibManagement;

class BibManagementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Generate BIB Range')
                ->description('নির্দিষ্ট ক্যাটাগরির জন্য জেনারেট করতে ক্যাটাগরি সিলেক্ট করুন। আর পুরো ইভেন্টের জন্য একসাথে জেনারেট করতে ক্যাটাগরি ফাঁকা রাখুন।')
                ->schema([
                    Select::make('event_id')
                        ->label('Event')
                        ->relationship('event', 'title')
                        ->required()
                        ->live()
                        ->searchable()
                        ->preload(),

                    Select::make('category')
                        ->label('Category (Optional)')
                        ->live()
                        ->options(function (Get $get) {
                            $event = Event::find($get('event_id'));
                            if (!$event || empty($event->categories)) {
                                return [];
                            }
                            return array_combine($event->categories, $event->categories);
                        })
                        ->helperText('পুরো ইভেন্টের জন্য একসাথে BIB জেনারেট করতে এটি ফাঁকা রাখুন।'),

                    TextInput::make('start_from')
                        ->label('Start BIB')
                        ->numeric()
                        ->default(1001)
                        ->required()
                        // ✅ স্মার্ট ডুপ্লিকেট চেকিং লজিক
                        ->rules([
                            fn (Get $get) => function (string $attribute, $value, Closure $fail) use ($get) {
                                $eventId = $get('event_id');
                                $category = $get('category');

                                if (!$eventId) return;

                                if ($category) {
                                    if (BibManagement::where('event_id', $eventId)->where('category', $category)->exists()) {
                                        $fail('এই ক্যাটাগরির জন্য আগেই BIB জেনারেট করা হয়েছে!');
                                    }
                                    if (BibManagement::where('event_id', $eventId)->whereNull('category')->exists()) {
                                        $fail('এই ইভেন্টে আগেই গ্লোবাল (সব ক্যাটাগরির) BIB জেনারেট করা হয়েছে!');
                                    }
                                } else {
                                    if (BibManagement::where('event_id', $eventId)->exists()) {
                                        $fail('এই ইভেন্টে আগে থেকেই কিছু BIB জেনারেট করা আছে, তাই গ্লোবাল জেনারেশন সম্ভব নয়!');
                                    }
                                }
                            },
                        ]),

                    FileUpload::make('excel_file')
                        ->label('Excel Upload')
                        ->directory('bib-uploads')
                        ->dehydrated(false),

                    Placeholder::make('status')
                        ->content(function (Get $get) {
                            $eventId = $get('event_id');
                            $category = $get('category');

                            if (!$eventId) {
                                return 'Select event to see available attendees.';
                            }

                            // ✅ নতুন কাউন্ট লজিক: সিরিয়াল নাম্বার যাই হোক, চেক করবে BIB অ্যাসাইন হয়েছে কি না
                            $query = Attendee::query()
                                ->where('event_id', $eventId)
                                ->whereIn('payment_status', ['Success', 'success'])
                                ->whereDoesntHave('bibAssignments', function ($q) use ($eventId) {
                                    $q->where('event_id', $eventId);
                                });
                                
                            if ($category) {
                                $query->where('race_category', $category);
                            }

                            $count = $query->count();
                            return "{$count} attendees ready for BIB assignment.";
                        }),
                ])
                ->columns(2),
        ]);
    }
}
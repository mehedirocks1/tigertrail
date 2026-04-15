<?php

namespace Modules\Events\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Modules\Events\App\Models\Event; 
use Modules\Events\App\Models\Attendee;
use Raziul\Sslcommerz\Facades\Sslcommerz;

class EventRegistrationController extends Controller
{
    public function index()
    {
        $baseQuery = Event::query()
            ->where('is_active', true)
            ->where('registration_deadline', '>=', now());

        $featuredEvent = (clone $baseQuery)
            ->where('is_flagship', true)
            ->orderByDesc('event_date')
            ->first();

        $otherEventsQuery = (clone $baseQuery)
            ->where('is_flagship', false);

        if ($featuredEvent) {
            $otherEventsQuery->where('id', '!=', $featuredEvent->id);
        }

        $otherEvents = $otherEventsQuery
            ->orderBy('event_date', 'asc')
            ->get();

        return view('frontend.index', [
            'featuredEvent' => $featuredEvent,
            'otherEvents' => $otherEvents,
        ]);
    }

    public function show()
    {
        $events = Event::where('registration_deadline', '>', now())
                        ->orderBy('event_date', 'asc')
                        ->get();
        
        return view('events::register', compact('events'));
    }

    /**
     * Store registration with Transaction Safety and Strict Eligibility
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date_format:d/m/Y|before_or_equal:' . now()->subYears(7)->format('d/m/Y'),
            'gender' => 'required|in:Male,Female,Other',
            'nationality' => 'nullable|string|max:100',
            'race_category' => 'required|string',
            't_shirt_size' => 'required|string',
            'expected_finish_time' => 'nullable|string',
            'club_or_team' => 'nullable|string',
            'previous_marathons' => 'nullable|integer',
            'blood_group' => 'required|string',
            'medical_conditions' => 'nullable|string',
            'emergency_contact_name' => 'required|string',
            'emergency_contact_phone' => 'required|string',
            'emergency_contact_relation' => 'required|string',
            'address_line' => 'required|string',
            'city' => 'required|string',
            'state_or_district' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'waiver_accepted' => 'accepted',
            'terms_accepted' => 'accepted',
        ], [
            'date_of_birth.date_format' => 'Please enter a valid date in DD/MM/YYYY format.',
            'date_of_birth.before_or_equal' => 'Participants must be at least 7 years old to register.'
        ]);

        try {
            return DB::transaction(function () use ($request, $validated) {
                
                // 1. Fetch Event with Row Lock (Race Condition Prevention)
                $event = Event::where('id', $request->event_id)->lockForUpdate()->firstOrFail();

                // 2. Generate Event-Specific Serial Number
                $latestSerial = Attendee::where('event_id', $event->id)->max('serial_number') ?? 0;
                $validated['serial_number'] = $latestSerial + 1;

                // 3. Verify Eligibility based on Event Date
                $dob = Carbon::createFromFormat('d/m/Y', $request->date_of_birth);
                $age = $dob->diffInYears(Carbon::parse($event->event_date));

                if ($age >= 7 && $age <= 10) {
                    if (!$event->allow_infants) throw new \Exception("Infant category (7-10) is not allowed for this event.");
                    $validated['age_category'] = '7-10 Infant';
                } elseif ($age > 10 && $age <= 14) {
                    if (!$event->allow_kids) throw new \Exception("Kids category (11-14) is not allowed for this event.");
                    $validated['age_category'] = '10-14 Kid';
                } else {
                    if (!$event->allow_adults) throw new \Exception("Adult category is not allowed for this event.");
                    $validated['age_category'] = 'Adult Runner';
                }

                // 4. Handle Image Upload
                if ($request->hasFile('photo')) {
                    $path = $request->file('photo')->store('attendee-photos', 'public');
                    $validated['photo_path'] = $path;
                }
                unset($validated['photo']);

                // 5. Prepare Final Data
                $transactionId = 'TRUN_' . strtoupper(uniqid());
                $validated['date_of_birth'] = $dob->format('Y-m-d'); // Standardize for DB
                $validated['registration_fee'] = $event->base_registration_fee ?? 1000;
                $validated['transaction_id'] = $transactionId;
                $validated['payment_status'] = 'Pending';
                $validated['waiver_accepted'] = true;
                $validated['terms_accepted'] = true;

                // 6. Record the Attendee (serial_number is now included in $validated)
                $attendee = Attendee::create($validated);

                // 7. Initiate SSL Commerz
                $response = Sslcommerz::setOrder(
                    $validated['registration_fee'],
                    $transactionId,
                    $event->title . ' - ' . $request->race_category
                )
                ->setCustomer(
                    $request->first_name . ' ' . $request->last_name,
                    $request->email,
                    $request->phone
                )
                ->makePayment();

                if (!$response->success()) {
                    // Manual Exception triggers DB rollback and deletion of uploaded photo
                    if (isset($validated['photo_path'])) Storage::disk('public')->delete($validated['photo_path']);
                    throw new \Exception("Could not initialize payment gateway. Please try again.");
                }

                // 8. Return response based on request type
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'status' => 'success',
                        'GatewayPageURL' => $response->gatewayPageURL()
                    ]);
                }

                return redirect($response->gatewayPageURL());
            });

        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 422);
            }

            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
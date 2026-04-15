<?php

namespace Modules\Events\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Events\App\Models\Attendee;
use Raziul\Sslcommerz\Facades\Sslcommerz;
use DevWizard\Textify\Facades\Textify; // Import Textify

class SslcommerzController extends Controller
{
    public function success(Request $request)
    {
        $isValid = Sslcommerz::validatePayment($request->all(), $request->tran_id, $request->amount);

        if ($isValid) {
            $attendee = Attendee::where('transaction_id', $request->tran_id)->first();
            
            if ($attendee) {
                // Only send SMS and update if not already marked as Success (prevents double SMS)
                if ($attendee->payment_status !== 'Success') {
                    $attendee->update(['payment_status' => 'Success']);
                    $this->sendRegistrationSms($attendee);
                }

                return redirect()->route('events.register.form')
                    ->with('success', 'Payment successful! Your registration for Tiger Trail is confirmed.');
            }
        }

        return redirect()->route('events.register.form')->withErrors(['error' => 'Invalid payment signature.']);
    }

    public function failure(Request $request)
    {
        $attendee = Attendee::where('transaction_id', $request->tran_id)->first();
        if ($attendee) {
            $attendee->update(['payment_status' => 'Failed']);
        }
        return redirect()->route('events.register.form')->withErrors(['error' => 'Payment failed. Please try again.']);
    }

    public function cancel(Request $request)
    {
        return redirect()->route('events.register.form')->withErrors(['error' => 'Payment cancelled.']);
    }

    public function ipn(Request $request)
    {
        // IPN is critical for background updates
        $isValid = Sslcommerz::validatePayment($request->all(), $request->tran_id, $request->amount);
        
        if ($isValid) {
            $attendee = Attendee::where('transaction_id', $request->tran_id)->first();
            
            if ($attendee && $attendee->payment_status !== 'Success') {
                $attendee->update(['payment_status' => 'Success']);
                $this->sendRegistrationSms($attendee);
            }
        }
    }

    /**
     * Private helper to handle the Textify SMS logic
     */
    private function sendRegistrationSms($attendee)
    {
        try {
            $message = "Congratulations {$attendee->first_name}! Your payment for Tiger Trail is successful. Your Registration ID: #{$attendee->serial_number}. See you on race day!";
            
            Textify::to($attendee->phone)
                ->message($message)
                ->send();

        } catch (\Exception $e) {
            // Log the error so the user's web experience isn't broken if the SMS fails
            Log::error("SMS Sending Failed for Attendee #{$attendee->id}: " . $e->getMessage());
        }
    }
}
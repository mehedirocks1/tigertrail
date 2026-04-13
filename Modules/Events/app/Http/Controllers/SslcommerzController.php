<?php

namespace Modules\Events\App\Http\Controllers; // <-- 1. Updated Namespace

use App\Http\Controllers\Controller; // <-- 2. Must import the base controller
use Illuminate\Http\Request;
use Modules\Events\App\Models\Attendee;
use Raziul\Sslcommerz\Facades\Sslcommerz;

class SslcommerzController extends Controller
{
    public function success(Request $request)
    {
        $isValid = Sslcommerz::validatePayment($request->all(), $request->tran_id, $request->amount);

        if ($isValid) {
            $attendee = Attendee::where('transaction_id', $request->tran_id)->first();
            
            if ($attendee) {
                $attendee->update(['payment_status' => 'Success']);
                return redirect()->route('events.register.form')->with('success', 'Payment successful! Your registration is confirmed.');
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
        $isValid = Sslcommerz::validatePayment($request->all(), $request->tran_id, $request->amount);
        if ($isValid) {
            Attendee::where('transaction_id', $request->tran_id)->update(['payment_status' => 'Success']);
        }
    }
}
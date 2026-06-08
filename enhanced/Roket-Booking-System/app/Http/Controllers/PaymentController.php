<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    private array $allowedPaymentMethods = [
        'Maybank2u',
        'CIMB Click',
        'RHB Now',
        'Bank Islam',
        'Bank Rakyat',
    ];

    private array $allowedSlots = [
        '12:00 - 13:00',
        '13:00 - 14:00',
        '01:00 - 02:00',
        '02:00 - 03:00',
    ];

    public function showPaymentPage(Request $request)
    {
        $validated = $request->validate([
            'court' => ['required', 'integer', 'between:1,5'],
            'timeslots' => [
                'required',
                'string',
                'max:100',
                'not_regex:/<[^>]*>/i',
            ],
        ]);

        $timeslotArray = array_filter(array_map('trim', explode(',', $validated['timeslots'])));

        foreach ($timeslotArray as $slot) {
            if (! in_array($slot, $this->allowedSlots, true)) {
                return redirect()->route('badminton')->withErrors([
                    'timeslots' => 'Invalid timeslot selected.',
                ]);
            }
        }

        $courtName = 'Court ' . $validated['court'];
        $timeslots = implode(',', $timeslotArray);
        $totalAmount = count($timeslotArray) * 12;

        return view('payment', [
            'courtNumber' => $validated['court'],
            'courtName' => e($courtName),
            'timeslots' => e($timeslots),
            'timeslotArray' => $timeslotArray,
            'totalAmount' => $totalAmount,
        ]);
    }

    public function processPayment(Request $request)
    {
        $validated = $request->validate([
            'court' => ['required', 'integer', 'between:1,5'],
            'timeslots' => [
                'required',
                'string',
                'max:100',
                'not_regex:/<[^>]*>/i',
            ],
            'payment_method' => ['required', 'string', Rule::in($this->allowedPaymentMethods)],
        ]);

        $timeslotArray = array_filter(array_map('trim', explode(',', $validated['timeslots'])));

        foreach ($timeslotArray as $slot) {
            if (! in_array($slot, $this->allowedSlots, true)) {
                return back()->withErrors([
                    'timeslots' => 'Invalid timeslot selected.',
                ])->withInput();
            }
        }

        session([
            'last_booking' => [
                'court' => 'Court ' . $validated['court'],
                'timeslots' => $timeslotArray,
                'payment_method' => $validated['payment_method'],
                'total' => count($timeslotArray) * 12,
            ],
        ]);

        return redirect()->route('payment.success')->with('message', 'Payment successful! Booking confirmed.');
    }

    public function paymentSuccess()
    {
        return view('payment-success');
    }
}

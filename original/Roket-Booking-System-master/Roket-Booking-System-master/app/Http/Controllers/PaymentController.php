<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show the payment page with the court name and timeslots.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function showPaymentPage(Request $request)
    {
        // Get the court name and timeslots from the query parameters or fallback to default
        $courtName = $request->input('court', 'Court Name'); // Default 'Court Name' if not provided
        $timeslots = $request->input('timeslots', ''); // Default empty string if not provided

        // Pass the data to the payment.blade.php view
        return view('payment', compact('courtName', 'timeslots'));
    }

    /**
     * Process the payment (optional: based on the payment method selected).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processPayment(Request $request)
    {
        // Retrieve the selected payment method and other necessary data
        $paymentMethod = $request->input('payment_method');
        $courtName = $request->input('court');
        $timeslots = $request->input('timeslots');
        
        // You can add payment processing logic here (e.g., interacting with a payment gateway)

        // Example: Simulating a successful payment process
        if ($paymentMethod) {
            // Payment successful (for demo purposes)
            return redirect()->route('payment.success')->with('message', 'Payment successful!');
        } else {
            // Payment failed, redirect back with an error
            return back()->with('error', 'Please select a valid payment method.');
        }
    }

    /**
     * Show a success message after payment is processed.
     *
     * @return \Illuminate\View\View
     */
    public function paymentSuccess()
    {
        return view('payment-success'); // Create a view to show a success message
    }
}

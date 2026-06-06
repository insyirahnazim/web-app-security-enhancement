<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourtController extends Controller
{
    /**
     * Show the booking form for a specific court and day.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function showBookingForm(Request $request)
{
    $day = $request->query('day', 'Unknown Day'); // Default to 'Unknown Day' if not provided
    $court = $request->query('court', 'Unknown Court'); // Default to 'Unknown Court' if not provided

    // Prepend "Court" to the court number if it's numeric
    $courtName = is_numeric($court) ? 'Court ' . $court : $court;

    // Example time slots (replace with database data if needed)
    $timeSlots = [
        ['time' => '07:00 - 08:00', 'status' => 'Occupied'],
        ['time' => '08:00 - 09:00', 'status' => 'Occupied'],
        ['time' => '09:00 - 10:00', 'status' => 'Available'],
        ['time' => '10:00 - 11:00', 'status' => 'Occupied'],
        ['time' => '11:00 - 12:00', 'status' => 'Available'],
    ];

    // Pass all variables to the view
    return view('court', [
        'day' => $day,
        'courtName' => $courtName,
        'timeSlots' => $timeSlots,
    ]);
}

}

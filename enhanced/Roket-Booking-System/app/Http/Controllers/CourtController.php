<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourtController extends Controller
{
    private array $allowedDays = [
        'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday',
    ];

    private array $allowedSlots = [
        '12:00 - 13:00',
        '13:00 - 14:00',
        '01:00 - 02:00',
        '02:00 - 03:00',
    ];

    public function showBookingForm(Request $request)
    {
        $validated = $request->validate([
            'day' => ['required', 'string', Rule::in($this->allowedDays)],
            'court' => ['required', 'integer', 'between:1,5'],
        ]);

        $courtName = 'Court ' . $validated['court'];

        $timeSlots = [
            ['time' => '07:00 - 08:00', 'status' => 'Occupied'],
            ['time' => '08:00 - 09:00', 'status' => 'Occupied'],
            ['time' => '09:00 - 10:00', 'status' => 'Occupied'],
            ['time' => '10:00 - 11:00', 'status' => 'Occupied'],
            ['time' => '11:00 - 12:00', 'status' => 'Occupied'],
            ['time' => '12:00 - 13:00', 'status' => 'Available'],
            ['time' => '13:00 - 14:00', 'status' => 'Available'],
            ['time' => '14:00 - 15:00', 'status' => 'Occupied'],
            ['time' => '15:00 - 16:00', 'status' => 'Occupied'],
            ['time' => '16:00 - 17:00', 'status' => 'Occupied'],
            ['time' => '17:00 - 18:00', 'status' => 'Occupied'],
            ['time' => '18:00 - 19:00', 'status' => 'Occupied'],
            ['time' => '19:00 - 20:00', 'status' => 'Occupied'],
            ['time' => '20:00 - 21:00', 'status' => 'Occupied'],
            ['time' => '21:00 - 22:00', 'status' => 'Occupied'],
            ['time' => '22:00 - 23:00', 'status' => 'Occupied'],
            ['time' => '23:00 - 00:00', 'status' => 'Occupied'],
            ['time' => '01:00 - 02:00', 'status' => 'Available'],
            ['time' => '02:00 - 03:00', 'status' => 'Available'],
        ];

        return view('court', [
            'day' => e($validated['day']),
            'courtNumber' => $validated['court'],
            'courtName' => e($courtName),
            'timeSlots' => $timeSlots,
        ]);
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'q' => ['nullable', 'string', 'max:50'],
        ]);

        return redirect()->route('badminton')->with('search', e($validated['q'] ?? ''));
    }

    public function show(string $day, string $court)
    {
        request()->merge([
            'day' => $day,
            'court' => $court,
        ]);

        return $this->showBookingForm(request());
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function checkIn()
    {
        $attendance = Attendance::create([
            'user_id' => auth()->id(),
            'date' => now()->toDateString(),
            'check_in' => now()->toTimeString(),
            'status' => now()->hour > 9 ? 'late' : 'present',
            'notes' => null
        ]);

        return back()->with('success', 'Check in recorded successfully');
    }

    public function checkOut()
    {
        $attendance = Attendance::where('user_id', auth()->id())
            ->where('date', now()->toDateString())
            ->first();

        if ($attendance) {
            $attendance->update([
                'check_out' => now()->toTimeString()
            ]);

            return back()->with('success', 'Check out recorded successfully');
        }

        return back()->with('error', 'No check-in record found for today');
    }
}

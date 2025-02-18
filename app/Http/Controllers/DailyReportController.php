<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'activity' => 'required|string'
        ]);

        DailyReport::create([
            'user_id' => auth()->id(),
            'date' => now()->toDateString(),
            'activity' => $request->activity
        ]);

        return back()->with('success', 'Daily report submitted successfully');
    }
}
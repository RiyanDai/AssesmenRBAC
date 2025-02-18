<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\DailyReport;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $todayAttendance = null;
        $todayReport = null;

        if ($user->role->name === 'User') {
            $todayAttendance = Attendance::where('user_id', $user->id)
                ->where('date', now()->toDateString())
                ->first();
                
            $todayReport = DailyReport::where('user_id', $user->id)
                ->where('date', now()->toDateString())
                ->first();
        }

        return view('dashboard', compact('todayAttendance', 'todayReport'));
    }
}

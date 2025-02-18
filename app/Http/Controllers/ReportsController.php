<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Attendance;
use App\Models\DailyReport;

class ReportsController extends Controller
{
    public function index()
    {
        if (auth()->user()->role->name === 'Admin') {
            // Admin bisa lihat semua data
            $users = User::with(['role', 'manager'])->get();
            $attendances = Attendance::with('user')->latest()->get();
            $reports = DailyReport::with('user')->latest()->get();
        } else if (auth()->user()->role->name === 'Manager') {
            // Manager hanya bisa lihat data user dibawahnya
            $userIds = User::where('manager_id', auth()->id())->pluck('id');
            $users = User::whereIn('id', $userIds)->with(['role', 'manager'])->get();
            $attendances = Attendance::whereIn('user_id', $userIds)->with('user')->latest()->get();
            $reports = DailyReport::whereIn('user_id', $userIds)->with('user')->latest()->get();
        } else {
            abort(403, 'Unauthorized action.');
        }

        return view('reports', compact('users', 'attendances', 'reports'));
    }

    // Tambahkan method untuk filter berdasarkan tanggal jika diperlukan
    public function filter(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        
        if (auth()->user()->role->name === 'Admin') {
            $users = User::with(['role', 'manager'])->get();
            $attendances = Attendance::with('user')
                ->whereBetween('date', [$startDate, $endDate])
                ->latest()
                ->get();
            $reports = DailyReport::with('user')
                ->whereBetween('date', [$startDate, $endDate])
                ->latest()
                ->get();
        } else {
            $userIds = User::where('manager_id', auth()->id())->pluck('id');
            $users = User::whereIn('id', $userIds)->with(['role', 'manager'])->get();
            $attendances = Attendance::whereIn('user_id', $userIds)
                ->whereBetween('date', [$startDate, $endDate])
                ->with('user')
                ->latest()
                ->get();
            $reports = DailyReport::whereIn('user_id', $userIds)
                ->whereBetween('date', [$startDate, $endDate])
                ->with('user')
                ->latest()
                ->get();
        }

        return view('reports', compact('users', 'attendances', 'reports'));
    }
}
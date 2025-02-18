<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function update(Request $request)
    {
        $settings = Setting::first() ?? new Setting();
        
        $settings->site_name = $request->site_name;
        $settings->dark_mode = $request->has('dark_mode');
        $settings->email_notifications = $request->has('email_notifications');
        
        $settings->save();

        return redirect()->route('settings')->with('status', 'Settings updated successfully!');
    }
}
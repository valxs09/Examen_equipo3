<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ClockController extends Controller
{
    public function getTime(Request $request)
    {
        $timezone = $request->input('timezone', 'UTC');
        $city = $request->input('city', 'Unknown City');

        try {
            $current_time = Carbon::now($timezone)->format('H:i:s');
            return response()->json([
                'city' => $city,
                'time' => $current_time,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid timezone'], 400);
        }
    }
}

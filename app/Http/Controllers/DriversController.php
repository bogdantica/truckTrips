<?php

namespace App\Http\Controllers;

use App\Models\Trip;

class DriversController extends Controller
{
    public function dashboard()
    {
        $driver = \Auth::user();

        $trip = Trip::where('driver_user_id', $driver->id)
            ->orderBy('created_at', 'DESC')
            ->with('basicPoints.place')
            ->with('truck')
            ->with('sender')
            ->with('receiver')
            ->first();

        if ($trip->basicPoints->last()->departed_at) {
            $trip = null;
        }

        return view('driver.dashboard', compact('trip'));
    }
}

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
            ->with('startPoint.place')
            ->with('endPoint.place')
            ->with('truck')
            ->with('sender')
            ->with('receiver')
            ->first();

        if ($trip && $trip->endPoint->departed_at) {
            $trip = null;
        }

        return view('driver.dashboard', compact('trip'));
    }
}

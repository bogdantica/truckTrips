<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DriversController extends Controller
{

    public function drivers()
    {
        $drivers = User::get();

        return view('driver.drivers', compact('drivers'));
    }
    
    public function new()
    {
        $user = new User();
        return view('driver.driver', compact('user'));
    }

    public function storeNew(Request $req)
    {
        $this->validate($req, [
            'name' => 'required',
            'email' => 'email|nullable',
            'phone' => 'numeric|nullable'
        ]);

        $user = User::create($req->all(['name', 'email', 'phone']));
        $user->isNew = true;
        if ($req->ajax()) {
            return new JsonResponse($user);
        }

        return redirect('users');
    }


//    public function dashboard()
//    {
//        $driver = \Auth::user();
//
//        $trip = Trip::where('driver_user_id', $driver->id)
//            ->orderBy('created_at', 'DESC')
//            ->with('startPoint.place')
//            ->with('endPoint.place')
//            ->with('truck')
//            ->with('sender')
//            ->with('receiver')
//            ->first();
//
//        if ($trip && $trip->endPoint->departed_at) {
//            $trip = null;
//        }
//
//        return view('driver.dashboard', compact('trip'));
//    }
}

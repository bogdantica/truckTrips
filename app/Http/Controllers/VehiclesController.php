<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{

    public function vehicles()
    {
        $vehicles = Vehicle::get();

        return view('vehicles.vehicles', compact('vehicles'));
    }

    public function new()
    {
        $vehicle = new Vehicle();
        $types = VehicleType::pluck('name', 'id');

        return view('vehicles.vehicle', compact('vehicle', 'types'));
    }

    public function storeNew(Request $req)
    {
        $this->validate($req, [
            'registration' => 'required|string',
            'name' => 'string|nullable',
            'vin' => 'string|nullable',
            'vehicle_type_id' => 'required',
            'max_weight' => 'numeric'
        ]);

        $reg = $req->registration;

        $reg = strtoupper(str_replace(' ', '', $reg));

        $req->merge(['registration' => $reg]);

        $vehicle = Vehicle::create($req->all(['registration', 'name', 'vin', 'vehicle_type_id', 'max_weight']));
        $vehicle->isNew = true;

        \Auth::user()->company->vehicles()->attach($vehicle);

        if ($req->ajax()) {
            return new JsonResponse($vehicle);
        }

        return redirect('vehicles');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Models\Company;
use App\Models\EventType;
use App\Models\Place;
use App\Models\Trip;
use App\Models\Truck;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TripsController extends Controller
{
    public function new()
    {

        $companies = Company::pluck('name', 'id');
        $trucks = Truck::pluck('registration', 'id');

        $drivers = User::pluck('name', 'id');

        $driver = \Auth::user()->id;

        return view('trips.trip', compact('companies', 'trucks', 'drivers', 'driver'));
    }

    public function start(TripRequest $request)
    {
        $sender = Company::parseRequest($request->sender_company_id);

        $receiver = Company::parseRequest($request->receiver_company_id);

        $truck = Truck::parseRequest($request->truck_id);

        $newTripData = [
            'sender_company_id' => $sender->id,
            'receiver_company_id' => $receiver->id,
            'truck_id' => $truck->id,
            'driver_user_id' => $request->driver_user_id,
            'pay_distance' => $request->pay_distance,
            'real_distance' => $request->real_distance,
            'load_weight' => $request->load_weight,
            'load_volume' => $request->load_volume,
            'event_type_id' => EventType::TRIP,
        ];

        \DB::transaction(function () use ($newTripData, $request) {
            $newTrip = Trip::create($newTripData);

            $points = $request->basic_points;

            //todo add valdidation to pointTypeId

            foreach ($points as $pointTypeId => $point) {
                $point = (object)$point;

                if (!isset($point->place_id)) {
                    continue;
                }

                $place = Place::parseRequest($point->place_id);

                $departedAt = null;
                if (isset($point->departed_at)) {
                    $departedAt = Carbon::createFromFormat("d/m/Y H:i", $point->departed_at);
                }

                $newTrip->basicPoints()->create([
                    'point_type_id' => $pointTypeId,
                    'place_id' => $place->id,
                    'description' => $point->description ?? null,
                    'departed_at' => $departedAt ?? null,//todo parse this with carbon,
                    'latitude' => $point->latitude ?? null,
                    'longitude' => $point->longitude ?? null,
                ]);

            }

        });


        return new JsonResponse([
            'redirect' => route('driver')
        ]);

    }

    public function end(Trip $trip, Request $request)
    {
        if ($request->has('endTrip') && $request->endTrip == true) {
            $trip->load('basicPoints');

            $trip->basicPoints->last()->departed_at = Carbon::now();
            $trip->basicPoints->last()->save();
        }

        return redirect()->back();
    }


}

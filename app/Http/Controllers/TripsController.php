<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Models\Company;
use App\Models\EventType;
use App\Models\PayMethod;
use App\Models\Place;
use App\Models\PointType;
use App\Models\Trip;
use App\Models\Truck;
use App\Models\Vat;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TripsController extends Controller
{
    public function trips()
    {

        $query = Trip::with([
            'startPoint',
            'payMethod',
            'endPoint',
            'points',
            'driver',
            'sender',
            'receiver'
        ]);

        $trips = $query->get();

        return view('trips.trips', compact('trips'));
    }
    
    
    public function new()
    {
        $company = Company::first();

        $companies = Company::pluck('name', 'id');

        $drivers = $company->drivers()->pluck('name', 'id');

        $vehicles = $company->vehicles()->pluck('registration', 'id');

        $payMethod = PayMethod::pluck('name', 'id');
        $vats = Vat::pluck('name', 'id');

        $trip = new Trip();

        return view('trips.trip', compact(
                'company',
                'companies',
                'drivers',
                'vehicles',
                'payMethod',
                'vats',
                'trip'
            )
        );
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

            $start = (object)$request->start_point;

            $startId = Place::parseRequest($start->place_id)->id;

            $newTrip->startPoint()->create([
                'point_type_id' => PointType::START,
                'place_id' => $startId,
                'current_kilometers' => $start->current_kilometers,
                'description' => $start->description ?? null,
                'departed_at' => Carbon::createFromFormat("d/m/Y H:i", $start->departed_at),//todo parse this with carbon,
                'latitude' => $start->latitude ?? null,
                'longitude' => $start->longitude ?? null,
            ]);

            $end = (object)$request->end_point;

            $endId = Place::parseRequest($end->place_id)->id;

            $newTrip->endPoint()->create([
                'point_type_id' => PointType::END,
                'place_id' => $endId,
                'description' => $end->description ?? null,
                'current_kilometers' => $end->current_kilometers ?? null,
                'departed_at' => isset($end->departed_at) ? Carbon::createFromFormat("d/m/Y H:i", $end->departed_at) : null,//todo parse this with carbon,
                'latitude' => $end->latitude ?? null,
                'longitude' => $end->longitude ?? null,
            ]);


        });

        return new JsonResponse([
            'redirect' => route('driver')
        ]);

    }

    public function end(Trip $trip, Request $request)
    {
        $this->validate($request, [
            'end_point.endLatitude' => 'numeric|nullable',
            'end_point.endLongitude' => 'numeric|nullable',

            'end_point.current_kilometers' => 'required|numeric',
            'end_point.departed_at' => 'required|date_format:d/m/Y H:i'
        ], [
            'end_point.current_kilometers.required' => 'Kilometrii la sosire sunt necesari',
            'end_point.current_kilometers.numeric' => 'Campul este numeric',
            'end_point.departed_at.date_format' => 'Data trebuie sa fie de forma: zi/luna/an ora:minut, Ex: 24/09/2015 10:12',
            'end_point.departed_at.required' => 'Data sosirii este necesara'
        ]);

        $trip->load('endPoint');

        $end = (object)$request->end_point;

        $trip->endPoint->fill([
            'description' => $end->description ?? null,
            'current_kilometers' => $end->current_kilometers,
            'departed_at' => Carbon::createFromFormat("d/m/Y H:i", $end->departed_at),
            'latitude' => $end->latitude ?? null,
            'longitude' => $end->longitude ?? null,
        ])
            ->save();


        return new JsonResponse([
            'redirect' => route('driver')
        ]);

    }


}

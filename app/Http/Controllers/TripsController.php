<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Models\Company;
use App\Models\PayMethod;
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

//        $trip = $trip->with('services')->first();

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

    public function storeNew(TripRequest $req)
    {
//        dd($req->all());
        
        \DB::transaction(function () use ($req) {


            $req->merge([
                'agreement_date' => Carbon::createFromFormat('d/m/Y', $req->agreement_date)
            ]);

            $trip = Trip::create($req->only([
                'transporter_company_id',
                'beneficiary_company_id',
                'driver_user_id',
                'agreement',
                'agreement_date',
            ]));


            $point = (object)$req->startPoint;
            $add = (object)$point->address;

            $date = empty($point->schedule_date) ? null : Carbon::createFromFormat('d/m/Y', $point->schedule_date);
            $time = empty($point->schedule_time) ? null : Carbon::createFromFormat('H:i', $point->schedule_time);


            $trip->startPoint()->create(
                [
                    'point_type_id' => PointType::START,
                    'address_street' => $add->street ?? null,
                    'address_number' => $add->number ?? null,
                    'address_locality' => $add->locality ?? null,
                    'address_county' => $add->county ?? null,
                    'address_country' => $add->country ?? null,
                    'schedule_date' => $date,
                    'schedule_time' => $time,
                    'cargo_weight' => $point->cargo_weight ?? null,
                    'cargo_volume' => $point->cargo_volume ?? null,
                    'details' => $point->details ?? null,
                ]);

            $point = (object)$req->endPoint;
            $add = (object)$point->address;


            $date = empty($point->schedule_date) ? null : Carbon::createFromFormat('d/m/Y', $point->schedule_date);
            $time = empty($point->schedule_time) ? null : Carbon::createFromFormat('H:i', $point->schedule_time);

            $trip->endPoint()->create([
                'point_type_id' => PointType::END,
                'address_street' => $add->street ?? null,
                'address_number' => $add->number ?? null,
                'address_locality' => $add->locality ?? null,
                'address_county' => $add->county ?? null,
                'address_country' => $add->country ?? null,
                'schedule_date' => $date,
                'schedule_time' => $time,
                'cargo_weight' => $point->cargo_weight ?? null,
                'cargo_volume' => $point->cargo_volume ?? null,
                'details' => $point->details ?? null,
            ]);

            foreach ($req->point['new'] ?? [] as $point) {

                $point = (object)$point;
                $add = (object)$point->address;
                $date = empty($point->schedule_date) ? null : Carbon::createFromFormat('d/m/Y', $point->schedule_date);
                $time = empty($point->schedule_time) ? null : Carbon::createFromFormat('H:i', $point->schedule_time);

                $trip->points()->create([
                    'point_type_id' => PointType::INTER,
                    'address_street' => $add->street ?? null,
                    'address_number' => $add->number ?? null,
                    'address_locality' => $add->locality ?? null,
                    'address_county' => $add->county ?? null,
                    'address_country' => $add->country ?? null,
                    'schedule_date' => $date,
                    'schedule_time' => $time,
                    'cargo_weight' => $point->cargo_weight ?? null,
                    'cargo_volume' => $point->cargo_volume ?? null,
                    'details' => $point->details ?? null,
                ]);
            }

            $totalCost = 0;
            foreach ($req->services['new'] as $service) {
                $serv = (object)$service;

                $trip->services()->create([
                    'name' => $serv->name,
                    'quantity' => $serv->quantity,
                    'price' => $serv->price,
                    'total' => $serv->quantity * $serv->price,
                ]);
                $totalCost += $serv->quantity * $serv->price;
            }


            $trip->total_price = $totalCost;
            $trip->save();

//            dd($trip->toArray());

        });

        return new JsonResponse([
            'redirect' => route('driver')
        ]);

    }

    public function edit(Request $req, Trip $trip)
    {
        dd($trip->toArray(), $req->all());
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

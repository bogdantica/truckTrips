<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Models\Company;
use App\Models\PayMethod;
use App\Models\PointType;
use App\Models\Trip;
use App\Models\Vat;
use App\Sessions\Customer\Customer;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TripsController extends Controller
{
    public function trips()
    {

        $query = Trip::with([
            'beneficiary',
            'transporter',
            'startPoint',
            'endPoint',
            'points',
            'driver',
            'services',
            'payMethod',
        ]);

        $trips = $query->get();

        return view('trips.trips', compact('trips'));
    }

    public function new()
    {
        $company = Company::byCurrentCustomer();

        $companies = Company::where('id', $company->id)->pluck('name', 'id');

        $drivers = $company->drivers()->pluck('name', 'id');

        $vehicles = $company->vehicles()->pluck('registration', 'id');

        $payMethods = PayMethod::pluck('name', 'id');

        $vats = Vat::pluck('name', 'id');

        $trip = new Trip();

        return view('trips.trip', compact(
                'company',
                'companies',
                'drivers',
                'vehicles',
                'payMethods',
                'vats',
                'trip'
            )
        );
    }

    public function storeNew(TripRequest $req, Customer $customer)
    {
        \DB::transaction(function () use ($req, $customer) {

            $req->merge([
                'agreement_date' => Carbon::createFromFormat('d/m/Y', $req->agreement_date),
                'pay_date' => Carbon::createFromFormat('d/m/Y', $req->pay_date)
            ]);

            $req->merge([
                'transport_company_id' => $customer->get('company')->id
            ]);

            $trip = Trip::create($req->only([
                'transporter_company_id',
                'beneficiary_company_id',
                'transporter_company_id',
                'driver_user_id',
                'agreement',
                'agreement_date',
                'pay_method_id',
                'pay_date',
                'pay_details'
            ]));

            $trip->vehicles()->sync(
                $req->vehicles
            );

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
            foreach ($req->services['new'] ?? [] as $service) {
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
        });

        return new JsonResponse([
            'redirect' => back()
        ]);

    }

    public function edit(Trip $trip)
    {
        $trip->load([
            'startPoint',
            'endPoint',
            'points',
            'services',
//            'vehicles'
        ]);

        $trip->startPoint->schedule_time = $trip->startPoint->schedule_time ? Carbon::parse($trip->startPoint->schedule_time) : null;
        $trip->endPoint->schedule_time = $trip->endPoint->schedule_time ? Carbon::parse($trip->endPoint->schedule_time) : null;

        $trip->points->each(function (&$point) {
            $point->schedule_time = $point->schedule_time ? Carbon::parse($point->schedule_time) : null;
        });

        $company = Company::first();

        $companies = Company::pluck('name', 'id');

        $drivers = $company->drivers()->pluck('name', 'id');

        $vehicles = $company->vehicles()->pluck('registration', 'id');

        $payMethods = PayMethod::pluck('name', 'id');

        $vats = Vat::pluck('name', 'id');

//        dd($trip->toArray());

        return view('trips.trip', compact(
                'company',
                'companies',
                'drivers',
                'vehicles',
                'payMethods',
                'vats',
                'trip'
            )
        );

    }

    public function editStore(Request $req, Trip $trip)
    {
        //validate and update removed interPoints and services !!
//        todo
    }

    protected function view(Trip $trip, $pdf = false)
    {
        $trip->fullLoad();

//        debug($trip->toArray());

        return view('trips.view.view', compact('trip', 'pdf'));
    }

}

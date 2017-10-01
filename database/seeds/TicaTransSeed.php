<?php

use Illuminate\Database\Seeder;

class TicaTransSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = \App\Models\User::create([
            'name' => 'Driver 1',
            'password' => bcrypt(time() * rand(0, 1000) . str_random(19)),
            'email' => str_random(10) . '@email.com'
        ]);

        $place = \App\Models\Place::create([
            'name' => 'Bucharest'
        ]);
        $place2 = \App\Models\Place::create([
            'name' => 'Ploiesti'
        ]);

        $company1 = \App\Models\Company::create([
            'name' => 'Company 1'
        ]);
        $company2 = \App\Models\Company::create([
            'name' => 'Company 2'
        ]);

        $veh = \App\Models\Vehicle::create([
            'registration' => 'TR67TYK'
        ]);
        $trailer = \App\Models\Vehicle::create([
            'registration' => 'TR68TYK'
        ]);

        \App\Models\Company::first()->drivers()->attach(\App\Models\User::first());
        \App\Models\Company::first()->vehicles()->attach(\App\Models\Vehicle::first());
        \App\Models\Company::first()->vehicles()->attach(\App\Models\Vehicle::get()->last());

        $trip = \App\Models\Trip::create([
            'transporter_company_id' => $company1->id,
            'beneficiary_company_id' => $company2->id,
            'driver_user_id' => $user->id,
            'distance' => 10,
            'total_price' => 10,
            'vat_id' => \App\Models\Vat::first()->id,
            'details' => 'Details',
            'pay_method_id' => \App\Models\PayMethod::first()->id,
            'pay_details' => 'Text',
            'agreement' => 'Agreement',
            'agreement_date' => \Carbon\Carbon::now(),
        ]);

        $trip->services()->create([
            'name' => 'Transport',
            'price' => 3,
            'quantity' => 250
        ]);


        $trip->startPoint()->create([
            'point_type_id' => \App\Models\PointType::START,
            'place_id' => $place->id,
            'cargo_weight' => 100,
            'cargo_volume' => 120,
            'details' => 'detalii la sofer',
            'schedule_date' => \Carbon\Carbon::now()->addDay(1),
        ]);

        $trip->endPoint()->create([
            'point_type_id' => \App\Models\PointType::END,
            'place_id' => $place2->id,
            'details' => 'detalii la sofer',
            'schedule_date' => \Carbon\Carbon::now()->addDay(4),
        ]);

    }
}

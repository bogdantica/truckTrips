<?php

use Illuminate\Database\Seeder;

class LookUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\EventType::create([
            'name' => 'trip',
            'display' => 'Cursa',
            'event_type_id' => \App\Models\EventType::TRIP,
        ]);

        \App\Models\EventType::create([
            'name' => 'fuel',
            'display' => 'Alimentare',
            'event_type_id' => \App\Models\EventType::FUEL,
        ]);

        \App\Models\PointType::create([
            'name' => 'start',
            'display' => 'Locatie Plecare',
            'point_type_id' => \App\Models\PointType::START,
        ]);

        \App\Models\PointType::create([
            'name' => 'intermediate',
            'display' => 'Internediar - Descarcare',
            'point_type_id' => \App\Models\PointType::UNLOAD,
        ]);

        \App\Models\PointType::create([
            'name' => 'intermediate',
            'display' => 'Intermediar - Incarcare',
            'point_type_id' => \App\Models\PointType::LOAD,
        ]);

        \App\Models\PointType::create([
            'name' => 'start',
            'display' => 'Locatie Sosire',
            'point_type_id' => \App\Models\PointType::END,
        ]);

        \App\Models\Vat::create([
            'name' => '0 %',
            'percentage' => '0'
        ]);
        \App\Models\Vat::create([
            'name' => '19 %',
            'percentage' => '0.19'
        ]);

        \App\Models\VehicleType::create([
            'name' => 'Cap Tractor'
        ]);

        \App\Models\VehicleType::create([
            'name' => 'Camion'
        ]);

        \App\Models\VehicleType::create([
            'name' => 'Duba'
        ]);

        \App\Models\VehicleType::create([
            'name' => 'Prelata'
        ]);

        \App\Models\VehicleType::create([
            'name' => 'Frigorific'
        ]);

        \App\Models\VehicleType::create([
            'name' => 'Decopertat'
        ]);

        \App\Models\VehicleType::create([
            'name' => 'Agabaritic'
        ]);

        \App\Models\VehicleType::create([
            'name' => 'Trailer'
        ]);

        \App\Models\VehicleType::create([
            'name' => 'Basculanta'
        ]);
        \App\Models\VehicleType::create([
            'name' => 'Cisterna'
        ]);
        \App\Models\VehicleType::create([
            'name' => 'Cisterna Alimentara'
        ]);
        \App\Models\VehicleType::create([
            'name' => 'Container'
        ]);

        \App\Models\PayMethod::create([
            'name' => 'O.P.'
        ]);

        \App\Models\PayMethod::create([
            'name' => 'Cash'
        ]);

        \App\Models\PayMethod::create([
            'name' => 'Cash'
        ]);

    }
}

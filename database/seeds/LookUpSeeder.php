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
            'display' => 'Locatie Intermediara',
            'point_type_id' => \App\Models\PointType::INTERMEDIATE,
        ]);

        \App\Models\PointType::create([
            'name' => 'start',
            'display' => 'Locatie Sosire',
            'point_type_id' => \App\Models\PointType::END,
        ]);

    }
}

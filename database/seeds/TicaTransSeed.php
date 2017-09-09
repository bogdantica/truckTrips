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
        $burcea = \App\Models\User::create([
            'name' => 'Burcea Stelica',
            'email' => 'burcea.stelica@yahoo.ro',
            'password' => bcrypt('admin123'),
            'token' => md5(time() . rand(-500, 1000) . time())
        ]);

        $TR67TYK = \App\Models\Truck::create([
            'name' => 'Scania R480',
            'registration' => 'TR67TYK',
        ]);

        \DB::table('users_trucks')->insert([
            'user_id' => $burcea->id,
            'truck_id' => $TR67TYK->id
        ]);


    }
}

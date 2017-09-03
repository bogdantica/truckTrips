<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Tica Bogdan',
            'email' => 'tica.bogdan@yahoo.ro',
            'password' => bcrypt('admin123')
        ]);

        // $this->call(UsersTableSeeder::class);
        $this->call(LookUpSeeder::class);


    }
}

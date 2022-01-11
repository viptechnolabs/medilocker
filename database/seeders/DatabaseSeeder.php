<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(HospitalSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        //$this->call(DoctorSeeder::class);
        //$this->call(UserSeeder::class);
        //$this->call(CertificateSeeder::class);
    }
}

<?php

use App\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
       $doctor= Doctor::create(
            [
                "name"=>"El Doctor",
                "email"=>"doctor@doctor.com",
                "password"=>Hash::make('doctor2020'),
                "national_id"=>1245546645,
                'is_baned'=>0,
                "pharmacy_id"=>1

            ]
            );
        $doctor->assignRole("doctor","doctor");
    }
}

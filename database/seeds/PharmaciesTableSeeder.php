<?php

use App\Pharmacy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PharmaciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pharmacy = Pharmacy::create(
            [
                "name"=>"la pharmacia",
                "email"=>"pharmacy@pharmacy.com",
                "password"=>Hash::make('pharmacy2020'),
                "national_id"=>546456456,
                "priority"=>20,
                "area_id"=>1
            ]
            );
        $pharmacy->assignRole("pharmacy","pharmacy");
        $pharmacy->assignRole("doctor","pharmacy");
    }
}

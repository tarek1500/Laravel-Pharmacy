<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('addresses')->insert([
            'street_name'=>'street',
            'building_number'=>'1',
            'floor_number'=>'2',
            'flat_number'=>'3',
            'is_main'=>true,
            'user_id'=>'1',
            'area_id'=>'1'
        ]);

        DB::table('addresses')->insert([
            'street_name'=>'street2',
            'building_number'=>'12',
            'floor_number'=>'22',
            'flat_number'=>'32',
            'is_main'=>false,
            'user_id'=>'1',
            'area_id'=>'2'
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            'name'=>'areaname',
            'address'=>'areaaddress'
        ]);
        DB::table('areas')->insert([
            'name'=>'areaname2',
            'address'=>'areaaddress2'
        ]);
    }
}

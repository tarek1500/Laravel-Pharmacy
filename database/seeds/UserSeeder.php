<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'user',
            'email'=>'user@user.com',
            'password'=>Hash::make('123456'),
            'gender'=>'m',
            'date_of_birth'=>Carbon::create('2000','1','1'),
            'avatar_img'=>'default.jpg',
            'mobile_number'=>'012123456',
            'national_id'=>'123456789',
        ]);
    }
}

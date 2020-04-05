<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctor= User::create(
            [
                "name"=>"random user",
                "email"=>"user@user.com",
                "password"=>Hash::make('user2020'),
                "national_id"=>1245546645,
                'gender'=>'male',
                'mobile_number'=>"54345354345",
                'avatar_img'=>'none',
                'data_of_birth'=>'2018-11-12'
            ]
            );
    }
}

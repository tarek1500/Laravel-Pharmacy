<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();       
        Role::create([
                'guard_name'=>'admin',
                'name'=>'admin'
            ]);

        Role::create([
            'guard_name'=>'admin',
            'name'=>'pharmacy'
        ]);

        Role::create([
            'guard_name'=>'admin',
            'name'=>'doctor'
        ]);

        Role::create([
            'guard_name'=>'pharmacy',
            'name'=>'pharmacy'
        ]);

        Role::create([
            'guard_name'=>'pharmacy',
            'name'=>'doctor'
        ]);
        
        Role::create([
            'guard_name'=>'doctor',
            'name'=>'doctor'
        ]);

    }
}

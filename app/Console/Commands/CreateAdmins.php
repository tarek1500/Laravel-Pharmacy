<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;

class CreateAdmins extends Command
{
   
     /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'create:admin {--email=} {--password=}';
    /* example for command :
        php artisan create:admin --email=admin2@admin.com --password=123456
    */

    /**
     * The console command description.
     *
     * @var string
     */

    /* this description will show when user use php artisan command*/
    protected $description = 'Create Admin with Email and Password';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   

        $roles = Role::all();
        if($roles->isEmpty()){

            Artisan::call("db:seed --class=RolesTableSeeder");

         }
        $admin=Admin::create([
            'email' => $this->option('email'), //$this->option('email')->the value inserted by user
            'password' =>Hash::make($this->option('password')),
        ]);
        $admin->assignRole('admin','admin');
        $admin->assignRole("pharmacy","admin");
        $admin->assignRole("doctor","admin");    
    }
}

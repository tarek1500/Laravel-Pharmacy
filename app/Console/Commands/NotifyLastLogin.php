<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\LastLoginEmail;
use Mail;
use App\User;
use Carbon\Carbon;

class NotifyLastLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:last_login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send emails to notify users not logged in for month' ;

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
    {   $today=Carbon::now();
        $past=$today->subMonth()->format('y-m-d 00:00:00');
        $users=User::where('last_login_date',$past)->get();
        
        if($users->count()>0)
        {
            Mail::to($users)->send(new LastLoginNotification());
        }
        else
        {}
    }
}

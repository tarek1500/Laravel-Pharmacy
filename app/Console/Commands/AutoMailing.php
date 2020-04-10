<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Mail\MissuEmail;
use Illuminate\Support\Facades\Mail;


class AutoMailing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command will send E-mails Daily to users who didnt login from a month tellig them that we miss them';

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

        $awayUsers = User::where('last_login_date', '<=', new \DateTime('-1 months'))->get();

        foreach ($awayUsers as $user) {

            Mail::to($user->email)->send(new MissuEmail);
        }

    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Pharmacy;
use App\Area;
use App\Order;

class AssignOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'scan the
    new orders and assign them to the highest priority pharmacy that
    serves same delivering address
    ';

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
        $orders=Order::where('status_id',0)->where('pharamcy_id',null)->get();
        if(!$orders->isEmpty()) 
        {
            foreach ($orders as $order)
            { $pharmacy=Pharmacy::where('area_id',$order->address->area_id)->orderBy('priority', 'desc')->first();
                if($pharmacy)
                {
                    $order->pharamcy_id=$pharmacy->id;
                    $order->status_id=1; //Processing
                }
                else
                {
                    $order->status_id=3;//cancel
                }
                $order->save();
            }
        }
    }
}

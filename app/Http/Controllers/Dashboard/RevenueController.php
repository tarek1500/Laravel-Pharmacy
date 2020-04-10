<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Pharmacy;
use Illuminate\Support\Facades\Auth;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $rev=array();
        $pharmacies_total=0;
        $pharmacies = Pharmacy::all();
        $myTotal=0;
        foreach($pharmacies as $pharmacy)
            {
                $orders=Order::where('pharamcy_id',$pharmacy->id)->get();
                $TotalOrders=$orders->count();
                $TotalRevenue=$orders->sum('total_price');
                if(Auth::id()==$pharmacy->id)
                    $myTotal=$TotalRevenue;
                $pharmacies_total=$pharmacies_total+$TotalRevenue;
                array_push($rev,
                [  'avatar_image'=> $pharmacy->avatar_image,
                    'name'=> $pharmacy->name,
                    'TotalRevenue'=> $TotalRevenue,
                    'TotalOrders'=> $TotalOrders,
                ]);
            
            }
        if(request()->ajax())
        {
            return datatables()->of($rev)->make(true);
        }

        return view('revenues',[
            'pharmacies_total' => $pharmacies_total,
            'myTotal'=>$myTotal,
        ]);
    }
}

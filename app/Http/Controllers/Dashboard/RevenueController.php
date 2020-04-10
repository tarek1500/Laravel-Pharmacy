<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Pharmacy;


class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $revenue=array();
        $total=0;
     
        if (Auth::guard('pharmacy')->check()) {
            $id=Auth::user()->id;
            $pharmacies = Pharmacy::where('id',$id)->get();
         }
         
        if (Auth::guard('admin')->check()) {
        $pharmacies = Pharmacy::all();
        }

        foreach($pharmacies as $pharmacy)
            {
                $orders=Order::where('pharamcy_id',$pharmacy->id)->get();
                $TotalOrders=$orders->count();
                $TotalRevenue=$orders->sum('total_price');
                $total=$total+$TotalRevenue;
                array_push($revenue,
                [  'avatar_image'=> $pharmacy->avatar_image,
                    'name'=> $pharmacy->name,
                    'TotalRevenue'=> $TotalRevenue,
                    'TotalOrders'=> $TotalOrders,
                ]);
            
            }
        
        if(request()->ajax())
        {
            return datatables()->of($revenue)->make(true);
        }

        return view('revenues',[
            'total' => $total,
        ]);
    }


}

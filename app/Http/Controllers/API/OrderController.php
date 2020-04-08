<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiOrderStoreRequest;
use App\Http\Requests\ApiOrderUpdateRequest;
use App\Http\Resources\OrderResource;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderResource::collection(
            Order::where('order_user_id',Auth::id())->paginate(5)
        );
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        
        if($order)
            return new OrderResource($order);
        return ["error"=>"order not found"];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiOrderStoreRequest $request)
    {
        $order = $request->only(['is_insured','delivering_address_id']);
        $order['order_user_id']=Auth::id();
        $order['creator_type']="user";
        $order["status_id"]=0;
       
        $order=Order::create($order);

        if($request->hasFile('prescriptions'))
            $order->prescriptions = $request->file('prescriptions');

        return ["success"=>"your order was delivered successfully"];
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApiOrderUpdateRequest $request, $id)
    {
        $order = Order::find($id);

        if(!$order)
            return ["error"=>"resource not found"];

        if($order->status_id!=0)
            return ["error"=>"can't update that order as it's not in new status"];
        
                
        if($request->hasFile('prescriptions'))
            $order->prescriptions = $request->file('prescriptions'); 
    
        if($request->has('cancel'))
            if($request->cancel==1){
                $order->status_id=3;
                $order->save();
            }
              
        
        return ["success"=>"updated sucessfully"];
    }
}


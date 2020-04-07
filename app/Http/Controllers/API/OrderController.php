<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Order;
use App\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = 'images/prescriptions';
        $folder=Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix().$path;

        $order = $request->only(['is_insured','delivering_address_id']);
        $order['order_user_id']=Auth::id();
        $order['creator_type']="user";
        $order["status_id"]=1;
        $order=Order::create($order);

        foreach($request->files as $file){
            $pathinfo = pathinfo($file->getClientOriginalName());
            $file_path=$pathinfo['filename'].time().'.'.$pathinfo['extension'];
            $file->move($folder, $file_path);     
            Prescription::create([
                'image'=>$path.$file_path,
                'order_id'=>$order->id
            ]);
       }
        return ["success"=>"your order was delivered successfully"];
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}

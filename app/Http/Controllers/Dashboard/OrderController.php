<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\OrderConfirmed;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Medicine;
use App\Order;
use App\Prescription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Exceptions\CustomerAlreadyCreated;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('admin')->check())
            $user_orders=Order::all();
        else if(Auth::guard('pharmacy')->check())
            $user_orders=Auth::user()->orders;
        else if(Auth::guard('doctor')->check())
            $user_orders=Auth::user()->pharmacy->orders;
        $orders=[];
        foreach($user_orders as $order)
        {
            $orders[]=$order->completeOrder;
        }
        if(request()->ajax())
        {
            return DataTables::of($orders)->addColumn('action',function($order){
                $button = '<a type="button" name="show" href=" /dashboard/orders/'.$order['id'].'" id="'.$order['id'].'" class="btn btn-success"><i class="fa fa-eye"></i></a>';
                $button .= '<a type="button" name="edit" href=" /dashboard/orders/'.$order['id'].'/edit" id="'.$order['id'].'" class="btn btn-primary" ><i class="fas fa-edit"></i></a>';
                $button .= '<button type="button" name="delete" onclick="deleteOrder('.$order['id'].')" id="'.$order['id'].'" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>';
                    return $button;

            })->rawColumns(['action'])
                 ->make(true);
        }
        return view('order.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $statuses= ['Confirmed'=>'4','Delivered'=>'5' , 'Canceled'=>'3'];
        $medicines=[];
        if (Auth::guard('admin')->check()) {
            $medicines=Medicine::all();
            $statuses= ['New'=>'0'];
        } else if (Auth::guard('pharmacy')->check()) {
            $medicines=Auth::user()->medicines;
        } else if (Auth::guard('doctor')->check()) {
            $medicines=Auth::user()->pharmacy->medicines;
        }
        $medicines_unique_names=$medicines->unique('name');
        $medicines_unique_types=$medicines->unique('type');

        return view('order.create',[
            'users'=>$users,
            'statuses' =>$statuses,
            'medicines_unique_names'=>$medicines_unique_names,
            'medicines_unique_types'=>$medicines_unique_types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $order_params = $request->only([
            'order_user_id',
            'is_insured',
            'status_id'
        ]);
        $order_params['delivering_address_id'] = User::find($request['order_user_id'])
                                                    ->addresses()
                                                    ->where('is_main', '1')
                                                    ->first()->id;
        $pharmacy =Auth::user()->pharmacy;
        if (Auth::guard('admin')->check()) {
            $order_params['creator_type'] = 'admin';
        } else if (Auth::guard('pharmacy')->check()) {
            $order_params['creator_type'] = 'pharmacy';
            $order_params['pharamcy_id'] = Auth::user()->id;
        } else if (Auth::guard('doctor')->check()) {
            $order_params['creator_type'] = 'doctor';
            $order_params['doctor_id'] = Auth::user()->id;
            $order_params['pharamcy_id']= $pharmacy->id;
        }
        $order_params['total_price'] = $total_price=0;
        $order = Order::create($order_params);
        for ($i = 0; $i < count($request['med_name']); $i++) {
            $name = $request['med_name'][$i];
            $type = $request['med_type'][$i];
            if (!$medicine=Medicine::where(['name' => $name, 'type' => $type])->get()->first())
                $medicine = Medicine::create(['name' => $name, 'type' => $type]);

            $medicine->orders()->attach($order, ['quantity' => $request['med_quantity'][$i], 'price' => $request['med_price'][$i]*100]);
            if(!Auth::guard('admin')->check())
                $medicine->pharmacies()->attach($pharmacy);

            $total_price += $request['med_price'][$i]*100 * $request['med_quantity'][$i];
        }
        $order->update(['total_price' => $total_price]);
        return redirect(route('dashboard.orders.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('order.show',[
                'order'=>Order::find($id),
            ]

        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$user = $this->getCurrentUser();

		try
		{
			$user->createAsStripeCustomer();
		}
		catch (CustomerAlreadyCreated $ex) { }

        $order=Order::find($id);
        $this->validateUpdateOrderToLoggedUser($order);
        $statuses=Order::$statuses;
        $medicines=[];
        if (Auth::guard('admin')->check()) {
            $medicines=Medicine::all();
        } else if (Auth::guard('pharmacy')->check()) {
            $medicines=Auth::user()->medicines;
        } else if (Auth::guard('doctor')->check()) {
            $medicines=Auth::user()->pharmacy->medicines;
        }
        $medicines_unique_names=$medicines->unique('name');
        $medicines_unique_types=$medicines->unique('type');
        return view('order.edit',[
            'statuses' =>$statuses,
            'medicines_unique_names'=>$medicines_unique_names,
            'medicines_unique_types'=>$medicines_unique_types,
            'order'=>$order,
			'intent' => $user->createSetupIntent()
        ]);

    }

    private function validateUpdateOrderToLoggedUser($order)
    {
        if(Auth::guard('pharmacy')->check())
        {
            if( !isset($order->pharmacy))
                 return abort(404);
            if( Auth::user()->id != $order->pharmacy->id)
                 return abort(404);
        }
        if(Auth::guard('doctor')->check())
        {
            if( !isset($order->pharmacy))
                 return abort(404);
            if( Auth::user()->pharmacy->id != $order->pharmacy->id)
                 return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, $id)
    {
        $order=Order::find($id);
        $this->validateUpdateOrderToLoggedUser($order);
        if($order->status_id >= 2)
        {
            $order->update($request->only(['status_id']));
        }
        else //new or processing
        {
            $order_params= $request->only([
                'is_insured',
                'status_id'
            ]);
            !isset($request['is_insured'])? $order_params['is_insured']=0:'';
            $order->medicines()->detach();
            $order_params['total_price']=0;
            for ($i = 0; $i < count($request['med_name']); $i++) {
                $name = $request['med_name'][$i];
                $type = $request['med_type'][$i];
                if (!$medicine=Medicine::where(['name' => $name, 'type' => $type])->get()->first())
                    $medicine = Medicine::create(['name' => $name, 'type' => $type]);

                $medicine->orders()->attach($order, ['quantity' => $request['med_quantity'][$i], 'price' => $request['med_price'][$i]*100]);
                if(!Auth::guard('admin')->check())
                    $medicine->pharmacies()->attach($order->pharmacy);

                $order_params['total_price'] += $request['med_price'][$i]*100 * $request['med_quantity'][$i];
            }
            if($order->status_id ==1 && $order_params['status_id']==2 ) event(new OrderConfirmed($order)); 
            $order->update($order_params);
        }
        return redirect(route('dashboard.orders.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order= Order::find($id);
        $order->medicines()->detach();
        $order->prescriptions()->delete();
        $order->delete();
    }

	private function getCurrentUser()
	{
		$user = null;

		if (Auth::guard('admin')->check())
			$user = Auth::guard('admin')->user('admin');
		else if (Auth::guard('pharmacy')->check())
			$user = Auth::guard('pharmacy')->user('pharmacy');
		else if (Auth::guard('doctor')->check())
			$user = Auth::guard('doctor')->user('doctor');

		return $user;
	}
}

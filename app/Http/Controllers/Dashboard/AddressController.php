<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Area;
use App\User;
use App\Address;
use App\Http\Requests\AddressRequest;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $address_table=array();
        $addresses = Address::all();


        foreach($addresses as $address)
        {
            if($address->is_main==0)
            {$address->is_main="No";}
            else
            {$address->is_main="Yes";}
            array_push($address_table,
            [   
                'user_name'=> $address->user->name,
                'area_name'=>$address->area->name,
                'street_name'=> $address->street_name,
                'building_number'=> $address->building_number,
                'floor_number'=> $address->floor_number,
                'flat_number'=> $address->flat_number,
                'is_main'=> $address->is_main,
                'user_id'=> $address->user_id,
                'id'=>$address->id,
            ]);
        }
        if(request()->ajax())
        {
            
            return datatables()->of($address_table)->addColumn('action', function($data){
                $button  = '<a type="button" name="edit" href="/dashboard/addresses/'.$data['id'].'/edit " id="'.$data['id'].'" class="btn btn-primary" ><i class="fas fa-edit"></i></a>';
                $button .= '<button type="button" name="delete" onclick="deleteAddress('.$data['id'].')" id="'.$data['id'].'" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);}
        return view('address.index', [
            'addresses' => $addresses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::all();
        $users= User::all();
    

            return view('addressTab.create', [
                'areas' => $areas,
                'users' => $users,
            ]);
    }

       
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        $users_have_main=Address::where('user_id', $request->user_id)->where('is_main',1)->get();
         if($users_have_main->count()>0 and $request->is_main==1)
         {
            $errors="user already have main Address";
            return redirect('dashboard/addresses/create')
            ->withErrors($errors);
        }
        else{
               Address::create($request->all());
            }
               
                return redirect()->route('dashboard.addresses.index');  
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = Address::find($id);
        if($address){
            $areas = Area::all();
            return view("addressTab.edit",[
                "address" => $address,
                "areas" => $areas,
                ]);
        }

        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id)
    {   $address = Address::find($id);
        $users_have_main=Address::where('user_id', $address->user_id)->where('is_main',1)->first();
         if($users_have_main != null and $users_have_main->id != $id and $request->is_main==1)
         {
            $users_have_main->is_main=0;
            $users_have_main->save();
        }
        
            $address->update($request->all());
            return redirect()->route('dashboard.addresses.index');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        if($address->is_main==0)
        {
        $address->delete();
        }
        else 
        {return response()->json(['errors' => 'cant delete it is main address you should select another address to be the main before deleting this address.']);}
    }
}

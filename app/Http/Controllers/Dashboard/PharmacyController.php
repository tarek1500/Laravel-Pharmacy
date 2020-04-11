<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PharmacyRequest;
use App\Pharmacy;
use App\Area;
use App\Order;
use App\MedicinePharmacy;
use App\Doctor;
use Illuminate\Support\Facades\Auth;


class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        
        $pharmacies = Pharmacy::all();
        if(request()->ajax())
        {
            
            return datatables()->of($pharmacies)->addColumn('action', function($data){
                $button = '<a type="button" name="show" href=" /dashboard/pharmacies/'.$data->id.'" id="'.$data->id.'" class="btn btn-success" ><i class="fa fa-eye"></i></a>';
                $button .= '<a type="button" name="edit" href=" /dashboard/pharmacies/'.$data->id.'/edit" id="'.$data->id.'" class="btn btn-primary" ><i class="fas fa-edit"></i></a>';
                $button .= '<button type="button" name="delete" onclick="deletePharmacy('.$data->id.')" id="'.$data->id.'" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
 
        return view('pharmacies');
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::all();
        return view('pharmacyTab.create', [
            'areas' => $areas,
        ]);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PharmacyRequest $request)
    {   
        if(request()->hasFile('avatar_image')){
            $image = $request->file('avatar_image');
        }else{
            $image=null;
        }

        $pharmacy= Pharmacy::create([
                    'name' => $request->name,
                    'email'=> $request->email,
                    'password' => $request->password,
                    'national_id' => $request->national_id,
                    'avatar' => $image,
                    'priority'=> $request->priority,
                    'area_id'=> $request->area_id,
                ]);
                $pharmacy->avatar=$image;
                $pharmacy->assignRole("pharmacy","pharmacy");
                $pharmacy->assignRole("doctor","pharmacy");
                $pharmacy->save();
                return redirect()->route('dashboard.pharmacies.index');  
      

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pharmacy = Pharmacy::find($id);
        if($pharmacy)
            return view('pharmacyTab.show' , [
                "pharmacy" => $pharmacy
                ]);
        return abort(404);    

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $pharmacy = Pharmacy::find($id);
         
            if($pharmacy){
            $areas = Area::all();
            return view("pharmacyTab.edit",[
                "pharmacy" => $pharmacy,
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
    public function update(PharmacyRequest $request, $id)
    { 
        $pharmacy = Pharmacy::find($id);
        if($request->hasFile('avatar_image')){
           $image = $request->file('avatar_image');
            $pharmacy->avatar =$image;
            $pharmacy->update(
                ['name' => $request->name,
                'email'=> $request->email,
                'password' => $request->password,
                'national_id' => $request->national_id,
                'priority'=> $request->priority,
                'area_id'=> $request->area_id,]
            );
            }
        else{
            $pharmacy->update($request->all());
        }
           
            return redirect()->route('dashboard.pharmacies.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $orders=Order::where('pharamcy_id',$id)->get()->count();
        if($orders==0)
        {

        $pharmacy = Pharmacy::find($id);
        $pharmacy->delete();
        }
        else 
        {return response()->json(['errors' => 'cant delete pharmacy have orders.']);}
    
}
public function trash()
{  

    $pharmacies = Pharmacy::onlyTrashed()->get();;
    if(request()->ajax())
    {
        
        return datatables()->of($pharmacies)->addColumn('restore', function($data){
            $button = '<button type="button" name="delete" onclick="retrivePharmacy('.$data->id.')" id="'.$data->id.'" class="btn btn-success" ><i class="fa fa-recycle" aria-hidden="true"></i></button>';
            
            return $button;
        })
        ->rawColumns(['restore'])
        ->make(true);
    }

    return view('pharmacyTab.trash');
   }

public function restore($id)
   {  

    Pharmacy::withTrashed()
    ->where('id',$id)
    ->restore();
   }
}

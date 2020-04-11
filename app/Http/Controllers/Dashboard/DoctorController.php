<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Doctor;
use App\Pharmacy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $alldoctors=Doctor::all();
        if(Auth::guard('pharmacy')->check())
            $alldoctors=Auth::user()->doctors;
       
        $doctors = [];
        foreach($alldoctors as $doctor)
        {
            $doctors[]=$doctor->getCompleteDoctorAttribute();
        }

        if($request->ajax()){
            // $data = Doctor::latest()->get();
            return DataTables::of($doctors)
                ->addColumn('action' , function($doctor){
                    $button = '<a type="button" name="edit" href=" /dashboard/doctor/'.$doctor['id'].'/edit" id="'.$doctor['id'].'" class="btn mx-2 btn-primary" ><i class="fas fa-edit"></i></a>';
                    $button .= '<button type="button" name="delete"  onclick="deleteDoctor('.$doctor['id'].')" id="'.$doctor['id'].'" class="btn mx-2 btn-danger" ><i class="fas fa-trash-alt"></i></button>';

                    return $button;
                })
                ->addColumn('is_baned' , function($doctor){

                    if($doctor['is_baned']){
                    $ban = '<button type="button" name="unban" data-ban = '.$doctor['is_baned'].' id = "unban" onclick="banDoctor('.$doctor['id'].')" id="'.$doctor['id'].'" class="btn mx-auto btn-success" >UnBan</button>';
                    }else{
                        $ban = '<button type="button" name="ban" id = "ban"  data-ban = '.$doctor['is_baned'].'  onclick="banDoctor('.$doctor['id'].')" id="'.$doctor['id'].'" class="btn mx-auto btn-danger" >Ban</button>';
                    }

                    return $ban;
                })
                ->rawColumns(['action', 'is_baned'])
                ->make(true);
        }

        return view('doctor.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pharmacies = Pharmacy::all();
        return view('doctor/create',[
            "pharmacies" => $pharmacies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pharmacyName = $request->pharmacy_name;
        $pharmacy = Pharmacy::where ('name',$pharmacyName)->get('id');
        $pharmacyId = $pharmacy["0"]["id"];

        $this->validate($request , [
            'name' => 'required|min:3|unique:doctors',
            'email'=> 'required|unique:doctors',
            'password' => 'required | min:6',
            'national_id' => 'required | min:14 | max:14 | unique:doctors',
            'avatar_image' => 'required'
        ]);

        if(request()->hasFile('avatar_image')){
            $image = $request->file('avatar_image');
        }else{
            return $request;
            $image=null;
        }


        $doctor=Doctor::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' =>  Hash::make( $request->password),
            'national_id' => $request->national_id,
            'pharmacy_id'=> $pharmacyId
        ]);
        $doctor->avatar=$image;
        $doctor->assignRole("doctor","doctor");
        $doctor->save();
        return redirect('dashboard/doctors');
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

        $doctor = Doctor::find($id);
        $pharmacies = Pharmacy::all();

        return view('doctor/edit',[
            "pharmacies" => $pharmacies,
            "doctor" => $doctor
        ]);
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
        $doctor = Doctor::find($id);

        if($request->ajax()){
            $doctor->is_baned=$request->ban;;
            $doctor->save();
            return ["success"=>"banned"];
        }

        $pharmacyName = $request->pharmacy_name;
        $pharmacy = Pharmacy::where ('name',$pharmacyName)->get('id');
        $pharmacyId = $pharmacy["0"]["id"];

        $this->validate($request , [
            'name' => 'required|min:3',
            'email'=> 'required',
            'password' => 'required | min:6',
            'national_id' => 'required | min:14 | max:14',
            ]);


            if(request()->hasFile('avatar_image')){
                $doctor->avatar= $request->file('avatar_image');
            }


            $doctor->update([
                'name' => $request->name,
                'email'=> $request->email,
                'password' => $request->password,
                'national_id' => $request->national_id,
                'pharmacy_id'=> $pharmacyId,
                ]);

                return redirect('dashboard/doctors');
            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();
    }
}


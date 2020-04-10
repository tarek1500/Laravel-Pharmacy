<?php

namespace App\Http\Controllers\Dashboard;


use App\Doctor;
use App\Pharmacy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
       $user = $this->getCurrentUser();
        if($user){
            return view("profile.edit",[
                "user" => $user,
                ]);
        }

        return abort(404);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6',
            'avatar_image'=> 'sometimes|file|mimes:jpeg,jpg,png',
        ]);
        
        $user=$this->getCurrentUser();
      
        if($user){

            if($request->hasFile('avatar_image')){
                $user->avatar=$request->file('avatar_image');
            }


            $user->name = $request->name;
            $user->save(); 
            return redirect()->route('dashboard.index');    
        }
     
        return abort(404); 
    }

    private function getCurrentUser(){
        $user=null;
        if (Auth::guard('pharmacy')->check())
            $user=Pharmacy::find(Auth::id());
        else if (Auth::guard('doctor')->check())
           $user=Doctor::find(Auth::id());
        return $user;
    }


}


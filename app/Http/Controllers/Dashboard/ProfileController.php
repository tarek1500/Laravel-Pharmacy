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
                "user" => $user['user'],
                ]);
        }

        return abort(404);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6',
            'avatar_image'=> 'sometimes|file|mimes:jpeg,jpg',
        ]);
        
        $user=$this->getCurrentUser();
      
        if($user){
            
            if($request->hasFile('avatar_img'))
                $this->updateAvatar($request->file('avatar_img'),$user);
            
            $user=$user['user'];
            $user->name = $request->name;
            $user->save(); 
            return redirect()->route('dashboard.index');    
        }
     
        return abort(404); 
    }

    private function getCurrentUser(){
        $user=null;
        if (Auth::guard('pharmacy')->check())
            $user=["user"=>Pharmacy::find(Auth::id()),"type"=>"pharmacy"];
        else if (Auth::guard('doctor')->check())
            $user=["user"=>Doctor::find(Auth::id()),"type"=>"doctor"];
        return $user;
    }

    private function updateAvatar($image,$user){
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
       
        if($user['type']=='pharmacy'){
            Storage::delete('images/pharmacy_avatar'.$user->avatar_img); 
            $image->move(public_path('/images/pharmacy_avatar/'), $new_name);
        }
        else {
            Storage::delete('images/doctors'.$user->avatar_img);
            $image->move(public_path('/images/doctors/'), $new_name);
        }

        $user['user']->avatar_img = $new_name;    
    }


}


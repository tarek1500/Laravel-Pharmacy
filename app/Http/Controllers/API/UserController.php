<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       $user = User::find(Auth::id());
        
        if($user)
            return new UserResource($user);
        return ["error"=>"user not found"];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request)
    {
        $user = $request->only(["name","mobile_number"]);
        $avatar = $request->file('avatar_img');
        if($avatar)
            $user["avatar_img"] = $avatar;
        User::find(Auth::id())->update($user);
        return ["success"=>"updated profile successfully"];
    }

}

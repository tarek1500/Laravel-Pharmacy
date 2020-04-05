<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Handle a login request to the application.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
		$user = User::where('email', $request->email)->first();

		if (!$user || !Hash::check($request->password, $user->password)) {
			throw ValidationException::withMessages([
				'email' => ['The provided credentials are incorrect.'],
			]);
		}

		$token = $user->tokens()->where('name', $request->device_name)->first();

		if (!$token)
			return $user->createToken($request->device_name)->plainTextToken;

		$token->update([
			'token' => hash('sha256', $plainTextToken = Str::random(80))
		]);

		return $plainTextToken;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \App\Http\Requests\RegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
		$avatar_path = $request->file('avatar_img')->store('images/avatars');

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'gender' => $request->gender,
			'data_of_birth' => $request->data_of_birth,
			'avatar_img' => $avatar_path,
			'mobile_number' => $request->mobile_number,
			'national_id' => $request->national_id
		]);

		return $user->createToken($request->device_name)->plainTextToken;
    }
}
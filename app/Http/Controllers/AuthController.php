<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
	public function register(StoreUserRequest $request)
	{
		$createUser = User::create($request->validated());

		Mail::to("$createUser->email")->send(new VerifyEmail($createUser->remember_token));

		return response()->json(['msg' => 'Registered Successfully']);
	}

	public function login(Request $request)
	{
		$request->validate([
			'email'       => 'required|email',
			'password'    => 'required',
			'device_name' => 'required',
		]);

		$user = User::where('email', $request->email)->first();

		if (!$user || !Hash::check($request->password, $user->password)) {
			throw ValidationException::withMessages([
				'email' => ['The provided credentials are incorrect.'],
			]);
		}

		return $user->createToken($request->device_name)->plainTextToken;
	}

	public function logout(Request $request)
	{
		$request->user()->currentAccessToken()->delete();
		return response()->json(['msg' => 'Logout Successfull']);
	}
}

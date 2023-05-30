<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
	public function register(StoreUserRequest $request): JsonResponse
	{
		$createUser = User::create($request->validated());

		$createUser->remember_token = $request->remember_token;
		$createUser->update();

		Mail::to("$createUser->email")->send(new VerifyEmail($createUser));

		return response()->json(['msg' => 'Registered Successfully']);
	}
}

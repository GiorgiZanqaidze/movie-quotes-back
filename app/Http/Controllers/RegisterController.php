<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Mail\VerifyEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
	public function register(StoreUserRequest $request): JsonResponse
	{
		$data = $request->validated();

		$createUser = User::create($data);
		$createUser->token_expiry = Carbon::now()->addDay();
		$createUser->remember_token = $request->remember_token;
		$createUser->save();

		Mail::to("$createUser->email")->send(new VerifyEmail($createUser));

		return response()->json(['msg' => 'Registered Successfully']);
	}

	public function verifyAccount(String $token): JsonResponse
	{
		$verifyUser = User::where('remember_token', $token)->first();

		if (!is_null($verifyUser)) {
			if ($verifyUser->token_expiry && Carbon::parse($verifyUser->token_expiry)->isPast()) {
				return response()->json(['msg' => 'Token has expired'], 400);
			}

			if (!$verifyUser->email_verified_at) {
				$verifyUser->email_verified_at = now();
				$verifyUser->save();
			}

			Auth::login($verifyUser);
			return response()->json(['msg' => 'You are verified Successfully']);
		}

		return response()->json(['msg' => 'You are not verified'], 404);
	}

	public function resendVerificationEmail(String $token): JsonResponse
	{
		$user = User::where('remember_token', $token)->first();

		if (is_null($user)) {
			return response()->json(['msg' => 'User not found'], 404);
		}

		if ($user->email_verified_at) {
			return response()->json(['msg' => 'User is already verified'], 400);
		}

		if ($user->token_expiry && Carbon::now()->isBefore($user->token_expiry)) {
			return response()->json(['msg' => 'Token has not expired yet'], 400);
		}

		$user->token_expiry = Carbon::now()->addDay();
		$user->save();

		Mail::to($user->email)->send(new VerifyEmail($user));

		return response()->json(['msg' => 'Verification email has been resent']);
	}
}

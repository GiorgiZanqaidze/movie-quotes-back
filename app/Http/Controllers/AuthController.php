<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginUserRequest as UserLoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function login(UserLoginUserRequest $request)
	{
		$input = $request->validated();

		$fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

		if (Auth::attempt([$fieldType => $input['email'], 'password' => $input['password']], $request->has('remember'))) {
			$user = auth()->user();
			if (!$user->email_verified_at) {
				return response()->json(['message' => json_encode([
					'en' => 'You are not verified',
					'ka' => 'არ ხარ ვერიფიცირებული',
				]), ], 403);
			}
			return auth()->user();
		} else {
			return response()->json(['message' => json_encode([
				'en' => 'Invalida Credentials',
				'ka' => 'არასწორი მონაცემები',
			]), ], 401);
		}
	}

	public function logout(Request $request)
	{
		$request->session()->invalidate();

		return response()->json('Successfully logged out');
	}
}

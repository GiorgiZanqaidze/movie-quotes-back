<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserPasswordRequest as UserUpdateUserPasswordRequest;
use App\Http\Requests\User\UpdateUserRequest as UserUpdateUserRequest;
use App\Mail\ResetPassword as MailResetPassword;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;

class ResetPasswordController extends Controller
{
	public function postPassword(UserUpdateUserRequest $request): JsonResponse
	{
		$request->validated();
		$user = User::where('email', $request->email)->first();

		Mail::to("$user->email")->send(new MailResetPassword($user));

		return response()->json(['msg' => 'Send email Successfully']);
	}

	public function update(string $token, UserUpdateUserPasswordRequest $request): JsonResponse
	{
		$user = User::where('remember_token', $token)->first();
		$user->update($request->validated());
		return response()->json(['msg' => 'Send email Successfully']);
	}
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\ResetPassword as MailResetPassword;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;

class ResetPasswordController extends Controller
{
	public function postPassword(UpdateUserRequest $request): JsonResponse
	{
		$request->validated();
		$user = User::where('email', $request->email)->first();

		Mail::to("$user->email")->send(new MailResetPassword($user));

		return response()->json(['msg' => 'Send email Successfully']);
	}

	public function update(string $token, UpdateUserPasswordRequest $request): JsonResponse
	{
		$user = User::where('remember_token', $token)->first();
		$user->update($request->validated());
		return response()->json(['msg' => 'Send email Successfully']);
	}
}

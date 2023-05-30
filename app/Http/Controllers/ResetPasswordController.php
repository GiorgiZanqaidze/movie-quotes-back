<?php

namespace App\Http\Controllers;

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
		$token = $user->remember_token;

		Mail::to("$user->email")->send(new MailResetPassword($user));

		return response()->json(['msg' => 'Send email Successfully']);
	}
}

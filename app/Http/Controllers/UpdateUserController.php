<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserAvatarRequest;
use App\Mail\UpdateEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;

class UpdateUserController extends Controller
{
	public function updateAvatar(User $user, UpdateUserAvatarRequest $request): JsonResponse
	{
		$request->validated();
		$user->image = $request->file('avatar')->store('images');
		$user->update();
		return response()->json($user, 200);
	}

	public function updateUser(User $user, Request $request): JsonResponse
	{
		$user->name = $request->name;
		$user->password = $request->password;

		if ($request->email !== $user->email) {
			Mail::to("$request->email")->send(new UpdateEmail($user));
		}

		$user->update();
		return response()->json($user, 200);
	}

	public function updateUserEmail($token, Request $request): JsonResponse
	{
		$user = User::where('remember_token', $token)->first();

		$user->email = $request->email;

		$user->update();

		return response()->json($request->email, 200);
	}
}
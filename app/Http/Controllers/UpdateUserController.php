<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserAvatarRequest;
use App\Models\User;

class UpdateUserController extends Controller
{
	public function updateAvatar(User $user, UpdateUserAvatarRequest $request)
	{
		$request->validated();
		$user->image = $request->file('avatar')->store('images');
		$user->update();
		return response()->json($user, 200);
	}
}

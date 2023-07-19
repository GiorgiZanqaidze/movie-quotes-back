<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserAvatarRequest as UserUpdateUserAvatarRequest;
use App\Http\Requests\User\UpdateUserCredentialsRequest;
use App\Mail\UpdateEmail;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class UpdateUserController extends Controller
{
	public function updateAvatar(User $user, UserUpdateUserAvatarRequest $request): JsonResponse
	{
		$request->validated();

		$newImage = $request->file('avatar')->store('images');

		if ($user->image && $user->image !== $newImage) {
			Storage::delete('images/' . $user->image);
		}
		$user->image = $newImage;

		$user->update();

		return response()->json($user, 200);
	}

	public function updateUser(User $user, UpdateUserCredentialsRequest $request): JsonResponse
	{
		$user->name = $request->validated('name');

		if ($request->password) {
			$user->password = $request->validated(['password']);
		}

		$validEmail = $request->email;

		if ($validEmail !== $user->email) {
			Mail::to("$user->email")->send(new UpdateEmail($user, $validEmail));
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

	public function updateNotifications(): JsonResponse
	{
		$notifications = Notification::where('receiver_id', auth()->id());
		$notifications->update(['read_at' => now()]);

		$sortedNotifications = $notifications->orderBy('created_at', 'desc')->get();

		return response()->json($sortedNotifications, 200);
	}

	public function updateNotification(Notification $notification): JsonResponse
	{
		$notification->update(['read_at' => now()]);

		$notifications = Notification::where('receiver_id', auth()->id());

		$sortedNotifications = $notifications->orderBy('created_at', 'desc')->get();
		return response()->json($sortedNotifications, 200);
	}
}

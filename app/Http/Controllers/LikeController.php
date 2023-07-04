<?php

namespace App\Http\Controllers;

use App\Events\PostDislike;
use App\Events\PostLike;
use App\Events\SendNotifications;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\StoreNotification;
use App\Http\Resources\LikeBasicResources;
use App\Http\Resources\UserBasicResources;
use App\Models\Like;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
	public function store(StoreLikeRequest $request, StoreNotification $notificationRequest): JsonResponse
	{
		$like = Like::create($request->validated());

		if ($request->user_id !== $request->receiver_id) {
			$notifiction = Notification::create($notificationRequest->validated());

			$authUser = new UserBasicResources(auth('sanctum')->user());

			$notification = (object)[
				'to'         => $request->receiver_id,
				'from'       => $authUser,
				'type'       => 'like',
				'created_at' => $notifiction->created_at,
			];

			event(new SendNotifications($notification));
		}

		$likeResourse = new LikeBasicResources($like->load('author'));

		event(new PostLike($likeResourse));

		return response()->json(['msg'=> 'Quote was successfully liked'], 200);
	}

	public function destroy(Request $request): JsonResponse
	{
		$like = Like::where('user_id', $request->user_id)
			->where('quote_id', $request->quote_id)
			->first();

		$likeResourse = new LikeBasicResources($like->load('author'));

		event(new PostDislike($likeResourse));

		$like->delete();

		return response()->json(['msg'=> 'Quote was successfully disliked'], 200);
	}
}

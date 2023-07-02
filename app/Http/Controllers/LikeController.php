<?php

namespace App\Http\Controllers;

use App\Events\PostDislike;
use App\Events\PostLike;
use App\Events\SendNotifications;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Resources\LikeBasicResources;
use App\Http\Resources\UserBasicResources;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Quote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
	public function store(StoreLikeRequest $request): JsonResponse
	{
		$like = Like::create($request->validated());

		if ($request->user_id !== $request->receiver_id) {
			$notification = new Notification();
			$notification->sender_id = $request->user_id;
			$notification->receiver_id = $request->receiver_id;
			$notification->type = 'like';
			$notification->save();

			$notification = (object)[
				'to'   => $request->receiver_id,
				'from' => auth('sanctum')->user(),
			];

			event(new SendNotifications($notification));
		}

		$author = new UserBasicResources($like->author);
		$likeResourse = new LikeBasicResources($like);

		event(new PostLike($likeResourse, $author));

		return response()->json(['msg'=> 'Quote was successfully liked'], 200);
	}

	public function destroy(Request $request): JsonResponse
	{
		$like = Like::where('user_id', $request->user_id)
			->where('quote_id', $request->quote_id)
			->first();

		$author = new UserBasicResources($like->author);

		$likeResourse = new LikeBasicResources($like);

		event(new PostDislike($likeResourse, $author));

		$like->delete();

		$quote = Quote::where('id', $like->quote_id)->first();
		return response()->json(['msg'=> 'Quote was successfully disliked'], 200);
	}
}

<?php

namespace App\Http\Controllers;

use App\Events\PostDislike;
use App\Events\PostLike;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Resources\UserResource;
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
		$quote = Quote::where('id', $like->quote_id)->first();

		if ($request->user_id !== $request->receiver_id) {
			$notification = new Notification();
			$notification->sender_id = $request->user_id;
			$notification->receiver_id = $request->receiver_id;
			$notification->type = 'like';
			$notification->save();
		}

		$author = new UserResource($like->author);

		event(new PostLike($like, $author));

		return response()->json(['modified_quote'=> '']);
	}

	public function destroy(Request $request): JsonResponse
	{
		$like = Like::where('user_id', $request->user_id)
			->where('quote_id', $request->quote_id)
			->first();

		$author = new UserResource($like->author);

		event(new PostDislike($like, $author));

		$like->delete();

		$quote = Quote::where('id', $like->quote_id)->first();
		return response()->json(['modified_quote'=> $quote]);
	}
}

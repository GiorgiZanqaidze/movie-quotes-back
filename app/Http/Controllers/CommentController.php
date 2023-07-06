<?php

namespace App\Http\Controllers;

use App\Events\PostComment;
use App\Events\SendNotifications;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Notification\StoreNotificationRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\UserBasicResources;
use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
	public function store(StoreCommentRequest $request, StoreNotificationRequest $notificationRequest): JsonResponse
	{
		$comment = Comment::create($request->validated());

		if ($request->user_id !== $request->receiver_id) {
			$notifiction = Notification::create($notificationRequest->validated());

			$authUser = new UserBasicResources(auth('sanctum')->user());

			$notification = (object)[
				'to'         => $request->receiver_id,
				'from'       => $authUser,
				'type'       => 'comment',
				'created_at' => $notifiction->created_at,
			];

			event(new SendNotifications($notification));
		}

		$commentResource = new CommentResource($comment->load('author'));

		event(new PostComment($commentResource));

		return response()->json(['msg'=> 'Comment was successfully added'], 200);
	}
}

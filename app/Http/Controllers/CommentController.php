<?php

namespace App\Http\Controllers;

use App\Events\PostComment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StoreNotification;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Notification;

class CommentController extends Controller
{
	public function store(StoreCommentRequest $request, StoreNotification $notificationRequest)
	{
		$comment = Comment::create($request->validated());

		if ($request->user_id !== $request->receiver_id) {
			Notification::create($notificationRequest->validated());
		}

		$commentResource = new CommentResource($comment->load('author'));

		event(new PostComment($commentResource));

		return response()->json(['msg'=> 'Comment was successfully added'], 200);
	}
}

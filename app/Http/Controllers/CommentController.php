<?php

namespace App\Http\Controllers;

use App\Events\PostComment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\UserBasicResources;
use App\Models\Comment;
use App\Models\Notification;

class CommentController extends Controller
{
	public function store(StoreCommentRequest $request)
	{
		$comment = Comment::create($request->validated());

		if ($request->user_id !== $request->receiver_id) {
			$notification = new Notification();
			$notification->sender_id = $request->user_id;
			$notification->receiver_id = $request->receiver_id;
			$notification->type = 'comment';
			$notification->save();
		}
		$author = new UserBasicResources($comment->author);

		$commentResource = new CommentResource($comment);

		event(new PostComment($commentResource, $author));

		return response()->json(['msg'=> 'Comment was successfully added'], 200);
	}
}

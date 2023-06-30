<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Quote;

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
		return response()->json(['quote'=> Quote::where('id', $comment->quote_id)->first()]);
	}
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Quote;

class CommentController extends Controller
{
	public function store(StoreCommentRequest $request)
	{
		$comment = new Comment();
		$comment->quote_id = $request->validated()['quote_id'];
		$comment->user_id = $request->validated()['user_id'];
		$comment->text = $request->validated()['text'];
		$comment->save();
		return response()->json(['quote'=> Quote::where('id', $comment->quote_id)->first()]);
	}
}

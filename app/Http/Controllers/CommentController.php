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
		$comment->user_id = $request->user_id;
		$comment->quote_id = $request->quote_id;
		$comment->text = $request->text;
		$comment->save();
		return response()->json(['quote'=> Quote::where('id', $comment->quote_id)->get()]);
	}
}

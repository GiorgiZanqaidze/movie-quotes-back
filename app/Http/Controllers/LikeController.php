<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLikeRequest;
use App\Models\Like;
use App\Models\Quote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
	public function store(StoreLikeRequest $request): JsonResponse
	{
		$like = Like::create($request->validated());
		$quote = Quote::where('id', $like->quote_id)->first();
		return response()->json(['modified_quote'=> $quote]);
	}

	public function destroy(Request $request): JsonResponse
	{
		$like = Like::where('user_id', $request->user_id)
			->where('quote_id', $request->quote_id)
			->first();
		$like->delete();

		$quote = Quote::where('id', $like->quote_id)->first();
		return response()->json(['modified_quote'=> $quote]);
	}
}

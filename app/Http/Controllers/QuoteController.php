<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\JsonResponse;

class QuoteController extends Controller
{
	public function quotes(): JsonResponse
	{
		$quote = Quote::with(['movie', 'comments', 'author', 'likes'])->get();

		return response()->json($quote);
	}
}

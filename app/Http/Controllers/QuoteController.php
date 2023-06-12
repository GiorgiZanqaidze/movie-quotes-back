<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuoteRequest;
use App\Models\Quote;
use Illuminate\Http\JsonResponse;

class QuoteController extends Controller
{
	public function quotes(): JsonResponse
	{
		$quotes = Quote::with(['movie', 'comments.author', 'author', 'likes.author'])->latest()->get();

		return response()->json($quotes);
	}

	public function store(StoreQuoteRequest $request)
	{
		$quote = Quote::create($request->validated());
		$quote->setTranslations('name', ['en' => $request->name_en, 'ka' => $request->name_ka]);
		$quote->image = $request->file('image')->store('images');
		$quote->save();

		return response()->json(['data'=> $quote]);
	}
}

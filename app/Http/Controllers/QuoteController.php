<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuoteRequest;
use App\Models\Quote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
	public function quotes(Request $request): JsonResponse
	{
		$searchQuery = $request->input('query');
		$searchType = $request->input('searchType');

		$perPage = $request->input('per_page', 5);

		if ($searchQuery && $searchType && $searchType === 'quote') {
			$quotes = Quote::where('name->en', 'like', '%' . $searchQuery . '%')->orWhere('name->ka', 'like', '%' . $searchQuery . '%')->latest()->paginate($perPage);
		} elseif ($searchQuery && $searchType && $searchType === 'movie') {
			$quotes = Quote::whereHas('movie', function ($query) use ($searchQuery) {
				$query->where('title->en', 'like', '%' . $searchQuery . '%')->orWhere('title->ka', 'like', '%' . $searchQuery . '%');
			})->latest()->paginate($perPage);
		} else {
			$quotes = Quote::latest()->paginate($perPage);
		}

		return response()->json($quotes);
	}

	public function store(StoreQuoteRequest $request)
	{
		$quote = Quote::create($request->validated());
		$quote->setTranslations('name', ['en' => $request->name_en, 'ka' => $request->name_ka]);
		$quote->image = $request->file('image')->store('images');
		$quote->save();

		$newQuote = Quote::where('id', $quote->id)->first();

		return response()->json(['quote'=> $newQuote]);
	}
}

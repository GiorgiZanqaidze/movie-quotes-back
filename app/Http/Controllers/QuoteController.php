<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quote\StoreQuoteRequest as QuoteStoreQuoteRequest;
use App\Http\Requests\Quote\UpdateQuoteRequest as QuoteUpdateQuoteRequest;
use App\Http\Resources\QuoteResource;
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

		$quotesCollection = QuoteResource::collection($quotes);

		return response()->json($quotesCollection);
	}

	public function store(QuoteStoreQuoteRequest $request)
	{
		$quote = Quote::create($request->validated());
		$quote->setTranslations('name', ['en' => $request->name_en, 'ka' => $request->name_ka]);
		$quote->image = $request->file('image')->store('images');
		$quote->save();

		$newQuote = Quote::where('id', $quote->id)->first();

		return response()->json(new QuoteResource($newQuote));
	}

	public function destroy(Quote $quote)
	{
		$this->authorize('delete', $quote);

		$quote->delete();

		return response()->json(['response'=> 'Successfully Deleted']);
	}

	public function update($id, QuoteUpdateQuoteRequest $request)
	{
		$request->validated();
		$quote = Quote::findOrFail($id);
		$this->authorize('update', $quote);
		$quote->setTranslations('name', ['en' => $request->name_en, 'ka' => $request->name_ka]);
		if ($request->file('image')) {
			$quote->image = $request->file('image')->store('images');
		}
		$quote->update();

		return new QuoteResource($quote);
	}
}

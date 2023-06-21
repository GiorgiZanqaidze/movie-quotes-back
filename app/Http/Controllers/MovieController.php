<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
	public function movies()
	{
		$user = Auth::user();

		$movies = MovieResource::collection($user->movies);

		return response()->json(['data'=> $movies]);
	}

	public function movie($id)
	{
		$movie = Movie::findOrFail($id);

		return new MovieResource($movie);
	}

	public function store(StoreMovieRequest $request)
	{
		$movie = Movie::create($request->validated());
		$movie->setTranslations('title', ['en' => $request->title_en, 'ka' => $request->title_ka]);
		$movie->setTranslations('description', ['en' => $request->description_en, 'ka' => $request->description_ka]);
		$movie->setTranslations('director', ['en' => $request->director_en, 'ka' => $request->director_ka]);
		$movie->image = $request->file('image')->store('images');
		$movie->save();

		return response()->json($request->validated());
	}
}

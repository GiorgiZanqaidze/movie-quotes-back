<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
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

	public function destroy(Movie $movie)
	{
		$movie->delete();

		return response()->json(['msg'=> 'Movie deleted successfully']);
	}

	public function store(StoreMovieRequest $request)
	{
		$movie = Movie::create($request->validated());
		$movie->setTranslations('title', ['en' => $request->title_en, 'ka' => $request->title_ka]);
		$movie->setTranslations('description', ['en' => $request->description_en, 'ka' => $request->description_ka]);
		$movie->setTranslations('director', ['en' => $request->director_en, 'ka' => $request->director_ka]);
		$movie->image = $request->file('image')->store('images');

		$genres = explode(',', $request->validated(['genres']));

		$movie->genres()->attach($genres);
		$movie->save();

		return response()->json($movie, 200);
	}

	public function update(Movie $movie, UpdateMovieRequest $request)
	{
		$movie->setTranslations('title', ['en' => $request->title_en, 'ka' => $request->title_ka]);
		$movie->setTranslations('description', ['en' => $request->description_en, 'ka' => $request->description_ka]);
		$movie->setTranslations('director', ['en' => $request->director_en, 'ka' => $request->director_ka]);

		if ($request->file('image')) {
			$movie->image = $request->file('image')->store('images');
		}

		$genres = explode(',', $request->validated(['genres']));
		$uniqueGenres = array_unique($genres);

		$movie->genres()->sync($uniqueGenres);

		$movie->update();

		return response()->json($genres);
	}
}

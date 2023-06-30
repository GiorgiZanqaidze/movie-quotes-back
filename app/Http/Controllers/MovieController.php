<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
	public function movies(Request $request): JsonResponse
	{
		$searchQuery = $request->input('query');
		$user = Auth::user();

		$movies = $user->movies;

		if ($searchQuery && $searchQuery !== 'undefined') {
			$movies = Movie::where(function ($query) use ($searchQuery) {
				$query->where('title->en', 'like', '%' . $searchQuery . '%')
					->orWhere('title->ka', 'like', '%' . $searchQuery . '%');
			})
			->get();
		} else {
			$movies = $user->movies;
		}

		$movieCollection = MovieResource::collection($movies);

		return response()->json(['data'=> $movieCollection]);
	}

	public function movie($id)
	{
		$movie = Movie::findOrFail($id);

		return new MovieResource($movie);
	}

	public function destroy(Movie $movie): JsonResponse
	{
		$movie->delete();

		return response()->json(['msg'=> 'Movie deleted successfully']);
	}

	public function store(StoreMovieRequest $request): JsonResponse
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

	public function update(Movie $movie, UpdateMovieRequest $request): JsonResponse
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

		return response()->json($movie, 200);
	}
}

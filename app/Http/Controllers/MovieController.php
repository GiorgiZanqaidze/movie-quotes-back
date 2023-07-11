<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movie\StoreMovieRequest;
use App\Http\Requests\Movie\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
	public function allMovies()
	{
		$movies = Movie::all();

		$movieCollection = MovieResource::collection($movies);

		return response()->json(['data'=> $movieCollection]);
	}

	public function index(): JsonResponse
	{
		$user = Auth::user();

		$movies = $user->movies;

		$movieCollection = MovieResource::collection($movies);

		return response()->json(['data'=> $movieCollection]);
	}

	public function get(Movie $movie)
	{
		return new MovieResource($movie);
	}

	public function destroy(Movie $movie): JsonResponse
	{
		$this->authorize('delete', $movie);

		$storagePath = 'images/';
		Storage::delete($storagePath, $movie->image);

		$movie->delete();

		return response()->json(['msg'=> 'image deleted']);
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

		if ($request->hasFile('image')) {
			$newImage = $request->file('image')->store('images');

			if ($movie->image && $movie->image !== $newImage) {
				Storage::delete('images/' . $movie->image);
			}
			$movie->image = $newImage;
		}

		$genres = explode(',', $request->validated(['genres']));

		$uniqueGenres = array_unique($genres);

		$movie->genres()->sync($uniqueGenres);

		$movie->update();

		$movieResources = new MovieResource($movie->load('quotes'));

		return response()->json($movieResources, 200);
	}
}

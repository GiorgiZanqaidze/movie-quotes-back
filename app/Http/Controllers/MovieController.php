<?php

namespace App\Http\Controllers;

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
}

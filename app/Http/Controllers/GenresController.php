<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreResource;
use App\Models\Genre;

class GenresController extends Controller
{
	public function index()
	{
		$genres = Genre::all();

		$genresCollection = GenreResource::collection($genres);

		return response()->json($genresCollection);
	}
}

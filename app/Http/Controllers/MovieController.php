<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class MovieController extends Controller
{
	public function movies()
	{
		$movies = Movie::get();

		return response()->json(['data'=> $movies]);
	}
}

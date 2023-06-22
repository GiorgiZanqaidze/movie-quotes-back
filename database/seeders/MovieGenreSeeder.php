<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieGenreSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$movies = Movie::all();
		$genres = Genre::all();

		$movies->each(function ($movie) use ($genres) {
			$randomGenre = $genres->random();
			$movie->genres()->attach($randomGenre);
		});
	}
}

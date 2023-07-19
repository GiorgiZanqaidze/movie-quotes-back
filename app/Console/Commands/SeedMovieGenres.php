<?php

namespace App\Console\Commands;

use App\Models\Genre;
use Illuminate\Console\Command;

class SeedMovieGenres extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'seed-movie-genres';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = ' This command automates the process of populating the genres table with pre-defined movie genres and their translations in English and Georgian languages.';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$genres = [
			'melodramatic'=> [
				'en' => 'Melodramatic',
				'ka' => 'მელოდრამა',
			],
			'comedy' => [
				'en' => 'Comedy',
				'ka' => 'კომედია',
			],
			'drama'=> [
				'en' => 'Drama',
				'ka' => 'დრამა',
			],
		];

		foreach ($genres as $genreKey => $genre) {
			Genre::create([
				'name' => [
					'en' => $genre['en'],
					'ka' => $genre['ka'],
				],
			]);
		}
	}
}

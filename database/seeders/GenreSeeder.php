<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$genres = [
			'action'=> [
				'en' => 'Action',
				'ka' => 'მძაფრ სიუჟეტიანი',
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
			Genre::factory()->create([
				'name' => json_encode($genre),
			]);
		}
	}
}

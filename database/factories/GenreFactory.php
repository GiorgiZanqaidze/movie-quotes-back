<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
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

		return [
			'name' => [
				'en' => 'Drama',
				'ka' => 'დრამა',
			],
		];
	}
}

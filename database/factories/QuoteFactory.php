<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quote>
 */
class QuoteFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'name' => [
				'en' => $this->faker->sentence(),
				'ka' => $this->faker->sentence(),
			],
			'image'             => function () {
				$storagePath = public_path('storage/images');
				$files = glob($storagePath . '/*.*');
				$randomFile = array_rand($files);
				$imagePath = explode('storage/', $files[$randomFile])[1];
				return $imagePath;
			},
			'movie_id'    => Movie::factory(),
			'user_id'     => User::factory(),
		];
	}
}

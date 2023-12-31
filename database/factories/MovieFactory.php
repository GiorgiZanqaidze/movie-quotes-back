<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'title'       => [
				'en' => $this->faker->sentence(),
				'ka' => $this->faker->sentence(),
			],
			'year'        => $this->faker->date('Y'),
			'director'    => [
				'en' => $this->faker->name(),
				'ka' => $this->faker->name(),
			],
			'description' => [
				'en' => $this->faker->text(),
				'ka' => $this->faker->text(),
			],
			'user_id'           => User::factory(),
			'image'             => function () {
				$storagePath = public_path('storage/images');
				$files = glob($storagePath . '/*.*');
				$randomFile = array_rand($files);
				$imagePath = explode('storage/', $files[$randomFile])[1];
				return $imagePath;
			},
		];
	}
}

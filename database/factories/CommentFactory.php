<?php

namespace Database\Factories;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'text'     => $this->faker->text(),
			'quote_id' => Quote::factory(),
		];
	}
}

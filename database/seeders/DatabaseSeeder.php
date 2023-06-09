<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Quote;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		// \App\Models\User::factory(10)->create();

		// \App\Models\User::factory()->create([
		//     'name' => 'Test User',
		//     'email' => 'test@example.com',
		// ]);

		// \App\Models\Movie::factory(10)->create();

		// \App\Models\Quote::factory(2)->create();

		// \App\Models\Like::factory(20)->create();

		$quotecount = 5; // Number of posts to create
		$commentCount = 3; // Number of comments per post

		Quote::factory($quotecount)->create()->each(function ($quote) use ($commentCount) {
			Comment::factory($commentCount)->create([
				'quote_id' => $quote->id,
			]);

			$likes = 4;
			Like::factory($likes)->create([
				'quote_id' => $quote->id,
			]);
		});
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quote extends Model
{
	use HasFactory;

	use HasTranslations;

	protected $fillable = ['name', 'movie_id', 'image', 'user_id'];

	protected $with = ['movie', 'comments.author', 'author', 'likes.author'];

	public $translatable = ['name'];

	public function movie()
	{
		return $this->belongsTo(Movie::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	public function likes()
	{
		return $this->hasMany(Like::class);
	}

	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}

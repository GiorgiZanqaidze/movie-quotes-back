<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Movie extends Model
{
	use HasFactory;

	use HasTranslations;

	protected $fillable = ['title', 'director', 'description', 'year', 'user_id'];

	public $translatable = ['title', 'director', 'description'];

	public function quotes()
	{
		return $this->hasMany(Quote::class);
	}

	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function genres()
	{
		return $this->belongsToMany(Genre::class);
	}
}

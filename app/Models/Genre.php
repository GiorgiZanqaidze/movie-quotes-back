<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Genre extends Model
{
	use HasFactory;

	use HasTranslations;

	public $translatable = ['name'];

	protected $fillable = ['name'];

	public function movies()
	{
		return $this->belongsToMany(Movie::class);
	}
}

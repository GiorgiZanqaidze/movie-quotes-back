<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
	use HasApiTokens;

	use HasFactory;

	use Notifiable;

	protected $with = ['likes', 'receivedNotifications'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'google_id',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'password'          => 'hashed',
	];

	public function movies()
	{
		return $this->hasMany(Movie::class);
	}

	public function quotes()
	{
		return $this->hasMany(Quote::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	public function likes()
	{
		return $this->hasMany(Like::class);
	}

	public function sentNotifications()
	{
		return $this->hasMany(Notification::class, 'sender_id');
	}

	public function receivedNotifications()
	{
		return $this->hasMany(Notification::class, 'receiver_id');
	}
}

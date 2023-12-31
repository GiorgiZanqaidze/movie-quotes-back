<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;

class GoogleController extends Controller
{
	public function loginWithGoogle()
	{
		$redirectUrl = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();

		return response()->json(['url' => $redirectUrl]);
	}

	public function callbackFromGoogle()
	{
		$googleUser = Socialite::driver('google')->stateless()->user();

		$user = User::updateOrCreate([
			'google_id'                       => $googleUser->id,
		], [
			'name'                            => $googleUser->name,
			'email'                           => $googleUser->email,
			'google_token'                    => $googleUser->token,
			'google_refresh_token'            => $googleUser->refreshToken,
		]);
		$avatarUrl = $googleUser->avatar;
		$imageContents = file_get_contents($avatarUrl);

		$storagePath = 'images/' . $googleUser->getId() . '.jpg';
		Storage::put($storagePath, $imageContents);

		$user->image = $storagePath;

		$user->email_verified_at = now();
		$user->update();

		Auth::login($user);

		return redirect(env('FRONT_END_URL') . '/news-feed');
	}
}

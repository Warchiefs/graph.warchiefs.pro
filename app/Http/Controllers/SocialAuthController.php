<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;

class SocialAuthController extends Controller
{
	/**
	 * Переадресация на социальную авторизацию
	 *
	 * @param $provider
	 *
	 * @return mixed
	 */
	public function redirect($provider)
	{
		return Socialite::driver($provider)->redirect();
	}

	/**
	 * Регистрация\авторизация пользователя через социальную авторизацию.
	 * На этот метод клиент перенаправляется
	 * после совершения действия на странице социальной сети
	 *
	 * @param Request              $request
	 * @param SocialAccountService $service
	 * @param                      $provider
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function callback(Request $request, SocialAccountService $service, $provider)
	{
		if($request->has('error')) {
			return redirect('/login')->with('error', $request->get('error_description'));
		}
		$user = $service->createOrGetUser(Socialite::driver($provider)->user());

		auth()->login($user);

		return redirect()->to('/home');
	}
}
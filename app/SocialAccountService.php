<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
	/**
	 * Осуществляет получение\создание пользователя по социальным данным
	 *
	 * @param ProviderUser $providerUser
	 *
	 * @return mixed
	 */
	public function createOrGetUser(ProviderUser $providerUser)
	{
		$account = SocialAccount::whereProvider('facebook')
			->whereProviderUserId($providerUser->getId())
			->first();

		if ($account) {
			return $account->user;
		} else {

			$account = new SocialAccount([
				'provider_user_id' => $providerUser->getId(),
				'provider' => 'facebook'
			]);

			$user = User::whereEmail($providerUser->getEmail())->first();

			if (!$user) {

				$user = User::create([
					'email' => $providerUser->getEmail(),
					'name' => $providerUser->getName(),
					'api_token' => str_random(60)
				]);
			}

			$account->user()->associate($user);
			$account->save();

			return $user;

		}

	}
}
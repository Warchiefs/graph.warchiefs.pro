<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
	    'client_id' => '1892851830929706',
	    'client_secret' => 'c1c3bd9c0ac66e1b280d6aa0f5115f03',
	    'redirect' =>  env('APP_URL').('/callback/facebook'),
    ],

	'google' => [
		'client_id' => '909520607060-c34nq644f6bms748gleqpi2oosa7ptb1.apps.googleusercontent.com',
		'client_secret' => 'k-oy9U9ImDt7umxx2aTyDu08',
		'redirect' =>  env('APP_URL').'/callback/google',
	],
    'vkontakte' => [
	    'client_id' => '5995470',
	    'client_secret' => 'I56atPHMLfkWdJq6kZWz',
	    'redirect' =>  env('APP_URL').'/callback/vkontakte',
    ],
    'yandex' => [
	    'client_id' => '78d850f6d79a4329b34ff95e2398d6f0',
	    'client_secret' => '0368ce6947c9455e96b2655854ea7d1e',
	    'redirect' => env('APP_URL').'/callback/yandex',
    ],

];

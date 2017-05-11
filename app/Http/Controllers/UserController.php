<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Поиск пользователей по строке поиска.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function find_users(Request $request)
	{
		if($request->has('string')) {

			$string = $request->get('string');

			return response()->json([
				'success' => true,
				'users' => User::where('name', 'LIKE', "%$string%")->orWhere('email', 'LIKE', "%$string%")->get()
			]);
		} else {
			return response()->json([
				'success' => true,
				'users' => User::all()
			]);
		}
	}
}

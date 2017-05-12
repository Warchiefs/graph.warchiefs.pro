<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Workspace;
use App\User;


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
	 * Возвращает пользователей из базы
	 * по частичному совпадению имени или email
	 * со строкой поиска - string
	 * (LIKE %string%)
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
	public function find_users(Request $request)
	{
		if($request->has('string')) {

			$string = $request->get('string');
			$users = User::where('name', 'LIKE', "%$string%")->orWhere('email', 'LIKE', "%$string%")->get();
			return [true, $users];
		} else {
			return [true, User::all()];
		}
	}

	/**
	 * Добавление пользователя к пространству с установкой права доступа.
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
	public function add_permission(Request $request)
	{
		Validator::make($request->all(),
			[
				'workspace_id' => 'bail|required|valid_workspace|can_add_permission',
				'user_id' => 'bail|required|has_not_permission',
				'permission' => 'bail|required|valid_permission'
			],
			[
				'workspace_id.required' => 'Не указано ID пространства',
				'workspace_id.valid_workspace' => 'Недопустимое пространство',
				'workspace_id.can_add_permission' => 'Недостаточно прав для совершения этого действия',
				'user_id.required' => 'Не передан ID пользователя',
				'user_id.has_not_permission' => 'Пользователь уже имеет привилегии в этом пространстве',
				'permission.required' => 'Не передан ключ привилегии',
				'permission.valid_permission' => 'Неверный ключ привилегии. (доступные ключи: 0, 1, 2)',
			])
			->validate();

		$workspace = Workspace::find($request->get('workspace_id'));

		$workspace->users()->attach($request->get('user_id'), ['permissions' => $request->get('permission')]);

		return [true, 'Привилегии для пользователя добавлены'];

	}

	/**
	 * Изменение привилегий пользователя для пространства
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
	public function edit_permission(Request $request)
	{
		Validator::make($request->all(),
			[
				'workspace_id' => 'bail|required|valid_workspace|can_edit_permission',
				'user_id' => 'bail|required|has_permission',
				'permission' => 'bail|required|valid_permission'
			],
			[
				'workspace_id.required' => 'Не указано ID пространства',
				'workspace_id.valid_workspace' => 'Недопустимое пространство',
				'workspace_id.can_edit_permission' => 'Недостаточно прав для совершения этого действия',
				'user_id.required' => 'Не передан ID пользователя',
				'user_id.has_permission' => 'Пользователь не имеет привилегии в этом пространстве',
				'permission.required' => 'Не передан ключ привилегии',
				'permission.valid_permission' => 'Неверный ключ привилегии. (доступные ключи: 0, 1, 2)'
			])
			->validate();

		$workspace = Workspace::find($request->get('workspace_id'));

		$workspace->users()->detach($request->get('user_id'));
		$workspace->users()->attach($request->get('user_id'), ['permissions' => $request->get('permission')]);

		return [true, 'Привилегии для пользователя изменены'];
	}

	/**
	 * Удаление пользователя с видимости пространства
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
	public function delete_permission(Request $request)
	{
		Validator::make($request->all(),
			[
				'workspace_id' => 'bail|required|valid_workspace|can_delete_permission',
				'user_id' => 'bail|required|has_permission'
			],
			[
				'workspace_id.required' => 'Не указано ID пространства',
				'workspace_id.valid_workspace' => 'Недопустимое пространство',
				'workspace_id.can_delete_permission' => 'Недостаточно прав для совершения этого действия',
				'user_id.required' => 'Не передан ID пользователя',
				'user_id.has_permission' => 'Пользователь не имеет каких-либо привилегий в этом пространстве'
			])
			->validate();

		$workspace = Workspace::find($request->get('workspace_id'));

		$workspace->users()->detach($request->get('user_id'));

		return [true, 'Привилегии для пользователя удалены'];
	}
}

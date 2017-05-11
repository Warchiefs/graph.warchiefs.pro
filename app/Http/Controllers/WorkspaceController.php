<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Workspace;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
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
	 * Страница с пространствами
	 * Зарезервирован под дальнейшие расширения
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index()
    {
	    return view('workspaces');
    }

	/**
	 * Создание пространства
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function create(Request $request)
    {
	    Validator::make($request->all(),
		    [
		        'name' => 'required',
		        'color' => 'required',
	        ],
		    [
		    	'name.required' => 'Не указано имя',
			    'color.required' => 'Не указан цвет'
		    ])->validate();

	    $params['name'] = $request->get('name');
	    $params['color'] = $request->get('color');
	    $params['own'] = Auth::user()->id;

	    $workspace = Workspace::create($params);

	    if($request->has('users')) {
	    	$users = json_decode($request->get('users'), 1);

		    foreach ($users as $user_id => $permissions)
		    {
		    	$workspace->users()->attach($user_id, ['permissions' => $permissions]);
		    }
	    }

	    return response()->json([
		    'success' => true,
		    'workspace' => $workspace
	    ]);

    }

	/**
	 * Редактирование пространства
	 *
	 * @param Request $request
	 *
	 * @return mixed
	 */
    public function edit(Request $request)
    {
	    Validator::make($request->all(),
			        [
			        'workspace_id' => 'required|valid_workspace|can_edit_workspace'
			    ],
			    [
			        'workspace_id.required' => 'Не указано ID пространства',
				    'workspace_id.valid_workspace' => 'Недопустимое пространство',
				    'workspace_id.can_edit_workspace' => 'Вы не можете редактировать это пространство',

			    ])
		    ->validate();


	    $workspace = Workspace::find($request->get('workspace_id'));


	    if($request->has('name')) {
	    	$workspace->name = $request->get('name');
	    }

	    if($request->has('color')) {
	    	$workspace->color = $request->get('color');
	    }

	    $workspace->save();

	    return $workspace;
    }

	/**
	 * Удаление пространства
	 *
	 * @param Request $request
	 *
	 * @return bool
	 */
    public function delete(Request $request)
    {
	    Validator::make($request->all(),
		    [
			    'workspace_id' => 'required|valid_workspace|can_delete_workspace'
		    ],
		    [
			    'workspace_id.required' => 'Не указано ID пространства',
			    'workspace_id.valid_workspace' => 'Недопустимое пространство',
			    'workspace_id.can_edit_workspace' => 'Вы не можете редактировать это пространство',

		    ])
		    ->validate();

	    $workspace = Workspace::find($request->get('workspace_id'));

	    unset($workspace);

	    Workspace::find($request->get('workspace_id'))->delete();

	    return true;
    }

	/**
	 * Добавление пользователя к пространству с установкой права доступа.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function add_permission(Request $request)
    {
	    Validator::make($request->all(),
		    [
			    'workspace_id' => 'required|valid_workspace|can_add_permission',
			    'user_id' => 'required',
			    'permission' => 'required|valid_permission'
		    ],
		    [
			    'workspace_id.required' => 'Не указано ID пространства',
			    'workspace_id.valid_workspace' => 'Недопустимое пространство',
			    'workspace_id.can_add_permission' => 'Недостаточно прав для совершения этого действия',
			    'user_id.required' => 'Не передан ID пользователя',
			    'permission.required' => 'Не передан ключ привилегии',
			    'permission.valid_permission' => 'Неверный ключ привилегии. (доступные ключи: 0, 1, 2)'

		    ])
		    ->validate();

	    $workspace = Workspace::find($request->get('workspace_id'));

	    $workspace->users->attach($request->get('user_id'), ['permissions' => $request->get('permission')]);

	    return response()->json([
		    'success' => true
	    ]);

    }

	/**
	 * Удаление пользователя с видимости пространства
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function delete_permission(Request $request)
	{
		Validator::make($request->all(),
			[
				'workspace_id' => 'required|valid_workspace|can_delete_permission',
				'user_id' => 'required',
				'permission' => 'required|valid_permission'
			],
			[
				'workspace_id.required' => 'Не указано ID пространства',
				'workspace_id.valid_workspace' => 'Недопустимое пространство',
				'workspace_id.can_delete_permission' => 'Недостаточно прав для совершения этого действия',
				'user_id.required' => 'Не передан ID пользователя',
				'permission.required' => 'Не передан ключ привилегии',
				'permission.valid_permission' => 'Неверный ключ привилегии. (доступные ключи: 0, 1, 2)'

			])
			->validate();

		$workspace = Workspace::find($request->get('workspace_id'));

		$workspace->users->detach($request->get('user_id'));

		return response()->json([
			'success' => true
		]);
	}
}

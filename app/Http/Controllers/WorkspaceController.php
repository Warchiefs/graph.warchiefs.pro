<?php

namespace App\Http\Controllers;

use App\Graph;
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
    	dd((new Graph())->getNodesWithRelsForWorkspace(11));
	    return view('workspaces');
    }

	/**
	 * Создание пространства
	 *
	 * @param Request $request
	 *
	 * @return array
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

	    return [true, 'Пространство создано', $workspace];

    }

	/**
	 * Редактирование пространства
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
    public function edit(Request $request)
    {
	    Validator::make($request->all(),
			        [
			        'workspace_id' => 'bail|required|valid_workspace|can_edit_workspace'
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

	    return [true, 'Пространство изменено', $workspace];
    }

	/**
	 * Удаление пространства
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
    public function delete(Request $request)
    {
	    Validator::make($request->all(),
		    [
			    'workspace_id' => 'bail|required|valid_workspace|can_delete_workspace'
		    ],
		    [
			    'workspace_id.required' => 'Не указано ID пространства',
			    'workspace_id.valid_workspace' => 'Недопустимое пространство',
			    'workspace_id.can_delete_workspace' => 'Вы не можете редактировать это пространство',

		    ])
		    ->validate();

	    $workspace = Workspace::find($request->get('workspace_id'));

	    unset($workspace);

	    // Удаляет все Node этого пространства
	    (new Graph())->deleteNodesForWorkspace($request->get('workspace_id'));

	    Workspace::find($request->get('workspace_id'))->delete();

	    return [true, 'Пространство удалено'];
    }
}

<?php

namespace App\Http\Controllers;

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

    public function index()
    {
	    return view('workspaces');
    }

    public function create(Request $request)
    {
    	if(!$request->has('name')) {
    		return response()->json([
    			'success' => false,
			    'error_code' => 0,
			    'error' => 'Не указано имя'
		    ]);
	    }

	    if(!$request->has('color')) {
		    return response()->json([
			    'success' => false,
			    'error_code' => 1,
			    'error' => 'Не указан цвет'
		    ]);
	    }

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

    public function edit(Request $request)
    {
    	if(!$request->has('workspace_id')) {
		    return response()->json([
			    'success' => false,
			    'error_code' => 0,
			    'error' => 'Не указан ID пространства'
		    ]);
	    }

	    if((new Workspace())->check_permissions($request->get('workspace_id'), 'edit')) {
		    return response()->json([
			    'success' => false,
			    'error_code' => 1,
			    'error' => 'Не достаточно прав для совершения данного действия'
		    ]);
	    }

	    $workspace = Workspace::find($request->get('workspace_id'));


	    if(!$workspace) {
		    return response()->json([
			    'success' => false,
			    'error_code' => 2,
			    'error' => 'Пространство не найдено'
		    ]);
	    }

	    if($request->has('name')) {
	    	$workspace->name = $request->get('name');
	    }

	    if($request->has('color')) {
	    	$workspace->color = $request->get('color');
	    }

	    $workspace->save();

	    return response()->json([
		    'success' => true,
		    'workspace' => $workspace
	    ]);
    }

    public function delete(Request $request)
    {
	    if(!$request->has('workspace_id')) {
		    return response()->json([
			    'success' => false,
			    'error_code' => 0,
			    'error' => 'Не указан ID пространства'
		    ]);
	    }

	    if((new Workspace())->check_permissions($request->get('workspace_id'), 'edit')) {
		    return response()->json([
			    'success' => false,
			    'error_code' => 1,
			    'error' => 'Не достаточно прав для совершения данного действия'
		    ]);
	    }

	    $workspace = Workspace::find($request->get('workspace_id'));


	    if(!$workspace) {
		    return response()->json([
			    'success' => false,
			    'error_code' => 2,
			    'error' => 'Пространство не найдено'
		    ]);
	    }

	    unset($workspace);

	    Workspace::find($request->get('workspace_id'))->delete();

	    return response()->json([
		    'success' => true
	    ]);


    }

    public function add_permission(Request $request)
    {
	    if(!$request->has('workspace_id')) {
		    return response()->json([
			    'success' => false,
			    'error_code' => 0,
			    'error' => 'Не указан ID пространства'
		    ]);
	    }

	    if((new Workspace())->check_permissions($request->get('workspace_id'), 'edit')) {
		    return response()->json([
			    'success' => false,
			    'error_code' => 1,
			    'error' => 'Не достаточно прав для совершения данного действия'
		    ]);
	    }

	    $workspace = Workspace::find($request->get('workspace_id'));


	    if(!$workspace) {
		    return response()->json([
			    'success' => false,
			    'error_code' => 2,
			    'error' => 'Пространство не найдено'
		    ]);
	    }

	    if(!$request->has('user_id')) {
		    return response()->json([
			    'success' => false,
			    'error_code' => 3,
			    'error' => 'Не передан ID пользователя'
		    ]);
	    }

	    if(!$request->has('permission')
		    || $request->get('permission') != 0
		    || $request->get('permission') != 1
		    || $request->get('permission') != 2
	    ) {
		    return response()->json([
			    'success' => false,
			    'error_code' => 4,
			    'error' => 'Неверные права'
		    ]);
	    }

	    $workspace->users->attach($request->get('user_id'), ['permissions' => $request->get('permission')]);

	    return response()->json([
		    'success' => true
	    ]);

    }

	public function delete_permission(Request $request)
	{
		if(!$request->has('workspace_id')) {
			return response()->json([
				'success' => false,
				'error_code' => 0,
				'error' => 'Не указан ID пространства'
			]);
		}

		if((new Workspace())->check_permissions($request->get('workspace_id'), 'edit')) {
			return response()->json([
				'success' => false,
				'error_code' => 1,
				'error' => 'Не достаточно прав для совершения данного действия'
			]);
		}

		$workspace = Workspace::find($request->get('workspace_id'));


		if(!$workspace) {
			return response()->json([
				'success' => false,
				'error_code' => 2,
				'error' => 'Пространство не найдено'
			]);
		}

		if(!$request->has('user_id')) {
			return response()->json([
				'success' => false,
				'error_code' => 3,
				'error' => 'Не передан ID пользователя'
			]);
		}

		$workspace->users->detach($request->get('user_id'));

		return response()->json([
			'success' => true
		]);
	}

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

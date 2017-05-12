<?php

namespace App\Http\Controllers;

use App\Graph;
use Illuminate\Http\Request;
use Validator;

class GraphController extends Controller
{
	/**
	 * Получение всех вершин и связей для пространства
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
	public function get(Request $request)
	{
		Validator::make($request->all(),
			[
				'workspace_id' => 'bail|required|valid_workspace|can_read_workspace'
			],
			[
				'workspace_id.required' => 'Не указано ID пространства',
				'workspace_id.valid_workspace' => 'Недопустимое пространство',
				'workspace_id.can_read_workspace' => 'Вы не можете редактировать это пространство',

			])
			->validate();

		$get_array = (new Graph())->getNodesWithRelsForWorkspace($request->get('workspace_id'));

		return [true, $get_array];
	}

	/**
	 * Добавление вершины
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
	public function node_add(Request $request)
	{
		Validator::make($request->all(),
			[
				'workspace_id' => 'bail|required|valid_workspace|can_edit_workspace',
				'node_params' => 'bail|required|json'
			],
			[
				'workspace_id.required' => 'Не указано ID пространства',
				'workspace_id.valid_workspace' => 'Недопустимое пространство',
				'workspace_id.can_edit_workspace' => 'Вы не можете редактировать это пространство',
				'node_params.required' => 'Укажите параметры для вершины',
				'node_params.json' => 'Параметры вершины должны быть переданы в формате json',

			])
			->validate();

		$node = (new Graph())->makeNode($request->get('workspace_id'), json_decode($request->get('node_params'), 1));

		return [true, 'Вершина добавлена', $node];
	}

	/**
	 * Редактирование вершины
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
	public function node_edit(Request $request)
	{
		Validator::make($request->all(),
			[
				'workspace_id' => 'bail|required|valid_workspace|can_edit_workspace',
				'node_id' => 'bail|required',
				'node_params' => 'bail|required|json'
			],
			[
				'workspace_id.required' => 'Не указано ID пространства',
				'workspace_id.valid_workspace' => 'Недопустимое пространство',
				'workspace_id.can_edit_workspace' => 'Вы не можете редактировать это пространство',
				'node_id.required' => 'Укажите ID вершины',
				'node_params.required' => 'Укажите параметры для вершины',
				'node_params.json' => 'Параметры вершины должны быть переданы в формате json',

			])
			->validate();

		$node = (new Graph())->editNode($request->get('node_id'), json_decode($request->get('node_params'), 1));

		return [true, 'Вершина изменена', $node];
	}

	/**
	 * Удаление вершины
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
	public function node_delete(Request $request)
	{
		Validator::make($request->all(),
			[
				'workspace_id' => 'bail|required|valid_workspace|can_edit_workspace',
				'node_id' => 'bail|required'
			],
			[
				'workspace_id.required' => 'Не указано ID пространства',
				'workspace_id.valid_workspace' => 'Недопустимое пространство',
				'workspace_id.can_edit_workspace' => 'Вы не можете редактировать это пространство',
				'node_id.required' => 'Укажите ID вершины'
			])
			->validate();

		(new Graph())->deleteNode($request->get('node_id'));

		return [true, 'Вершина удалена'];
	}

	/**
	 * Добавление связи
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
	public function relationship_add(Request $request)
	{
		Validator::make($request->all(),
			[
				'workspace_id' => 'bail|required|valid_workspace|can_edit_workspace',
				'start_node_id' => 'required',
				'end_node_id' => 'required',
				'type' => 'required|string',
				'params' => 'bail|json'
			],
			[
				'workspace_id.required' => 'Не указано ID пространства',
				'workspace_id.valid_workspace' => 'Недопустимое пространство',
				'workspace_id.can_edit_workspace' => 'Вы не можете редактировать это пространство',
				'start_node_id.required' => 'Укажите ID начальной вершины',
				'end_node_id.required' => 'Укажите ID конечной вершины',
				'type.required' => 'Укажите тип связи',
				'type.string' => 'Тип связи должен быть строкой',
				'params.json' => 'Параметры связи должны быть переданы в формате json'
			])
			->validate();

		$rel = (new Graph())->makeRelationship(
			$request->get('start_node_id'),
			$request->get('end_node_id'),
			$request->get('type'),
			($request->has('params')) ? json_decode($request->get('params'), 1) : []
		);


		return [true, 'Связь добавлена', $rel];
	}

	/**
	 * Редактирование связи
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
	public function relationship_edit(Request $request)
	{
		Validator::make($request->all(),
			[
				'workspace_id' => 'bail|required|valid_workspace|can_edit_workspace',
				'rel_id' => 'required',
				'type' => 'string',
				'params' => 'bail|json'
			],
			[
				'workspace_id.required' => 'Не указано ID пространства',
				'workspace_id.valid_workspace' => 'Недопустимое пространство',
				'workspace_id.can_edit_workspace' => 'Вы не можете редактировать это пространство',
				'rel_id.required' => 'Укажите ID связи',
				'type.string' => 'Тип связи должен быть строкой',
				'params.json' => 'Параметры связи должны быть переданы в формате json'
			])
			->validate();

		$rel = (new Graph())->editRelationship(
			$request->get('rel_id'),
			$request->get('type'),
			($request->has('params')) ? json_decode($request->get('params'), 1) : []
		);

		return [true, 'Связь отредактирована', $rel];
	}

	/**
	 * Удаление связи
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
	public function relationship_delete(Request $request)
	{
		Validator::make($request->all(),
			[
				'workspace_id' => 'bail|required|valid_workspace|can_edit_workspace',
				'rel_id' => 'required'
			],
			[
				'workspace_id.required' => 'Не указано ID пространства',
				'workspace_id.valid_workspace' => 'Недопустимое пространство',
				'workspace_id.can_edit_workspace' => 'Вы не можете редактировать это пространство',
				'rel_id.required' => 'Укажите ID связи'
			])
			->validate();

		(new Graph())->deleteRelationship($request->get('rel_id'));

		return [true, 'Связь удалена'];
	}
}

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Routes для работы с пространствами
 */
Route::post('/workspace/create', 'WorkspaceController@create');
Route::post('/workspace/edit', 'WorkspaceController@edit');
Route::post('/workspace/delete', 'WorkspaceController@delete');

/**
 * Routes для работы с привилегиями
 */
Route::post('/permissions/add', 'UserController@add_permission');
Route::post('/permissions/edit', 'UserController@edit_permission');
Route::post('/permissions/delete', 'UserController@delete_permission');

/**
 * Routes для работы с пользователями
 */
Route::post('/users/find', 'UserController@find_users');

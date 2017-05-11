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


Route::post('/workspace/create', 'WorkspaceController@create');
Route::post('/workspace/edit', 'WorkspaceController@edit');
Route::post('/workspace/delete', 'WorkspaceController@delete');
Route::post('/workspace/add_permission', 'WorkspaceController@add_permission');
Route::post('/workspace/delete_permission', 'WorkspaceController@delete_permission');
Route::post('/users/find', 'WorkspaceController@find_users');

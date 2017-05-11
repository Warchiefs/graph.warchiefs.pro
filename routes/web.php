<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/redirect/{provider}', 'SocialAuthController@redirect');
Route::get('/callback/{provider}', 'SocialAuthController@callback');

Route::get('/workspaces', 'WorkspaceController@index');

Route::post('/workspace/create', 'WorkspaceController@create');
Route::post('/workspace/edit', 'WorkspaceController@edit');
Route::post('/workspace/delete', 'WorkspaceController@delete');
Route::post('/workspace/add_permission', 'WorkspaceController@add_permission');
Route::post('/workspace/delete_permission', 'WorkspaceController@delete_permission');
Route::post('/users/find', 'WorkspaceController@find_users');

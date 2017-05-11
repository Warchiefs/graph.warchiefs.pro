<?php

namespace App\Providers;

use App\Workspace;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

	    /**
	     * Проверка валидности ID пространства
	     */
	    Validator::extend('valid_workspace', function ($attribute, $workspace_id, $parameters, $validator) {
		   if(!$workspace = Workspace::find($workspace_id)) {
		   	    return false;
		   }
		   return true;
	    });

	    /**
	     * Проверка возможности редактирования пространства
	     */
	    Validator::extend('can_edit_workspace', function ($attribute, $workspace_id, $parameters, $validator) {
		    if(!(new Workspace())->check_permissions($workspace_id, 'edit')) {
		    	return false;
		    }
		    return true;
	    });

	    /**
	     * Проверка возможности удаления пространства
	     */
	    Validator::extend('can_delete_workspace', function ($attribute, $workspace_id, $parameters, $validator) {
		    if(!(new Workspace())->check_permissions($workspace_id, 'delete')) {
			    return false;
		    }
		    return true;
	    });

	    /**
	     * Проверка возможности добавления прав пользователю на пространство
	     */
	    Validator::extend('can_add_permission', function ($attribute, $workspace_id, $parameters, $validator) {
		    if(!(new Workspace())->check_permissions($workspace_id, 'add_permission')) {
			    return false;
		    }
		    return true;
	    });

	    /**
	     * Проверка возможности изменения прав пользователю на пространство
	     */
	    Validator::extend('can_edit_permission', function ($attribute, $workspace_id, $parameters, $validator) {
		    if(!(new Workspace())->check_permissions($workspace_id, 'edit_permission')) {
			    return false;
		    }
		    return true;
	    });

	    /**
	     * Проверка возможности удаления прав пользователя на пространство
	     */
	    Validator::extend('can_delete_permission', function ($attribute, $workspace_id, $parameters, $validator) {
		    if(!(new Workspace())->check_permissions($workspace_id, 'delete_permission')) {
			    return false;
		    }
		    return true;
	    });

	    /**
	     * Валидность ключа приивлегий
	     */
	    Validator::extend('valid_permission', function ($attribute, $value, $parameters, $validator) {
		    if ( $value != 0
			    || $value != 1
			    || $value != 2 ) {
			    return false;
		    }
		    return true;
	    });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

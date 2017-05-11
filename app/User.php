<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use App\Workspace;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

	/**
	 * Связь "Один-ко-многим". Пользователь -> пространства
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function workspaces()
	{
		return $this->hasMany('App\Workspace', 'own', 'id');
	}

	/**
	 * Связь "Многое-ко-многим". Пользователи -> расшаренные пространства
	 *
	 * @return $this
	 */
	public function workspaces_shared()
	{
		return $this->belongsToMany('App\Workspace', 'workspace_permissions', 'user_id', 'workspace_id')->withPivot('permissions');
	}

	/**
	 * Возвращает пользователей из базы
	 * по частичному совпадению имени или email
	 * со строкой поиска - string
	 * (LIKE %string%)
	 *
	 * @param $string
	 *
	 * @return mixed
	 */
	public function find($string)
	{
		return User::where('name', 'LIKE', "%$string%")->whereOr('email', 'LIKE', "%$string%")->get();
	}

	/**
	 * Проверка привилегий авторизованного пользователя
	 * на совершение определенного действия с пространством
	 *
	 * @param $workspace_id
	 * @param $action
	 *
	 * @return bool
	 */
	public function check_permissions($workspace_id, $action)
	{
		$workspace = Workspace::find($workspace_id);

		if(!$workspace) {
			return false;
		}

		if($workspace->own == Auth::user()->id) {
			return true;
		}

		$perm = Auth::user()->workspaces_shared()->where('workspace_id', $workspace_id)->first()->pivot->permissions;

		if(!$perm) {
			return false;
		}

		switch ($action) {
			case 'edit':
				return $perm == 1;
				break;
			case 'delete':
				return $perm == 2;
				break;
			case 'edit_permission':
				return $perm == 2;
				break;
			case 'add_permission':
				return $perm == 2;
				break;
			case 'delete_permission':
				return $perm == 2;
				break;
			default:
				return $perm == 2;
				break;
		}
	}
}

<?php

namespace App;

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
		return $this->belongsToMany('App\Workspace', 'workspace_permissions', 'workspace_id', 'user_id')->withPivot('permissions');
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
}

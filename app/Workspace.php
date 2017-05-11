<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    public $table = 'workspace';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'color', 'own'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $guarded = [
		'id'
	];

	public $timestamps = true;

	/**
	 * Одиночная связь Пространство -> Создатель (App\User)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function owner()
	{
		return $this->hasOne('App\User', 'id', 'own');
	}

	/**
	 * Связь "Многое-ко-многим" Пространства -> пользователи с какими либо правами.
	 * Получение привилегии через Pivot таблицу.
	 * Пример использования:
	 *
	 *  foreach(Auth::user()->workspaces_shared as $shared)
	 *		$shared->pivot->permissions
	 *	endforeach;
	 *
	 * @return $this
	 */
	public function users()
	{
		return $this->belongsToMany('App\User', 'workspace_permissions', 'workspace_id', 'user_id')->withPivot('permissions');
	}
}

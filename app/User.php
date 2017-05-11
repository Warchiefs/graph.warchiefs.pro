<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function workspaces()
	{
		return $this->hasMany('App\Workspace', 'own', 'id');
	}

	public function workspaces_shared()
	{
		return $this->belongsToMany('App\Workspace', 'workspace_permissions', 'workspace_id', 'user_id')->withPivot('permissions');
	}

	public function find($string)
	{
		return User::where('name', 'LIKE', "%$string%")->whereOr('email', 'LIKE', "%$string%")->get();
	}
}

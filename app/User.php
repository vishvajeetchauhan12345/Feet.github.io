<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

	use SoftDeletes;
	use Notifiable;
	protected $dates = ['deleted_at'];
	protected $table = "users";
	protected $fillable = [
		'name', 'email', 'password', 'user_type',
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	public function get_detail() {
		return $this->hasOne("App\UserMeta")->withTrashed();
	}

	public function vehicle_detail()
	{
		return $this->hasMany('App\VehicleModel','user_id','id')->withTrashed();
	}

	
}
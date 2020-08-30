<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'name', 'value',
	];
	protected $table = "settings";

	public static function get($key) {

		return Settings::whereName($key)->first()->value;

	}
}

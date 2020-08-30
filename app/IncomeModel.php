<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomeModel extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'vehicle_id', 'user_id', 'amount', 'income_cat', 'mileage', 'date',
	];
	protected $table = "income";

	function category() {
		return $this->hasOne("App\IncCats", "id", "income_cat")->withTrashed();
	}

	function vehicle() {
		return $this->hasOne("App\VehicleModel", "id", "vehicle_id")->withTrashed();
	}
}

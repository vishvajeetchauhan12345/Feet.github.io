<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionModel extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'vehicle_id', 'part_id', 'cost', 'mileage', 'date', 'part_serial', 'user_id', 'qty', 'total',
	];
	protected $table = "part_trans";

	function vehicle() {
		return $this->hasOne("App\VehicleModel", "id", "vehicle_id")->withTrashed();
	}

	function part() {
		return $this->hasOne("App\PartsModel", "id", "part_id")->withTrashed();
	}
}

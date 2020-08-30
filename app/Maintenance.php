<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = "maintenance";
	protected $fillable = [
		'service_id', 'vehicle_id', 'user_id', 'cost', 'receipt', 'delete_reason',
	];

	public function vehicle() {
		return $this->hasOne("App\VehicleModel", "id", "vehicle_id")->withTrashed();
	}
	public function service() {
		return $this->hasOne("App\Services", "id", "service_id")->withTrashed();
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookings extends Model {

	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = "bookings";
	protected $fillable = [
		'customer_id', 'vehicle_id', 'user_id', 'pickup', 'dropoff', 'pickup_addr', 'dest_addr', 'travellers', 'status', 'comment', 'dropoff_time', 'driver_id', 'note',
	];

	function vehicle() {
		return $this->hasOne("App\VehicleModel", "id", "vehicle_id")->withTrashed();
	}
	function customer() {
		return $this->hasOne("App\Customers", "id", "customer_id")->withTrashed();
	}

}

<?php

namespace App\Http\Controllers;
use App\UserMeta;
use App\VehicleModel;

class NotificationController extends Controller {
	public function vehicle_notification($type) {
		$vehicle = VehicleModel::get();
		return view('notifications.vehicle_notification', compact('type', 'vehicle'));
	}

	public function driver_notification($type) {

		$driver = UserMeta::get();
		return view('notifications.driver_notification', compact('type', 'driver'));

	}

}
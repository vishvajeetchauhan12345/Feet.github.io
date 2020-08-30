<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest {

	public function authorize() {
		if (Auth::user()->user_type == "S" || Auth::user()->user_type == "O") {
			return true;
		}
	}

	public function rules() {
		return [
			'customer_id' => 'required',
			'vehicle_id' => 'required',
			'pickup_addr' => 'required',
			'dest_addr' => 'required',
		];
	}
}

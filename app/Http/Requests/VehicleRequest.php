<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest {

	public function authorize() {
		return (Auth::user()->user_type == "S");
	}

	public function rules() {
		return [
			'make' => 'required',
			'model' => 'required',
			'year' => 'required|numeric',
			'engine_type' => 'required',
			'horse_power' => 'integer',
			'color' => 'required',
			// 'exp_date'=>'required',
			'lic_exp_date'=>'required',
			'reg_exp_date'=>'required',
			'license_plate' => 'required|unique:vehicles,license_plate,' . \Request::get("id"),
			'int_mileage' => 'required|alpha_num',
		];
	}
}

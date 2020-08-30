<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class IncomeCatRequest extends FormRequest {
	public function authorize() {
		return (Auth::user()->user_type == "S");
	}
	public function rules() {
		return [
			'cost' => 'required|integer',
			'name' => 'required|unique:income_cat,name,' . \Request::get("id"),
		];
	}
}

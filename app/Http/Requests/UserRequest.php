<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {

	public function authorize() {
		return (Auth::user()->user_type == "S");
	}

	public function rules() {
		return [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:users,email,' . \Request::get("id"),
			'password' => 'required|min:6',
		];
	}
}

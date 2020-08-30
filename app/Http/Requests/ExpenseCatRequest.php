<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ExpenseCatRequest extends FormRequest {
	public function authorize() {
		return (Auth::user()->user_type == "S");
	}

	public function rules() {
		return [
			'cost' => 'required|integer',
			'name' => 'required|unique:expense_cat,name,' . \Request::get("id"),
		];
	}
}

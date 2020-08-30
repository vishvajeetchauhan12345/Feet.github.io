<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest {

	public function authorize() {
		return (Auth::user()->user_type == "S");
	}

	public function rules() {
		if($this->request->has("edit"))
		{
			return [
				
					'first_name' => 'required',
					'last_name' => 'required',
					'address' => 'required',
					'phone' => 'required|numeric',
					'email' => 'required|email|unique:users,email,' . \Request::get("id"),
					'license_number' => 'required|alpha_num|unique:user_meta,license_number,' . \Request::get("detail_id"),
					'emp_id' => 'alpha_num',
					'contract_number' => 'alpha_num',
					'start_date' => 'date|date_format:Y-m-d',
		
			
		];
	}
		else
		{
			return [
				
					'first_name' => 'required',
					'last_name' => 'required',
					'address' => 'required',
					'phone' => 'required|numeric',
					'email' => 'required|email|unique:users,email,' . \Request::get("id"),
					'license_number' => 'required|alpha_num|unique:user_meta,license_number,' . \Request::get("detail_id"),
					'emp_id' => 'alpha_num',
					'contract_number' => 'alpha_num',
					'exp_date' => 'required|date|date_format:Y-m-d|after:tomorrow',
					'start_date' => 'date|date_format:Y-m-d',
		
			
		];
		}
		
		
	}
}


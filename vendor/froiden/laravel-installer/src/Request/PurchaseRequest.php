<?php

namespace Froiden\LaravelInstaller\Request;

class PurchaseRequest extends CoreRequest {

	public function authorize() {
		return true;
	}

	public function rules() {
		return [
			'purchase_code' => 'required',

		];
	}

}

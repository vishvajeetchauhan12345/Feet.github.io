<?php

namespace Froiden\LaravelInstaller\Controllers;

use Froiden\LaravelInstaller\Request\PurchaseRequest;
use Illuminate\Routing\Controller;

class WelcomeController extends Controller {
	/**
	 * Display the installer welcome page.
	 *
	 * @return \Illuminate\View\View
	 */

	public function welcome() {
		return view('vendor.installer.welcome');
	}

	private function check_status($code) {
		$data = array("pcode" => $code, 'domain' => $_SERVER['SERVER_NAME']);
		$data_string = json_encode($data);

		$ch = curl_init('https://3xy2s8y7c9.execute-api.ap-south-1.amazonaws.com/prod');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data_string))
		);

		$result = curl_exec($ch);
		return $result;
	}

	public function welcome_post(PurchaseRequest $request) {
		$code = $request->purchase_code;

		$xx = $this->check_status($code);
		if ($xx != "1") {
			$response = [
				'status' => 'success',
				'message' => "Verified Code",
				'action' => 'redirect',
				'url' => route('LaravelInstaller::environment'),
			];
		} 
		return $response;
	}

}

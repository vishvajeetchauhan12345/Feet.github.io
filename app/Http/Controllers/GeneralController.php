<?php

namespace App\Http\Controllers;
use App\Http\Requests\DriverRequest;
use Illuminate\Http\Request;
use App\User;
use App\UserMeta;

class GeneralController extends Controller
{
   public function update_driver(DriverRequest $request)
	{
		dd("test");
		// dd($request->all());
		$id = $request->get('id');

		if (Input::hasFile('driver_image') && Input::file('driver_image')->isValid()) {

			$this->upload_file(Input::file('driver_image'), "profile_image", $id);
		}

		if (Input::hasFile('license_image') && Input::file('license_image')->isValid()) {
			$this->upload_file(Input::file('license_image'), "license_image", $id);
		}
		
		$user = User::whereId($request->get("id"))->first();
		$user->name = $request->get("first_name") . " " . $request->get("last_name");

		$user->save();
		$meta = UserMeta::whereUser_id($request->get('id'))->first();
		$meta->first_name = $request->get("first_name");
		$meta->last_name = $request->get("last_name");
		$meta->middle_name = $request->get("middle_name");
		$meta->address = $request->get("address");
		$meta->phone = $request->get("phone");
		$meta->license_number = $request->get("license_number");
		
		$meta->exp_date = $request->get("exp_date");
		$meta->save();
	
	}
}

<?php

namespace App\Http\Controllers;
use App\Bookings;
use App\Http\Requests\DriverRequest;
use App\User;
use App\UserMeta;
use Auth;
use Illuminate\Http\Request;
use Input;
use Redirect;

class DriversController extends Controller {
	public function index() {
		//$index['data'] = User::whereUser_type("D")->get();
		$index['data'] = User::whereUser_type("D")->paginate(10);
		return view("drivers.index", $index);
	}

	public function destroy(Request $request) {

		User::find($request->get('id'))->delete();
		UserMeta::whereUser_id($request->get('id'))->delete();
		return redirect()->route('drivers.index');
	}

	public function create() {
		return view("drivers.create");
	}

	public function edit(User $driver) {
		if ($driver->user_type != "D") {
			return redirect("drivers");
		}
		return view("drivers.edit", compact("driver"));
	}

	private function upload_file($file, $field, $id) {
		$destinationPath = './uploads'; // upload path
		$extension = $file->getClientOriginalExtension();
		$fileName1 = uniqid() . '.' . $extension;

		$file->move($destinationPath, $fileName1);

		$x = UserMeta::where("user_id", $id)->update([$field => $fileName1]);

	}
	public function update(DriverRequest $request) {

		$id = $request->get('id');

		if (Input::hasFile('driver_image') && Input::file('driver_image')->isValid()) {

			$this->upload_file(Input::file('driver_image'), "profile_image", $id);
		}

		if (Input::hasFile('license_image') && Input::file('license_image')->isValid()) {
			$this->upload_file(Input::file('license_image'), "license_image", $id);
		}
		if (Input::hasFile('documents')) {
			$this->upload_file(Input::file('documents'), "documents", $id);

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
		$meta->start_date = $request->get("start_date");
		$meta->end_date = $request->get("end_date");
		$meta->emp_id = $request->get("emp_id");
		$meta->contract_number = $request->get("contract_number");
		$meta->econtact = $request->get("econtact");
		$meta->license_number = $request->get("license_number");
		$meta->issue_date = $request->get("issue_date");
		$meta->exp_date = $request->get("exp_date");
		$meta->save();

		return Redirect::route("drivers.index");
	}
	public function store(DriverRequest $request) {

		$id = User::create([
			"name" => $request->get("first_name") . " " . $request->get("last_name"),
			"email" => $request->get("email"),
			"password" => bcrypt($request->get("password")),
			"user_type" => "D",
		])->id;
		$meta = new UserMeta();
		$meta->user_id = $id;
		$meta->first_name = $request->get("first_name");
		$meta->last_name = $request->get("last_name");
		$meta->middle_name = $request->get("middle_name");
		$meta->address = $request->get("address");
		$meta->phone = $request->get("phone");
		$meta->start_date = $request->get("start_date");
		$meta->end_date = $request->get("end_date");
		$meta->emp_id = $request->get("emp_id");
		$meta->contract_number = $request->get("contract_number");
		$meta->econtact = $request->get("econtact");
		$meta->license_number = $request->get("license_number");
		$meta->issue_date = $request->get("issue_date");
		$meta->exp_date = $request->get("exp_date");

		$meta->save();
		if (Input::hasFile('driver_image') && Input::file('driver_image')->isValid()) {
			$this->upload_file(Input::file('driver_image'), "profile_image", $id);
		}

		if (Input::hasFile('license_image') && Input::file('license_image')->isValid()) {
			$this->upload_file(Input::file('license_image'), "license_image", $id);
		}
		if (Input::hasFile('documents')) {
			$this->upload_file(Input::file('documents'), "documents", $id);

		}

		return Redirect::route("drivers.index");

	}

	public function enable($id) {
		$driver = UserMeta::whereUser_id($id)->first();
		$driver->is_active = 1;
		$driver->save();
		return Redirect::route("drivers.index");

	}

	public function disable($id) {
		$driver = UserMeta::whereUser_id($id)->first();
		$driver->is_active = 0;
		$driver->save();
		return Redirect::route("drivers.index");

	}

	public function my_bookings() {
		$data['data'] = Bookings::orderBy('id', 'desc')->whereDriver_id(Auth::user()->id)->get();
		// dd($data['data']);
		return view('drivers.my_bookings', $data);
	}

}

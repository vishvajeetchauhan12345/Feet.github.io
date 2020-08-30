<?php

namespace App\Http\Controllers;
use App\AcquisitionModel;
use App\Http\Requests\VehicleRequest;
use App\InsuranceModel;
use App\VehicleModel;
use Illuminate\Http\Request;
use Input;
use Redirect;

class VehiclesController extends Controller {
	public function index() {
		$index['data'] = VehicleModel::paginate(10);
		$index['insurance'] = InsuranceModel::get();
		$index['acq'] = AcquisitionModel::get();
		return view("vehicles.index", $index);
	}

	public function create() {
		return view("vehicles.create");
	}
	public function destroy(Request $request) {
		VehicleModel::find($request->get('id'))->income()->delete();
		VehicleModel::find($request->get('id'))->expense()->delete();
		VehicleModel::find($request->get('id'))->delete();
		return redirect()->route('vehicles.index');
	}

	public function edit($id) {

		$vehicle = VehicleModel::where('id', $id)->get()->first();

		return view("vehicles.edit", compact('vehicle'));
	}
	private function upload_file($file, $field, $id) {
		$destinationPath = './uploads'; // upload path
		$extension = $file->getClientOriginalExtension();
		$fileName1 = uniqid() . '.' . $extension;

		$file->move($destinationPath, $fileName1);

		$x = VehicleModel::find($id)->update([$field => $fileName1]);

	}

	private function upload_doc($file, $field, $id) {
		$destinationPath = './uploads'; // upload path
		$extension = $file->getClientOriginalExtension();
		$fileName1 = uniqid() . '.' . $extension;

		$file->move($destinationPath, $fileName1);

		$x = InsuranceModel::find($id)->update([$field => $fileName1]);

	}

	public function update(VehicleRequest $request) {
		$vehicle = $request->get('id');
		if (Input::hasFile('vehicle_image') && Input::file('vehicle_image')->isValid()) {
			$this->upload_file(Input::file('vehicle_image'), "vehicle_image", $vehicle);
		}

		// if (Input::hasFile('documents')) {
		// 	$this->upload_file(Input::file('documents'), "documents", $vehicle);

		// }
		$user = VehicleModel::find($request->get("id"));
		$form_data = $request->all();
		unset($form_data['vehicle_image']);
		unset($form_data['documents']);

		$user->update($form_data);

		if ($request->get("in_service")) {
			$user->in_service = 1;
		} else {
			$user->in_service = 0;
		}
		$user->int_mileage = $request->get("int_mileage");
		$user->lic_exp_date = $request->get('lic_exp_date');
		$user->reg_exp_date = $request->get('reg_exp_date');
		$user->save();

		// dd($form_data);

		return Redirect::route("vehicles.index");

	}

	public function store(VehicleRequest $request) {
		// dd($request->file('documents'));
		$user_id = $request->get('user_id');
		$vehicle = VehicleModel::create([
			'make' => $request->get("make"),
			'model' => $request->get("model"),
			'type' => $request->get("type"),
			'year' => $request->get("year"),
			'engine_type' => $request->get("engine_type"),
			'horse_power' => $request->get("horse_power"),
			'color' => $request->get("color"),
			'vin' => $request->get("vin"),
			'license_plate' => $request->get("license_plate"),
			'int_mileage' => $request->get("int_mileage"),

			'user_id' => $request->get('user_id'),

			'lic_exp_date' => $request->get('lic_exp_date'),
			'reg_exp_date' => $request->get('reg_exp_date'),
			'in_service' => $request->get("in_service"),
		]);

		if (Input::hasFile('vehicle_image') && Input::file('vehicle_image')->isValid()) {
			$this->upload_file(Input::file('vehicle_image'), "vehicle_image", $vehicle->id);
		}

		$vehicle->insurance()->Create(
			[
				'ins_number' => "",
				'ins_exp_date' => "",
			]

		);

		$vehicle_id = $vehicle->id;

		return redirect("vehicles/" . $vehicle_id . "/edit?tab=vehicle");
	}

	public function store_insurance(Request $request) {

		$insurance = InsuranceModel::updateOrCreate(['vehicle_id' => $request->get('vehicle_id')],
			[
				'vehicle_id' => $request->get('vehicle_id'),
				'ins_number' => $request->get("insurance_number"),
				'ins_exp_date' => $request->get('exp_date'),
			]

		);
		if (Input::hasFile('documents')) {
			$this->upload_doc(Input::file('documents'), 'documents', $insurance->id);
		}

		return redirect('vehicles/' . $request->get('vehicle_id') . '/edit?tab=insurance');
	}

	public function view_event($id) {
		$data['acq'] = AcquisitionModel::whereVehicle_id($id)->get();
		$data['vehicle'] = VehicleModel::where('id', $id)->get()->first();
		return view("vehicles.view_event", $data);
	}
}

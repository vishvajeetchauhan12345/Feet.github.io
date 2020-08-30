<?php

namespace App\Http\Controllers;
use App\AcquisitionModel;
use App\VehicleModel;
use Illuminate\Http\Request;

class AcquisitionController extends Controller {

	public function edit($id) {

		$index['data'] = AcquisitionModel::whereVehicle_id($id)->get();
		$index['vehicle'] = VehicleModel::find($id);
		return view("acquisition.edit", $index);

	}
	public function destroy(Request $request) {
		$vid = $request->get("vehicle_id");
		$id = $request->get("id");
		AcquisitionModel::where("vehicle_id", $vid)->where("id", $id)->delete();
		return redirect("vehicles/" . $vid . "/edit?tab=acq-tab");
	}
	public function store(Request $request) {
		$acqusition = AcquisitionModel::create($request->all());

		$index['data'] = AcquisitionModel::whereVehicle_id($request->get("vehicle_id"))->get();
		return view("acquisition.ajax", $index);
	}

}

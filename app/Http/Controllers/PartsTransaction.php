<?php

namespace App\Http\Controllers;
use App\PartsModel;
use App\PartStock;
use App\TransactionModel;
use App\VehicleModel;
use Auth;
use DB;
use Illuminate\Http\Request;

class PartsTransaction extends Controller {
	public function index() {
		$data['vehicels'] = VehicleModel::whereIn_service(1)->get();
		$data['parts'] = PartsModel::get();
		$data['stock'] = PartStock::get();
		$data['today'] = TransactionModel::whereDate('created_at', DB::raw('CURDATE()'))->get();
		return view("transaction.index", $data);
	}
	public function store(Request $request) {

		TransactionModel::create([
			"vehicle_id" => $request->get("vehicle_id"),
			"part_id" => $request->get("part"),
			"cost" => $request->get("cost"),
			"part_serial" => $request->get("serial_no"),
			"mileage" => $request->get("mileage"),
			"user_id" => Auth::id(),
			"date" => $request->get('date'),
			"mileage" => $request->get("mileage"),
			"qty" => $request->get("qty"),
			"total" => ($request->get("qty") * $request->get("cost")),
		]);
		$part_id = PartsModel::whereId($request->get("part"))->first();
		$part_id->decrement('stock', $request->get("qty"));

		$v = VehicleModel::find($request->get("vehicle_id"));

		$v->mileage = $request->get("mileage");
		$v->save();
		return redirect()->route("transaction.index");
	}

}

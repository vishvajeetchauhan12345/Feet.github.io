<?php

namespace App\Http\Controllers;

use App\IncCats;
use App\IncomeModel;
use App\VehicleModel;
use Auth;
use DB;
use Illuminate\Http\Request;

class Income extends Controller {
	public function index(Request $request) {
		$data['vehicels'] = VehicleModel::whereIn_service(1)->get();
		$data['types'] = IncCats::get();
		$data['today'] = IncomeModel::get();
		$data['total'] = IncomeModel::whereDate('date', DB::raw('CURDATE()'))->sum('amount');
		return view("income.index", $data);

	}

	public function store(Request $request) {

		IncomeModel::create([
			"vehicle_id" => $request->get("vehicle_id"),
			"amount" => $request->get("revenue"),
			"user_id" => Auth::id(),
			"date" => $request->get('date'),
			"mileage" => $request->get("mileage"),
			"income_cat" => $request->get("income_type"),
		]);
		$v = VehicleModel::find($request->get("vehicle_id"));

		$v->mileage = $request->get("mileage");
		$v->save();
		return redirect()->route("income.index");
	}

	public function destroy(Request $request) {
		IncomeModel::find($request->get('id'))->delete();
		return redirect()->route('income.index');
	}

	public function income_records(Request $request) {
		// dd($request->get('date2'));
		$data['vehicels'] = VehicleModel::whereIn_service(1)->get();
		$data['types'] = IncCats::get();
		$data['today'] = IncomeModel::whereBetween('date', [$request->get('date1'), $request->get('date2')])->get();
		$data['total'] = IncomeModel::whereDate('date', DB::raw('CURDATE()'))->sum('amount');
		// dd($data['today']);
		return view("income.index", $data);
		// return redirect()->route('income.index');
	}

}

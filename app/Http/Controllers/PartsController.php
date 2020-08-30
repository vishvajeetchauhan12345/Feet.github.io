<?php

namespace App\Http\Controllers;
use App\PartsModel;
use App\PartStock;
use Illuminate\Http\Request;
use Validator;

class PartsController extends Controller {

	public function index() {
		$index['data'] = PartsModel::get();
		return view("parts.index", $index);
	}

	public function create() {
		return view("parts.create");
	}

	public function destroy(Request $request) {
		PartsModel::find($request->get('id'))->get_stock()->delete();
		PartsModel::find($request->get('id'))->transactions()->delete();
		PartsModel::find($request->get('id'))->delete();

		return redirect()->route('parts.index');
	}

	public function edit($id) {
		$index['data'] = PartsModel::whereId($id)->first();
		return view("parts.edit", $index);
	}

	public function stock($id) {
		$data['data'] = PartStock::wherePart_id($id)->get();
		return view("parts.stocks", $data);
	}

	public function update(Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'oem' => 'required',
			'brand' => 'required',
			

		]);
		if ($validator->fails()) {

			return redirect('parts/' . $request->get("id") . '/edit')
				->withErrors($validator)
				->withInput();
		}
		$part = PartsModel::whereId($request->get("id"))->first();
		$part->name = $request->get("name");
		$part->oem = $request->get("oem");
		$part->brand = $request->get("brand");
		// $part->tp_ref = $request->get("tp_ref");

		$part->save();

		return redirect()->route("parts.index");
	}
	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'oem' => 'required',
			'brand' => 'required',
			'tp_ref' => 'required',

		]);
		if ($validator->fails()) {

			return redirect('parts/create')
				->withErrors($validator)
				->withInput();
		}
		PartsModel::create($request->all());
		return redirect()->route("parts.index");
	}
}

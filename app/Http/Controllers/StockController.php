<?php

namespace App\Http\Controllers;

use App\PartsModel;
use App\PartStock;
use Illuminate\Http\Request;
use Validator;

class StockController extends Controller {
	public function index() {
		return redirect()->route("parts.index");
	}
	public function show($id) {
		$data['data'] = PartStock::wherePart_id($id)->get();
		$data['part'] = PartsModel::whereId($id)->first();
		return view("parts.stocks", $data);
	}

	public function add($id) {
		$cnt = PartsModel::whereId($id)->get();

		if (!$cnt->count()) {
			return redirect()->route("parts.index");
		}
		$data['cnt'] = $cnt->first();

		return view("parts.add_stock", $data);

	}
	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'price_eur' => 'required|numeric',
			'transport' => 'required|numeric',
			'customs' => 'required|numeric',
			'volume' => 'required|integer',

		]);
		if ($validator->fails()) {

			return redirect("stock/add/" . $request->get("part_id"))
				->withErrors($validator)
				->withInput();
		}
		$xx = new PartStock();
		$xx->price_eur = $request->get("price_eur");
		$xx->transport = $request->get("transport");
		$xx->customs = $request->get("customs");
		$xx->volume = $request->get("volume");
		$xx->part_id = $request->get("part_id");
		$xx->user_id = $request->get("user_id");
		$xx->price_local = $request->get("price_eur") + $request->get("transport") + $request->get("customs");
		$xx->save();

		$part_id = PartsModel::whereId($request->get("part_id"))->first();
		$part_id->increment('stock', $request->get("volume"));
		return redirect("stock/" . $request->get("part_id"));

	}
	public function destroy(Request $request) {
		$id = PartStock::find($request->get('id'))->first();
		$part_id = PartsModel::whereId($id->part_id)->first();
		$part_id->decrement('stock', $id->volume);

		PartStock::find($request->get('id'))->delete();

		return redirect("stock/" . $id->part_id);
	}
}

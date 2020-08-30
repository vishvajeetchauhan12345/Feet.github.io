<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeCatRequest;
use App\IncCats;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class IncomeCategories extends Controller {
	public function index(Request $request) {
		$data['data'] = IncCats::paginate(10);

		return view("income.cats", $data);
	}
	public function create() {

		return view("income.catadd");
	}

	public function destroy(Request $request) {
		IncCats::find($request->get('id'))->income()->delete();
		IncCats::find($request->get('id'))->delete();

		return redirect()->route('incomecategories.index');
	}

	public function store(IncomeCatRequest $request) {

		IncCats::create([
			"name" => $request->get("name"),
			"user_id" => Auth::id(),
			"cost" => $request->get("cost"),
			"type"=>"u",

		]);

		return Redirect::route("incomecategories.index");

	}

	public function edit(IncCats $incomecategory) {

		return view("income.catedit", compact("incomecategory"));
	}

	public function update(IncomeCatRequest $request) {

		$user = IncCats::whereId($request->get("id"))->first();
		$user->name = $request->get("name");
		$user->user_id = Auth::id();
		$user->cost = $request->get("cost");

		$user->save();

		return Redirect::route("incomecategories.index");
	}

}

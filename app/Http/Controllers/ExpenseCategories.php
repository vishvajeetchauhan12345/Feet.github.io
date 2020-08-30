<?php

namespace App\Http\Controllers;

use App\ExpCats;
use App\Http\Requests\ExpenseCatRequest;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class ExpenseCategories extends Controller {
	public function index() {
		$data['data'] = ExpCats::paginate(10);

		return view("expense.cats", $data);
	}
	public function create() {

		return view("expense.catadd");
	}

	public function destroy(Request $request) {
		ExpCats::find($request->get('id'))->expense()->delete();
		ExpCats::find($request->get('id'))->delete();

		return redirect()->route('expensecategories.index');
	}

	public function store(ExpenseCatRequest $request) {

		ExpCats::create([
			"name" => $request->get("name"),
			"user_id" => Auth::id(),
			"cost" => $request->get("cost"),
			"frequancy" => $request->get("frequancy"),
			"type"=>"u",

		]);

		return Redirect::route("expensecategories.index");

	}

	public function edit(ExpCats $expensecategory) {

		return view("expense.catedit", compact("expensecategory"));
	}

	public function update(ExpenseCatRequest $request) {

		$user = ExpCats::whereId($request->get("id"))->first();
		$user->name = $request->get("name");
		$user->user_id = Auth::id();
		$user->cost = $request->get("cost");
		$user->frequancy = $request->get("frequancy");
		$user->save();

		return Redirect::route("expensecategories.index");
	}

}

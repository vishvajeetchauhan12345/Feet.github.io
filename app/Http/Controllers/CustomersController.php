<?php

namespace App\Http\Controllers;
use App\Customers;
use App\Http\Requests\Customers as CustomerRequest;
use DB;
use Illuminate\Http\Request;

class CustomersController extends Controller {
	public function index() {
		$data['data'] = Customers::all();
		return view("customers.index", $data);
	}
	public function create() {
		return view("customers.create");
	}
	public function store(CustomerRequest $request) {
		Customers::create($request->all());
		return redirect()->route("customers.index");
	}
	public function ajax_store(CustomerRequest $request) {
		Customers::create($request->all());
		$d = DB::select(DB::raw("select id,name as text from customers order by name"));
		return $d;

	}
	public function destroy(Request $request) {
		Customers::find($request->get('id'))->delete();

		return redirect()->route('customers.index');
	}

	public function edit($id) {
		$index['data'] = Customers::whereId($id)->first();
		return view("customers.edit", $index);
	}
	public function update(Request $request) {

		$customer = Customers::whereId($request->get("id"))->first();
		$customer->name = $request->get("name");
		$customer->email = $request->get("email");
		$customer->phone = $request->get("phone");
		$customer->address1 = $request->get("address1");
		$customer->address2 = $request->get("address2");
		$customer->city = $request->get("city");
		$customer->save();

		return redirect()->route("customers.index");
	}
}

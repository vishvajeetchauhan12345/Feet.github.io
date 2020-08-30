<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\Http\Requests\EditUserRequest;
use App\User;
use Illuminate\Http\Request;
use Redirect;

class UsersController extends Controller {
	public function index() {
		$index['data'] = User::whereUser_type("O")->get();
		return view("users.index", $index);
	}

	public function create() {
		return view("users.create");
	}

	public function destroy(Request $request) {
		User::find($request->get('id'))->delete();
		return redirect()->route('users.index');
	}
	public function store(UserRequest $request) {

		$id = User::create([
			"name" => $request->get("first_name") . " " . $request->get("last_name"),
			"email" => $request->get("email"),
			"password" => bcrypt($request->get("password")),
			"user_type" => "O",
		])->id;

		return Redirect::route("users.index");

	}
	public function edit(User $user) {

		return view("users.edit", compact("user"));
	}

	public function update(EditUserRequest $request) {

		$user = User::whereId($request->get("id"))->first();
		$user->name = $request->get("first_name") . " " . $request->get("last_name");
		$user->email = $request->get("email");
		$user->save();
		return Redirect::route("users.index");
	}

}

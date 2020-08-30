<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Session;
use Validator;

class UtilityController extends Controller {

	public function changepass($id) {
		if (Auth::user()->id === 1) {
			$us = new User();

			$data['user_data'] = $us::whereId($id)->first();

			$data['title'] = 'Change Password for : ' . $data['user_data']->username;
			$data['error'] = '';
			return view('utilities.changepass', $data);
		} else {
			$us = new User();
			$data['user_data'] = $us::whereId(Auth::user()->id)->first();
			$data['title'] = 'Change Password for : ' . $data['user_data']->username;
			$data['error'] = '';
			return view('utilities.changepass', $data);
		}

	}
	public function changepassword(Request $request) {

		$data['title'] = 'Change Admin Password';
		$id = $request->id;
		if (Auth::user()->id != 1) {
			$id = Auth::user()->id;
		}
		$us = new User();
		$data['user_data'] = $us::whereId($id)->first();

		if (Session::token() != $request->_token) {
			$data['error'] = 'Invalid Token';

			return view('admin/changepass', $data);
		} else {
			$validator = Validator::make($request->all(), ['name' => 'required', 'email' => 'required|email|max:255', 'passwd' => 'required']);
			if ($validator->fails()) {
				$data['error'] = 'Password cannot be blank';

				return view('utilities.changepass', $data);
			}
			$user = User::whereId($id)->first();
			$user->name = $request->name;
			$user->email = $request->email;

			$user->password = bcrypt($request->passwd);
			$user->save();

			$us = new User();
			$data['user_data'] = $us::whereId(Auth::user()->id)->first();
			$data['error'] = 'Settings are updated.';
		}

		return view('utilities.changepass', $data);
	}
}

<?php

namespace App\Http\Controllers;
use App\Settings;
use Cache;
use Illuminate\Http\Request;
use Input;
use Redirect;

class SettingsController extends Controller {

	public function index() {
		$data['settings'] = Settings::all();
		return view("utilities.settings", $data);
	}

	private function upload_file($file, $field, $name) {
		$destinationPath = './'; // upload path
		$extension = $file->getClientOriginalExtension();
		$fileName1 = uniqid() . '.' . $extension;

		$file->move($destinationPath, $fileName1);

		$x = Settings::where("name", $name)->update([$field => $fileName1]);

	}

	public function store(Request $request) {

		foreach ($request->get('name') as $key => $val) {
			Settings::where('name', $key)->update(['value' => $val]);
		}
		if (Input::hasFile('icon_img') && Input::file('icon_img')->isValid()) {
			$this->upload_file(Input::file('icon_img'), "value", 'icon_img');
		}

		if (Input::hasFile('logo_img') && Input::file('logo_img')->isValid()) {
			$this->upload_file(Input::file('logo_img'), "value", 'logo_img');
		}
		Cache::flush();
		return Redirect::route("settings.index");
	}
}

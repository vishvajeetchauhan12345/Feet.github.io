<?php

namespace App\Http\Controllers;
use App\VehicleModel;
use Illuminate\Http\Request;
use Redirect;
use DB;
use Illuminate\Support\Facades\Input;
class SearchvehiclesController extends Controller {
	public function index() {
		return view("vehicles.searchform");
	}
	public function search(Request $request) {
		$input = $request->input();
		unset($input['_token']);
		$index = VehicleModel::whereNested(function($query) use ($input) {
		    foreach ($input as $key => $value)
		        {
		            if($value != ''){
		                $query->where($key, '=', $value);
		            }
		        }
		}, 'and');
		$data['index'] = $index->get();
		return view("vehicles.search", $data);
	}

}

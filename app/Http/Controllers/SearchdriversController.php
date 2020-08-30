<?php

namespace App\Http\Controllers;

use App\User;
use App\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Input;
use Redirect;
use Validator;

class SearchdriversController extends Controller {
	public function index() {
		return view("drivers.searchform");
	}
	public function search(Request $request) {

		$input = $request->input();
		unset($input['_token']);
		$index = UserMeta::whereNested(function($query) use ($input) {
		
		    foreach ($input as $key => $value)
		        {
		            if($value != ''){
		                $query->where($key, '=', $value);
		            }
		        }
		}, 'and');
		$data['index'] = $index->get();
		//echo '<pre>';
		//print_r($data);
		return view("drivers.search", $data);
	

	}	
}

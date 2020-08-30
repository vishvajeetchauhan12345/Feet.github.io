<?php

namespace App\Http\Controllers;
use App\PartsModel;
use App\PartStock;
use Illuminate\Http\Request;
use Redirect;
use DB;
use Illuminate\Support\Facades\Input;
class SearchpartsController extends Controller {
	public function index() {
		return view("parts.searchform");
	}
	public function search(Request $request) {
		$input = $request->input();
		unset($input['_token']);
		$index = PartsModel::whereNested(function($query) use ($input) {
		    foreach ($input as $key => $value)
		        {
		            if($value != ''){
		                $query->where($key, '=', $value);
		            }
		        }
		}, 'and');
		$data['index']  = $index->get();
		return view("parts.search", $data);
	}
}

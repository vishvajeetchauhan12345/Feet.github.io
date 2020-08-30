<?php

namespace App\Http\Controllers;
use App\Bookings;
use App\Customers;
use App\ExpCats;
use App\IncCats;
use App\PartsModel;
use App\TransactionModel;
use App\VehicleModel;
use DB;
use Illuminate\Http\Request;

class ReportsController extends Controller {

	public function monthly() {

		$years = DB::select(DB::raw("select distinct year(date) as years from income  union select distinct year(date) as years from expense order by years desc"));
		$y = array();
		foreach ($years as $year) {
			$y[$year->years] = $year->years;
		}

		if($years == null)
		{
		

			$y = ['2017','2016'];

		}
		$data['vehicles'] = VehicleModel::get();

		$data['year_select'] = date("Y");
		$data['month_select'] = date("n");
		$data['vehicle_select'] = null;
		$data['years'] = $y;
		$data['income'] = DB::select(DB::raw("select sum(amount) as income from income where deleted_at is null and year(date)=" . date("Y") . " and month(date)=" . date("n")));
		$data['expenses'] = DB::select(DB::raw("select sum(amount) as expense from expense where deleted_at is null and year(date)=" . date("Y") . " and month(date)=" . $data['month_select']));
		$data['expense_by_cat'] = DB::select(DB::raw("select expense_type,sum(amount) as expense from expense where deleted_at is null and year(date)=" . date("Y") . " and month(date)=" . date("n") . " group by expense_type"));

		$data['income_by_cat'] = DB::select(DB::raw("select income_cat,sum(amount) as amount from income where deleted_at is null and year(date)=" . date("Y") . " and month(date)=" . date("n") . " group by income_cat"));

		$kk = ExpCats::get();

		foreach ($kk as $k) {
			$b[$k->id] = $k->name;

		}
		$hh = IncCats::get();

		foreach ($hh as $k) {
			$i[$k->id] = $k->name;

		}
		$data['expense_cats'] = $b;
		$data['income_cats'] = $i;
		$data['result'] = "";

		return view("reports.monthly", $data);
	}

	public function delinquent() {
		$years = collect(DB::select("select distinct year(date) as years from income where deleted_at is null order by years desc"))->toArray();

		$y = array();
		foreach ($years as $year) {
			$y[$year->years] = $year->years;
		}

		if($years == null)
		{
			$y = ['2017','2016'];
		}
		$data['vehicles'] = VehicleModel::get()->toArray();

		$data['vehicle_id'] = "";
		$data['year_select'] = date("Y");
		$data['month_select'] = date("n");
		$data['years'] = $y;

		return view("reports.delinquent", $data);
	}

	public function booking() {
		$years = collect(DB::select("select distinct year(pickup) as years from bookings where deleted_at is null order by years desc"));

		$y = array();
		foreach ($years as $year) {
			$y[$year->years] = $year->years;
		}
		$data['customers'] = Customers::all();
		$data['years'] = $y;
		$data['year_select'] = date("Y");
		$data['month_select'] = date("n");
		$data['bookings'] = Bookings::whereMonth("pickup", date("n"))->whereMonth("pickup", date("n"))->get();
		$data['vehicles'] = VehicleModel::get();

		return view("reports.booking", $data);
	}

	public function booking_post(Request $request) {
		$years = collect(DB::select("select distinct year(pickup) as years from bookings where deleted_at is null order by years desc"));

		$y = array();
		$data['customers'] = Customers::all();
		foreach ($years as $year) {
			$y[$year->years] = $year->years;
		}
		$data['years'] = $y;
		$data['year_select'] = $request->get("year");
		$data['month_select'] = $request->get("month");
		$data['bookings'] = Bookings::whereMonth("pickup", $data['month_select'])->whereMonth("pickup", $data['month_select']);
		if ($request->get("vehicle_id") != "") {
			$data['bookings'] = $data['bookings']->where("vehicle_id", $request->get("vehicle_id"));
		}
		if ($request->get("customer_id") != "") {
			$data['bookings'] = $data['bookings']->where("customer_id", $request->get("customer_id"));
		}
		$data['bookings'] = $data['bookings']->get();
		$data['vehicles'] = VehicleModel::get();

		return view("reports.booking", $data);
	}
	public function delinquent_post(Request $request) {

		$years = DB::select(DB::raw("select distinct year(date) as years from income where deleted_at is null order by years desc"));
		$y = array();
		foreach ($years as $year) {
			$y[$year->years] = $year->years;
		}
		if($years == null)
		{
			$y = ['2017','2016'];
		}
		$data['vehicles'] = VehicleModel::get();
		$data['year_select'] = $request->get("year");
		$data['month_select'] = $request->get("month");
		foreach ($data['vehicles'] as $row) {
			$data['v'][$row['id']] = $row;
		}
		foreach (IncCats::get()->toArray() as $cat) {
			$data['income_cats'][$cat['id']] = $cat['cost'];
		}
		$data['vehicle_id'] = $request->get("vehicle_id");
		$v = "";
		if ($data['vehicle_id'] != "") {
			$v = " and vehicle_id=" . $data['vehicle_id'];
		}
		$data['data'] = DB::select(DB::raw("select vehicle_id,income_cat,date,sum(amount) as Income2,dayname(date) as day from income where deleted_at is null and year(date)=" . $data['year_select'] . " and month(date)=" . $data['month_select'] . $v . " group by date order by date"));

		$data['years'] = $y;
		$data['result'] = "";

		return view("reports.delinquent", $data);
	}
	public function parts() {
		$data['parts'] = PartsModel::get();

		return view("reports.parts", $data);
	}
	public function parts_post(Request $request) {
		$data['parts'] = PartsModel::get();
		$data['parts2'] = TransactionModel::wherePart_id($request->get("part"))->get();

		$data['result'] = "";
		return view("reports.parts", $data);
	}

	public function monthly_post(Request $request) {

		$years = DB::select(DB::raw("select distinct year(date) as years from income  union select distinct year(date) as years from expense order by years desc"));
		$y = array();
		$b = array();
		$i = array();
		foreach ($years as $year) {
			$y[$year->years] = $year->years;
		}
		if($years == null)
		{
			$y = ['2017','2016'];
		}
		$data['vehicles'] = VehicleModel::get();
		$data['year_select'] = $request->get("year");
		$data['month_select'] = $request->get("month");
		$data['vehicle_select'] = $request->get("vehicle_id");
		$vk = "";
		if ($data['vehicle_select'] != "") {
			$vk = " and vehicle_id=" . $data['vehicle_select'];
		}
		$data['income'] = DB::select(DB::raw("select sum(amount) as income from income where deleted_at is null and year(date)=" . $data['year_select'] . " and month(date)=" . $data['month_select'] . $vk));
		$data['expenses'] = DB::select(DB::raw("select sum(amount) as expense from expense where deleted_at is null and year(date)=" . $data['year_select'] . " and month(date)=" . $data['month_select'] . $vk));
		$data['expense_by_cat'] = DB::select(DB::raw("select expense_type,sum(amount) as expense from expense where deleted_at is null and year(date)=" . $data['year_select'] . " and month(date)=" . $data['month_select'] . "$vk group by expense_type"));

		$data['income_by_cat'] = DB::select(DB::raw("select income_cat,sum(amount) as amount from income where deleted_at is null and year(date)=" . $data['year_select'] . " and month(date)=" . $data['month_select'] . "$vk group by income_cat"));

		$kk = ExpCats::get();

		foreach ($kk as $k) {
			$b[$k->id] = $k->name;

		}
		$hh = IncCats::get();

		foreach ($hh as $k) {
			$i[$k->id] = $k->name;

		}
		$data['expense_cats'] = $b;
		$data['income_cats'] = $i;

		$data['years'] = $y;
		$data['result'] = "";
		return view("reports.monthly", $data);
	}
}

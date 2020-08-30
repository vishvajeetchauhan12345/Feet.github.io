<?php
namespace App\Http\Controllers;
use App\Bookings;
use App\Customers;
use App\Expense;
use App\IncomeModel;
use App\PartsModel;
use App\User;
use App\VehicleModel;
use Auth;
use DB;

class HomeController extends Controller {

	public function index() {

		if (Auth::user()->user_type == "D") {
			$index['data'] = User::whereId(Auth::user()->id)->first();

			return view("drivers.profile", $index);

		} else {

			$index['drivers'] = User::whereUser_type("D")->get()->count();
			$index['users'] = User::whereUser_type("O")->get()->count();
			$index['vehicles'] = VehicleModel::all()->count();
			$index['parts'] = PartsModel::all()->count();
			$index['bookings'] = Bookings::all()->count();
			$index['customers'] = Customers::all()->count();
			$index['income'] = IncomeModel::whereRaw('year(date) = ? and month(date)=?', [date("Y"), date("n")])->sum("amount");
			$index['expense'] = Expense::whereRaw('year(date) = ? and month(date)=?', [date("Y"), date("n")])->sum("amount");
			$index['yearly_income'] = $this->yearly_income();
			$index['yearly_expense'] = $this->yearly_expense();

			return view('home', $index);
		}

	}

	private function yearly_income() {
		$incomes = DB::select('select monthname(date) as mnth,sum(amount) as tot from income where year(date)=? and  deleted_at is null group by month(date)', [date("Y")]);
		$months = ["January" => 0, "February" => 0, "March" => 0, "April" => 0, "May" => 0, "June" => 0, "July" => 0, "August" => 0, "September" => 0, "October" => 0, "November" => 0, "December" => 0];
		$income2 = array();

		foreach ($incomes as $income) {

			$income2[$income->mnth] = $income->tot;

		}
		$yr = array_merge($months, $income2);
		return implode(",", $yr);
	}
	private function yearly_expense() {
		$incomes = DB::select('select monthname(date) as mnth,sum(amount) as tot from expense where year(date)=? and  deleted_at is null group by month(date)', [date("Y")]);
		$months = ["January" => 0, "February" => 0, "March" => 0, "April" => 0, "May" => 0, "June" => 0, "July" => 0, "August" => 0, "September" => 0, "October" => 0, "November" => 0, "December" => 0];
		$income2 = array();

		foreach ($incomes as $income) {

			$income2[$income->mnth] = $income->tot;

		}
		$yr = array_merge($months, $income2);
		return implode(",", $yr);

	}
}

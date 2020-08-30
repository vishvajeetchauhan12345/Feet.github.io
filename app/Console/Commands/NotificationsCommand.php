<?php

namespace App\Console\Commands;
use App\Notifications\RenewDriverLicence;
use App\Notifications\RenewInsurance;
use App\Notifications\RenewRegistration;
use App\Notifications\RenewVehicleLicence;
use App\User;
use DB;
use Illuminate\Console\Command;

class NotificationsCommand extends Command {

	protected $signature = 'notification:generate';

	protected $description = 'Generate notifications';

	public function __construct() {
		parent::__construct();
	}

	public function handle() {

		$this->driver_notify();
		$this->vehicle_notify();
		$this->insurance_notify();
	}

	private function driver_notify() {
		$users = User::where('user_type', 'S')->get();
		$query = "select * from user_meta where DATEDIFF(exp_date,current_date())<=4 and deleted_at is null";
		$d = collect(DB::select(DB::raw($query)));
		// dd($d);
		foreach ($d as $data) {

			$driver_id = $data->id;
			$lic_date = $data->exp_date;
			$msg = $data->exp_date;
			foreach ($users as $user) {

				$user->notify(new RenewDriverLicence($msg, $driver_id, $lic_date));
			}

		}

	}
	private function vehicle_notify() {
		$users = User::where('user_type', 'S')->get();
		$query = "select * from vehicles where DATEDIFF(reg_exp_date,current_date())<=4 and deleted_at is null";
		$d = collect(DB::select(DB::raw($query)));
		foreach ($d as $data) {

			$vehicle_id = $data->id;
			$reg_date = $data->reg_exp_date;
			$msg = $data->reg_exp_date;
			foreach ($users as $user) {

				$user->notify(new RenewRegistration($msg, $vehicle_id, $reg_date));
			}

		}

		$query2 = "select * from vehicles where DATEDIFF(lic_exp_date,current_date())<=4 and deleted_at is null";
		$d2 = collect(DB::select(DB::raw($query2)));
		foreach ($d2 as $data) {

			$vehicle_id = $data->id;
			$lic_date = $data->lic_exp_date;
			$msg = $data->lic_exp_date;
			foreach ($users as $user) {

				$user->notify(new RenewVehicleLicence($msg, $vehicle_id, $lic_date));
			}

		}

	}

	private function insurance_notify() {
		$users = User::where('user_type', 'S')->get();
		$query = "select * from insurance where DATEDIFF(ins_exp_date,current_date())<=4 and deleted_at is null";
		$d = collect(DB::select(DB::raw($query)));
		foreach ($d as $data) {
			$ins_date = $data->ins_exp_date;
			$msg1 = $data->ins_exp_date;
			foreach ($users as $user) {

				$user->notify(new RenewInsurance($msg1, $data->vehicle_id, $ins_date));
			}

		}

	}
}

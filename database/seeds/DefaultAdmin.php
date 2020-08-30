<?php

use App\Expense;
use App\FuelModel;
use App\IncomeModel;
use App\User;
use App\VehicleModel;
use Illuminate\Database\Seeder;

class DefaultAdmin extends Seeder {

	public function run() {
		DB::table('users')->truncate();

		DB::table('vehicles')->truncate();
		DB::table('expense')->truncate();
		DB::table('income')->truncate();
		$admin = User::create([
			'name' => "Super Administrator",
			'email' => "master@admin.com",
			'password' => bcrypt('password'),
			'user_type' => "S",
		]);

		$id = User::create([
			"name" => "User One",
			"email" => "user1@admin.com",
			"password" => bcrypt("password"),
			"user_type" => "O"])->id;

		$id2 = User::create([
			"name" => "User Two",
			"email" => "user2@admin.com",
			"password" => bcrypt("password"),
			"user_type" => "O"])->id;

		$vehicle1 = [
			'make' => 'Honda',
			'model' => 'Jazz',
			'type' => 'TESDF',
			'year' => '2015',
			'engine_type' => 'Petrol',
			'horse_power' => '190',
			'color' => 'black',
			'vin' => '2342342',
			'license_plate' => '9191bh',
			'mileage' => '45464',
			// 'insurance_number'=>'001266301',
			// 'exp_date'=>date('Y-m-d', strtotime(' 50 day')),
			'lic_exp_date' => date('Y-m-d', strtotime(' 250 day')),
			'reg_exp_date' => date('Y-m-d', strtotime(' 150 day')),
			'in_service' => '1',
			'user_id' => '1',
			'int_mileage' => 50,

		];

		$vehicle2 = [
			'make' => 'Tata',
			'model' => 'NANO',
			'type' => 'car',
			'year' => '2012',
			'engine_type' => 'Petrol',
			'horse_power' => '150',
			'color' => 'red',
			'vin' => '124578',
			'license_plate' => '1245ab',
			'mileage' => '45464',
			// 'insurance_number'=>'001234501',
			// 'exp_date'=>date('Y-m-d', strtotime(' 190 day')),
			'lic_exp_date' => date('Y-m-d', strtotime(' 365 day')),
			'reg_exp_date' => date('Y-m-d', strtotime(' 90 day')),
			'in_service' => '1',
			'user_id' => '1',
			'int_mileage' => 40,

		];

		$v = VehicleModel::create($vehicle1);
		$v2 = VehicleModel::create($vehicle2);

		$v->insurance()->Create(
			[
				'ins_number' => '70651',
				'ins_exp_date' => $v->lic_exp_date,
			]

		);

		$v->acq()->create(
			[
				'exp_name' => "test",
				'exp_amount' => "1000",
				'user_id' => $id,
			]);

		$v2->insurance()->Create(
			[
				'ins_number' => '50878',
				'ins_exp_date' => $v2->lic_exp_date,
			]

		);

		$v2->acq()->create(
			[
				'exp_name' => "service",
				'exp_amount' => "3000",
				'user_id' => $id,
			]);

		Expense::create([
			'vehicle_id' => $v->id,
			'amount' => 42500,
			'user_id' => $id,
			'expense_type' => 1,
			'comment' => 'Sample Comment',
			'date' => date('Y-m-d', strtotime(' -1 day')),

		]);

		IncomeModel::create([
			'vehicle_id' => $v->id,
			'amount' => 15000,
			'user_id' => $id,
			'income_cat' => 2,
			'date' => date('Y-m-d', strtotime(' +5 day')),

		]);

		Expense::create([
			'vehicle_id' => $v2->id,
			'amount' => 1000,
			'user_id' => $id2,
			'expense_type' => 4,
			'comment' => 'Sample Comment',
			'date' => date('Y-m-d', strtotime(' -5 day')),

		]);

		IncomeModel::create([
			'vehicle_id' => $v2->id,
			'amount' => 18000,
			'user_id' => $id2,
			'income_cat' => 3,
			'date' => date('Y-m-d', strtotime(' +1 day')),

		]);

		$fuel1 = [
			'vehicle_id' => $v->id,
			'user_id' => $id,
			'start_meter' => 1000,
			'end_meter' => 2000,
			'note' => 'sample note',
			'qty' => 10,
			'fuel_from' => 'fuel tank',
			'cost_per_unit' => 50,
			'consumption' => 100,
			'date' => date('Y-m-d', strtotime(' -2 day')),

		];

		$fuel2 = [
			'vehicle_id' => $v->id,
			'user_id' => $id,
			'start_meter' => 2000,
			'end_meter' => 0,
			'note' => 'sample note',
			'qty' => 10,
			'fuel_from' => 'fuel tank',
			'cost_per_unit' => 50,
			'consumption' => 0,
			'date' => date('Y-m-d', strtotime(' +10 day')),

		];

		FuelModel::create($fuel1);
		FuelModel::create($fuel2);

	}
}

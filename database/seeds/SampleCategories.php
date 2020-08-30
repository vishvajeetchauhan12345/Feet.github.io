<?php

use App\Customers;
use App\ExpCats;
use App\IncCats;
use Illuminate\Database\Seeder;

class SampleCategories extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$this->import_income_categories();
		$this->import_expense_categories();


	}

	

	private function import_expense_categories() {
		DB::table('expense_cat')->truncate();
		$data = array(
			array(
				'name' => 'Insurance',
				'user_id' => '1',
				'cost' => '42500.00',
				'frequancy' => 'Monthly',
				'type'=>'d'
			),
			array(
				'name' => 'Patente',
				'user_id' => '1',
				'cost' => '60000.00',
				'frequancy' => 'Quarterly',
				'type'=>'d'
			),
			array(
				'name' => 'Mechanics',
				'user_id' => '1',
				'cost' => '30000.00',
				'frequancy' => 'Monthly',
				'type'=>'d'
			),
			array(
				'name' => 'Car wash',
				'user_id' => '1',
				'cost' => '1000.00',
				'frequancy' => 'Weekly',
				'type'=>'d'
			),
			array(
				'name' => 'Vignette',
				'user_id' => '1',
				'cost' => '3000.00',
				'frequancy' => 'Yearly',
				'type'=>'d'
			),
			array(
				'name' => 'Maintenance',
				'user_id' => '14',
				'cost' => '5678.00',
				'frequancy' => 'Daily',
				'type'=>'d'
			),
			array(
				'name' => 'Parking',
				'user_id' => '14',
				'cost' => '18000.00',
				'frequancy' => 'Yearly',
				'type'=>'d'
			),
			array(
				'name'=>'Fuel',
				'user_id'=>'15',
				'cost'=>'1000',
				'frequancy'=>'Daily',
				'type'=>'d'
			),
		);
		foreach ($data as $rec) {
			ExpCats::create($rec);
		}

	}
	private function import_income_categories() {
		DB::table('income_cat')->truncate();
		$data = array(
			array(
				'name' => 'Ragular Day',
				'user_id' => '1',
				'cost' => '17000.00',
				'type'=>'d'
			),
			array(
				'name' => 'Holiday',
				'user_id' => '1',
				'cost' => '15000.00',
				'type'=>'d'
			),
			array(
				'name' => 'Sunday',
				'user_id' => '1',
				'cost' => '18000.00',
				'type'=>'d'
			),
			array(
				'name' => 'Booking',
				'user_id' => '1',
				'cost' => '0.00',
				'type'=>'d'
			),
		);
		foreach ($data as $rec) {
			IncCats::create($rec);
		}

	}
}

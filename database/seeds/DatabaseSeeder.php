<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

	public function run() {
		$this->call(DefaultAdmin::class);
		$this->call(SampleCategories::class);
		$this->call(SettingSeed::class);
		factory(App\Bookings::class,2)->create();
    	factory(App\UserMeta::class,2)->create();
    	
	}
}

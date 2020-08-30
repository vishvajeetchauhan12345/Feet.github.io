<?php

use App\Settings;
use Illuminate\Database\Seeder;

class SettingSeed extends Seeder {

	public function run() {
		$this->default_settings();
	}

	private function default_settings() {
		DB::table('settings')->truncate();
		Settings::create(['label' => 'Website Name', 'name' => 'app_name', 'value' => 'Fleet Manager']);
		Settings::create(['label' => 'Business Name', 'name' => 'business_name', 'value' => 'Fleet Company']);
		Settings::create(['label' => 'Business Address 1', 'name' => 'badd1', 'value' => 'Company Address 1']);
		Settings::create(['label' => 'Business Address 2', 'name' => 'badd2', 'value' => 'Company Address 2']);
		Settings::create(['label' => 'Email Address', 'name' => 'email', 'value' => 'master@admin.com']);
		Settings::create(['label' => 'City', 'name' => 'city', 'value' => 'Bhavnagar']);
		Settings::create(['label' => 'State', 'name' => 'state', 'value' => 'Gujarat']);
		Settings::create(['label' => 'Country', 'name' => 'country', 'value' => 'India']);
		Settings::create(['label' => 'Language', 'name' => 'language', 'value' => 'en']);
		Settings::create(['label' => 'Currency', 'name' => 'currency', 'value' => '₹']);
		Settings::create(['label' => 'TAX NO', 'name' => 'tax_no', 'value' => 'ABCD8735XXX']);
		Settings::create(['label' => 'SMALL LOGO', 'name' => 'icon_img', 'value' => 'logo-40.png']);
		Settings::create(['label' => 'MAIN LOGO', 'name' => 'logo_img', 'value' => 'logo.png']);

	}
}

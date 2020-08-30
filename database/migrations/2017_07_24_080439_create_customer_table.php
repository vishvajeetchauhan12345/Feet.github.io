<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration {

	public function up() {
		Schema::create('customers', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->string('email', 255)->unique()->nullable();
			$table->string('phone', 20)->nullable();
			$table->string('address1', 255)->nullable();
			$table->string('address2', 255)->nullable();
			// $table->string('zipcode', 10)->nullable();
			$table->string('city', 20)->nullable();
			$table->nullableTimestamps();
			$table->softDeletes();

		});
	}

	public function down() {
		Schema::dropIfExists('customers');
	}
}

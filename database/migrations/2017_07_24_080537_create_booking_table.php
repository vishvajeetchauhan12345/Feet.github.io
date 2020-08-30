<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration {

	public function up() {
		Schema::create('bookings', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('customer_id');
			$table->integer('user_id');
			$table->integer('vehicle_id');
			$table->integer('driver_id');
			$table->timestamp('pickup')->nullable();
			$table->timestamp('dropoff')->nullable();
			$table->integer('duration')->nullable();
			$table->string('pickup_addr');
			$table->string('dest_addr');
			$table->string('note',50)->nullable();
			// $table->string('dept')->nullable();
			// $table->string('comment')->nullable();
			$table->integer('travellers')->default(1);
			$table->integer('status')->default(0);
			$table->nullableTimestamps();
			$table->softDeletes();

		});
	}

	public function down() {
		Schema::dropIfExists("bookings");
	}
}

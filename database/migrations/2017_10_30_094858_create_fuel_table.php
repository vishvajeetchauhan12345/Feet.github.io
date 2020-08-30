<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_id');
            $table->integer('user_id');
            $table->string('start_meter');
            $table->string('end_meter')->nullable();
            $table->string('reference')->nullable();
            $table->string('province',20)->nullable();
            $table->text('note')->nullable();
            $table->string('vendor_name')->nullable();
            $table->string('mileage_type')->nullable();
            $table->integer('qty');
            $table->string('fuel_from',10)->nullable();
            $table->string('cost_per_unit');
            $table->integer('consumption')->nullable();
            $table->integer('complete')->default(0)->nullable();
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuel');
    }
}

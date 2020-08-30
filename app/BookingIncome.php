<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingIncome extends Model {

	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = "booking_income";
	protected $fillable = ['booking_id', 'income_id'];
}

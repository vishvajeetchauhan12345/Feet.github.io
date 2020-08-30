<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'vehicle_id', 'user_id', 'amount', 'expense_type', 'comment', 'date',
	];
	protected $table = "expense";
	function category() {
		return $this->hasOne("App\ExpCats", "id", "expense_type")->withTrashed();
	}

	function vehicle() {
		return $this->hasOne("App\VehicleModel", "id", "vehicle_id")->withTrashed();
	}
}

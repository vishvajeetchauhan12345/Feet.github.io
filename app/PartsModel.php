<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartsModel extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'name', 'oem', 'tp_ref', 'brand', 'user_id', 'stock',
	];
	protected $table = "parts";

	public function get_stock() {
		return $this->hasMany("App\PartStock", "part_id", "id")->withTrashed();
	}
	public function transactions() {
		return $this->hasMany("App\TransactionModel", "part_id", "id")->withTrashed();
	}

}

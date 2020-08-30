<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartStock extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'part_id', 'price_eur', 'price_local', 'transport', 'customs', 'volume', 'user_id',
	];
	protected $table = "parts_stock";
	public function get_part() {
		return $this->belongsTo("App\PartsModel", "part_id", "id")->withTrashed();
	}

}

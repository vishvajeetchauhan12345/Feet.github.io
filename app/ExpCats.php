<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpCats extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'name', 'user_id', 'cost', 'frequancy','type'
	];
	protected $table = "expense_cat";
	function expense() {
		return $this->hasMany("App\Expense", "expense_type", "id")->withTrashed();
	}
}

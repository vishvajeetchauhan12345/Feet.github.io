<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMeta extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];

	protected $fillable = [
		'user_id', 'first_name', 'last_name', 'middle_name', 'address', 'phone', 'issue_date', 'license_number', 'exp_date', 'license_image', 'profile_image', 'documents', 'contract_number', 'start_date', 'end_date', 'emp_id', 'econtact',
	];

	protected $table = "user_meta";
	public function user() {
		return $this->belongsTo('App\User')->withTrashed();
	}

}

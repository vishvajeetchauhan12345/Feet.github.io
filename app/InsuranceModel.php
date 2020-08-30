<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InsuranceModel extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

	protected $fillable = ['vehicle_id', 'ins_number', 'ins_exp_date', 'documents',
		
	];

	protected $table = "insurance";
	public function insurance() 
	{
		return $this->belongsTo('App\VehicleModel')->withTrashed();
	}
    
}

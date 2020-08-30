<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class AcquisitionModel extends Model {

	protected $table = "acquisition";
	protected $fillable = [
		'vehicle_id', 'exp_name', 'exp_amount', 'user_id',
	];

}

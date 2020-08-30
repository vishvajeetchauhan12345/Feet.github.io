<div class="row">

	

		<table class="table table-striped">
			
		<tr>
		<th>@lang('fleet.vehicle')</th>
		<td>
			

			{{$vehicle->make}}   
			
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.model')</th>
		<td>
			{{$vehicle->model}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.type')</th>
		<td>
			{{$vehicle->type}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.year')</th>
		<td>
			{{$vehicle->year}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.intMileage') (km)</th>
		<td>
			{{$vehicle->int_mileage}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.vehicleImage')</th>
		<td>
			@if($vehicle->vehicle_image != null)             
            <a href="{{ asset('uploads/'.$vehicle->vehicle_image) }}" target="_blank" class="col-xs-3 control-label">View</a>
            @endif
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.engine')</th>
		<td>
			{{$vehicle->engine_type}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.horsePower')</th>
		<td>
			{{$vehicle->horse_power}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.color')</th>
		<td>
			{{$vehicle->color}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.vin')</th>
		<td>
			{{$vehicle->vin}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.licensePlate')</th>
		<td>
			{{$vehicle->license_plate}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.lic_exp_date')</th>
		<td>
			{{$vehicle->lic_exp_date}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.reg_exp_date')</th>
		<td>
			{{$vehicle->reg_exp_date}}
		</td>
		</tr>
		
		<tr>
				<th>@lang('fleet.expenseType')</th>
				<td>
				
					
					{{$vehicle->acq['exp_name']}}
					
				</td>
			</tr>

			<tr>
				<th>@lang('fleet.expenseAmount')</th>
				<td>
					
					{{$vehicle->acq['exp_amount']}}
					
				</td>
			</tr>
		
			<tr>
		<th>@lang('fleet.insuranceNumber')</th>
		<td>
			
			{{$vehicle->insurance['ins_number']}}
			
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.inc_doc')</th>
		<td>
			@if($vehicle->insurance['documents'] != null)
             <a href="{{ asset('uploads/'.$vehicle->insurance['documents']) }}" target="_blank">
             View
         	 </a>
            @endif
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.inc_expirationDate')</th>
		<td>
			
			{{$vehicle->insurance['ins_exp_date']}}
			
		</td>
		</tr>

		</table>
		
</div>
               

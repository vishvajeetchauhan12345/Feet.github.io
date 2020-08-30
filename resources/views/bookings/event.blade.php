

<table class="table table-striped">

	<tr>
	<th>@lang('fleet.customer')</th>
	<td>{{ $booking->customer->name}}</td>
	</tr>
	<tr>
	<th>@lang('fleet.vehicle')</th>
	<td>{{ $booking->vehicle->make}} - {{ $booking->vehicle->model}} - {{ $booking->vehicle->license_plate}}</td>
	</tr>
	<tr>
	<th>@lang('fleet.travellers')</th>

	<td>{{ $booking->travellers}}</td>
	</tr>
	<tr>
	<th>@lang('fleet.comment')</th>
	<td>{{ $booking->comment}}</td>
	</tr>
	<tr>
	<th>@lang('fleet.pickup')</th>
	<td>{{ $booking->pickup}}</td>
	</tr>
	<tr>
	<th>@lang('fleet.dropoff')</th>
	<td>{{ $booking->dropoff}}</td>
	</tr>
	<tr>
	<th>@lang('fleet.pickup_addr')</th>
	<td>{{ $booking->pickup_addr}}</td>
	</tr>
	<tr>
	<th>@lang('fleet.dest_addr')</th>
	<td>{{ $booking->dest_addr}}</td>
	</tr>
</table>
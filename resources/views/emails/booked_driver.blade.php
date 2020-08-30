@component('mail::message')
# Ride Booked.

Dear {{$booking->vehicle->driver->user->name}},

	Your Vehicle is booked for your next journey. Below are the details for your journey.

@component('mail::table')
<table>
	<tr><td>Customer Name: </td><td>{{$booking->customer->name}}</td></tr>
	<tr><td>Journey Date: </td><td>{{$booking->from_date}}</td></tr>
	<tr><td>Pickup Time: </td><td>{{$booking->pickup_time}}</td></tr>
	<tr><td>Pickup Address: </td><td>{{$booking->pickup_addr}}</td></tr>
	<tr><td>Destination Address: </td><td>{{$booking->dest_addr}}</td></tr>
	<tr><td>Travellers: </td><td>{{$booking->travellers}}</td></tr>

</table>
@endcomponent

We Wish you a happy journey.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

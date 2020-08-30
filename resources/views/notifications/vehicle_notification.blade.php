
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('menu.notifications')

                </div>

                <div class="panel-body">

                    <table class="table" id="data_table">
  <thead class="thead-inverse">
    <tr>
       <th>@lang('fleet.vehicles')</th>
       <th>@lang('fleet.vehicleImage')</th>
      <th>@lang('fleet.notification')</th>

      <th>@lang('fleet.remaining_days')</th>
      <th>@lang('fleet.created')</th>

    </tr>
  </thead>
  <tbody>
 @php
  $user = App\User::find(Auth::id());
 @endphp
 @if($type == "renew-registrations")
      @php ($type = "App\Notifications\RenewRegistration")
      @php ($msg = __('fleet.reg_certificate'))
    @elseif($type == "renew-insurance")
      @php ($type = "App\Notifications\RenewInsurance")
       @php ($msg = __('fleet.vehicle_insurance'))
     @elseif ($type = "renew-licence")
     	@php ($type = "App\Notifications\RenewVehicleLicence")
       @php ($msg = __('fleet.vehicle_licence'))
    @else
      @php ($type = "App\Notifications\RenewalCertificate")
  @endif
  @foreach ($user->unreadNotifications as $notification)
  @if($notification->type==$type)
   @php($notification->markAsRead())
   @endif
 @endforeach
 @foreach($vehicle as $data)

  @foreach ($user->notifications as $notification)
    @if($notification->type == $type)
    @php   ($to = \Carbon\Carbon::now())

      @php ($from = \Carbon\Carbon::createFromFormat('Y-m-d', $notification->data['date']))

      @php ($diff_in_days = $to->diffInDays($from))

 @if($data->id == $notification->data['vid'])
    <tr>

     <td>
     	{{$data->make}} <br>
     	{{$data->model}}
     </td>

     <td>
     	@if($data->vehicle_image != null)
      <img src="{{url('uploads/'.$data->vehicle_image)}}" height="70px" width="70px">
      @else
     	<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHuy_Zxg3ifpNuMtUE1DE_s-qfTPHLfPyOrc_geOvkQm1oSZhA9A" height="70px" width="70px">
      @endif
     </td>

     <td>{{ $msg }} {{ $notification->data['msg'] }}</td>

     <td>


		{{$diff_in_days}}
     </td>
      <td>
       {{ $notification->created_at}}
      </td>
    </tr>
      	@endif

   @endif
      	@endforeach
     @endforeach

  </tbody>
  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

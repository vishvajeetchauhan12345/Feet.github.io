
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
       <th>@lang('fleet.name')</th>
       <th>@lang('fleet.driverImage')</th>
      <th>@lang('fleet.notification')</th>

      <th>@lang('fleet.remaining_days')</th>
      <th>@lang('fleet.created')</th>

    </tr>
  </thead>
  <tbody>
 @php
  $user = App\User::find(Auth::id());

 @endphp


 @if ($type = "renew-driving-licence")
	 @php ($type = "App\Notifications\RenewDriverLicence")
 @endif
 @foreach ($user->unreadNotifications as $notification)
  @if($notification->type==$type)
   @php($notification->markAsRead())
   @endif
 @endforeach
 @foreach($driver as $data)

  @foreach ($user->notifications as $notification)
    @if($notification->type == $type)
    @php   ($to = \Carbon\Carbon::now())

      @php ($from = \Carbon\Carbon::createFromFormat('Y-m-d', $notification->data['date']))

      @php ($diff_in_days = $to->diffInDays($from))

 @if($data->id == $notification->data['vid'])
    <tr>

     <td>
     	{{$data->first_name}} {{$data->last_name}}
     </td>

     <td>
     	@if($data->profile_image == null)
      <img src="http://tektutor.org/wp-content/uploads/2015/07/no-user.jpg" height="70px" width="70px">
      @else
      <img src="{{url('uploads/'.$data->profile_image)}}" height="70px" width="70px">


      @endif
     </td>

     <td> @lang('fleet.driver_licence') {{ $notification->data['msg'] }}</td>

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

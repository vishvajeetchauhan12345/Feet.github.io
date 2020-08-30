<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name') }}</title>
 <link rel="icon" href="{{ url( Hyvikk::get('icon_img') ) }}" type="image/png">


<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@yield("extra_css")
<script>
window.Laravel = {!! json_encode([
'csrfToken' => csrf_token(),
]) !!};


</script>
</head>
<body>
<div id="app">
<nav class="navbar navbar-default navbar-static-top">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
<span class="sr-only">Toggle Navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<img src="{{ url( Hyvikk::get('icon_img') ) }}" class="navbar-brand">
<a class="navbar-brand" href="{{ url('/') }}">

{{ Hyvikk::get('app_name') }}

</a>
</div>

<div class="collapse navbar-collapse" id="app-navbar-collapse">

@if (!Auth::guest() &&  Auth::user()->user_type!="D")
<ul class="nav navbar-nav">
<li class="dropdown">
<a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">@lang('menu.users')<span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li>
<a href="{{ route("drivers.index") }}">@lang('menu.drivers')</a>
</li>
@if(Auth::user()->user_type=="S")
<li>
<a href="{{ route("users.index") }}">@lang('menu.users')</a>
</li>
@endif

</ul>
</li>

<li class="dropdown">
<a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">@lang('menu.vehicles')<span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li>
<a href="{{ route("vehicles.index") }}">@lang('menu.manageVehicles')</a>
</li>
<li>
<a href="{{ route("parts.index") }}">@lang('menu.manageParts')</a>
</li>
</ul>
</li>


<li class="dropdown">
<a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">@lang('menu.transactions')<span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li>
<a href="{{ route("income.index")}}">@lang('fleet.manage_income')</a>
</li>
<li>
<a href="{{ route("expense.index")}}">@lang('fleet.manage_expense')</a>
</li>

<li>
<a href="{{ route("transaction.index")}}">@lang('menu.partTransaction')</a>
</li>

<li>
<a href="{{ route("expensecategories.index") }}">@lang('menu.expenseCategories')</a>
</li>
<li>
<a href="{{ route("incomecategories.index") }}">@lang('menu.incomeCategories')</a>
</li>

</ul>
</li>

<li class="dropdown">
<a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">@lang('menu.bookings')<span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li> <a href="{{ route("bookings.create")}}">@lang('menu.newbooking')</a> </li>
<li> <a href="{{ route("customers.index")}}">@lang('menu.manage_customers')</a> </li>
<li> <a href="{{ route("bookings.index")}}">@lang('menu.manage_bookings')</a> </li>
<li> <a href="{{ route("bookings.calendar")}}">@lang('menu.calendar')</a> </li>

</ul>
</li>
<li class="dropdown">
<a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">@lang('menu.reports')<span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li> <a href="{{ route("reports.delinquent")}}">@lang('menu.deliquentReport')</a> </li>
<li> <a href="{{ route("reports.monthly")}}">@lang('menu.monthlyReport')</a> </li>
<li> <a href="{{ route("reports.parts")}}">@lang('menu.partsReport')</a> </li>
<li> <a href="{{ route("reports.booking")}}">@lang('menu.bookingReport')</a> </li>
</ul>
</li>

<li class="dropdown">
<a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">@lang('fleet.fuel')<span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<li> <a href="{{ route("fuel.create")}}">@lang('fleet.add_fuel')</a> </li>
<li> <a href="{{ route("fuel.index")}}">@lang('fleet.manage_fuel')</a> </li>
</ul>
</li>

@if(Auth::user()->user_type=="S")
@php($r = 0)
@php($i = 0)
@php($l = 0)
@php($d = 0)
@php($user= Auth::user())
@foreach ($user->unreadNotifications as $notification)
@if($notification->type == "App\Notifications\RenewRegistration")
  @php($r++)
  @elseif($notification->type == "App\Notifications\RenewInsurance")
  @php($i++)
  @elseif($notification->type == "App\Notifications\RenewVehicleLicence")
  @php($l++)
  @else
  @php($d++)
  @endif
 @endforeach
 @php($n = $r + $i +$l +$d)
<li class="dropdown">
<a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">@lang('menu.notifications')&nbsp;@if($n>0)<span class="badge">{{$n}}</span>@endif<span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
  <li>
   <a href="{{url('vehicle_notification',['type'=>'renew-registrations'])}}"> @lang('fleet.renew_registration')&nbsp;@if($r>0) <span class="badge"> {{$r}}</span>@endif  </a>
  </li>
  <li>
   <a href="{{url('vehicle_notification',['type'=>'renew-insurance'])}}"> @lang('fleet.renew_insurance')
    &nbsp;@if($i>0)<span class="badge">{{$i}}</span>@endif </a>
  </li>
   <li>
   <a href="{{url('vehicle_notification',['type'=>'renew-licence'])}}"> @lang('fleet.renew_licence')&nbsp; @if($l>0)<span class="badge">{{$l}}</span>@endif</a>
  </li>
  <li>
   <a href="{{url('driver_notification',['type'=>'renew-driving-licence'])}}"> @lang('fleet.renew_driving_licence')&nbsp;@if($d>0) <span class="badge"> {{$d}}</span>@endif</a>
  </li>

</ul>
</li>
@endif
</ul>
@endif

<!-- Right Side Of Navbar -->
<ul class="nav navbar-nav navbar-right">
<!-- Authentication Links -->
@if (!Auth::guest())
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
{{ Auth::user()->name }} <span class="caret"></span>
</a>

<ul class="dropdown-menu" role="menu">
@if(Auth::user()->user_type=="S")
<li>
<a href="{{ route("settings.index") }}">@lang('menu.settings')</a>
</li>
@endif

@if(Auth::user()->user_type=="D")
<li>
<a href="{{ route('my_bookings')}}">@lang('menu.my_bookings')</a>
</li>

<li>
<a href="{{url('/')}}">@lang('fleet.myProfile')</a>
</li>
@endif


<li>
  <a href="{{ route('changepass',array(Auth::user()->id))}}">@lang('fleet.editProfile')</a>
</li>
<li>
  <a href="{{ route('logout') }}"
      onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
      @lang('menu.logout')
  </a>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
  </form>
</li>
</ul>
</li>
@endif
</ul>
</div>
</div>
</nav>

@yield('content')
</div>
@yield('script2')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {
$('#data_table').DataTable({
  "language": {

                 "url": '{{ __("fleet.datatable_lang") }}',


            }
});
$('[data-toggle="tooltip"]').tooltip();
});
</script>
@yield('script')
</body>
</html>
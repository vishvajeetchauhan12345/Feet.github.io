@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.edit_booking')

                </div>

                <div class="panel-body">
@if (count($errors) > 0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<div class="alert alert-success hide fade in alert-dismissable" id="msg_s">
  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
  <strong>Hurray!</strong> Customer added successfully. Check Drop-down.
</div>

<div class="alert alert-info hide fade in alert-dismissable" id="msg_driver">
  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
  Your current driver is not available in the chosen times. Available driver  has been selected.
</div>
<div class="alert alert-info hide fade in alert-dismissable" id="msg_vehicle">
  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
  Your current vehicle is not available in the chosen times. Available vehicle has been selected.
</div>

{!! Form::open(['route' => ['bookings.update',$data->id],'method'=>'PATCH']) !!}
{!! Form::hidden('user_id',Auth::user()->id)!!}
{!! Form::hidden('status',0)!!}
{!! Form::hidden('id',$data->id)!!}
<div class="row">
  <div class="col-md-4">
  <div class="form-group">
{!! Form::label('pickup',__('fleet.pickup'), ['class' => 'form-label']) !!}
<div class='input-group date' id='from_date'>

{!! Form::text('pickup',$data->pickup,['class'=>'form-control','required']) !!}
<span class="input-group-addon">
  <span class="glyphicon glyphicon-calendar"></span>
</span>
</div>
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
{!! Form::label('dropoff',__('fleet.dropoff'), ['class' => 'form-label']) !!}
<div class='input-group date' id='to_date'>

{!! Form::text('dropoff',$data->dropoff,['class'=>'form-control','required']) !!}
<span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
  </div>
  </div>


  <div class="col-md-4">
 <div class="form-group">
 {!! Form::label('customer_id',__('fleet.selectCustomer'), ['class' => 'form-label']) !!}

 <select id="customer_id" disabled="" name="customer_id" class="form-control xxhvk" required>

<option selected value="{{$data->customer['id']}}">{{$data->customer['name']}}</option>
 </select>
 </div>

 </div>
</div>
<div class="row">


<div class="col-md-4">
  <div class="form-group">
 {!! Form::label('vehicle_id',__('fleet.selectVehicle'), ['class' => 'form-label']) !!}
  <select id="vehicle_id" name="vehicle_id" class="form-control" required>
<option value="">-</option>

@foreach($vehicles as $vehicle)
@if($vehicle->id===$data->vehicle_id)

<option value="{{$vehicle->id}}" selected> {{$vehicle->make}} - {{$vehicle->model}} - {{$vehicle->color}} - {{$vehicle->license_plate}}</option>
@else
<option value="{{$vehicle->id}}" > {{$vehicle->make}} - {{$vehicle->model}} - {{$vehicle->color}} - {{$vehicle->license_plate}}</option>
@endif

@endforeach
 </select>
 </div>


</div>
<div class="col-md-4">
  <div class="form-group">

 {!! Form::label('vehicle_id',__('fleet.selectDriver'), ['class' => 'form-label']) !!}

  <select id="driver_id" name="driver_id" class="form-control" required>


<option value="">-</option>
@foreach($drivers as $driver)

@if($driver->id === $data->driver_id)
<option value="{{$driver->id}}" selected>{{$driver->name}}</option>
@else
<option value="{{$driver->id}}">{{$driver->name}}</option>
@endif
@endforeach
 </select>
 </div>


</div>

<div class="col-md-4">
  <div class="form-group">
 {!! Form::label('travellers',__('fleet.no_travellers'), ['class' => 'form-label']) !!}
 {!! Form::number('travellers',$data->travellers,['class'=>'form-control','min'=>1]) !!}
 </div>


</div>
</div>
<div class="row">



    <div class="col-md-4">
  <div class="form-group">


{!! Form::label('pickup_addr',__('fleet.pickup_addr'), ['class' => 'form-label']) !!}
{!! Form::textarea('pickup_addr',$data->pickup_addr,['class'=>'form-control','required']) !!}

  </div>
  </div>
    <div class="col-md-4">
  <div class="form-group">
{!! Form::label('dest_addr',__('fleet.dropoff_addr'), ['class' => 'form-label']) !!}
{!! Form::textarea('dest_addr',$data->dest_addr,['class'=>'form-control','required']) !!}
  </div>
  </div>

  <div class="col-md-4">
  <div class="form-group">


{!! Form::label('note',__('fleet.note'), ['class' => 'form-label']) !!}
{!! Form::textarea('note',$data->note,['class'=>'form-control']) !!}

  </div>
  </div>
</div>
<div class="col-md-12">
{!! Form::submit(__('fleet.update'), ['class' => 'btn btn-warning']) !!}

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section("script")
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/datetimepicker.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
$("#vehicle_id").select2();
$("#driver_id").select2();
$("#dept").select2();
function get_driver(from_date,to_date){
  var id=$("input:hidden[name=id]").val();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $.ajax({
  type: "POST",
  url: "{{url('/get_driver')}}",
  data: "req=edit&id="+id+"&from_date="+from_date+"&to_date="+to_date,
  success: function(data2){
    $("#driver_id").empty();

$("#driver_id").select2({placeholder: 'Select Driver',data:data2.data});

if(data2.show_error==="yes"){
  $("#msg_driver").removeClass("hide").fadeIn(1000);
} else {
  $("#msg_driver").addClass("hide").fadeIn(1000);
}
  },
error: function(data){
var errors = $.parseJSON(data.responseText);

        $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").css('display','block');
      $.each( errors, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
      });

      },
  dataType: "json"
});
  }

  function get_vehicle(from_date,to_date){
    var id=$("input:hidden[name=id]").val();
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $.ajax({
  type: "POST",
  url: "{{url('/get_vehicle')}}",
  data: "req=edit&id="+id+"&from_date="+from_date+"&to_date="+to_date,
  success: function(data2){

    $("#vehicle_id").empty();
$("#vehicle_id").select2({placeholder: 'Select Vehicle',data:data2.data});
if(data2.show_error==="yes"){
  $("#msg_vehicle").removeClass("hide").fadeIn(1000);
} else {
  $("#msg_vehicle").addClass("hide").fadeIn(1000);
}

  },
error: function(data){
var errors = $.parseJSON(data.responseText);

        $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").css('display','block');
      $.each( errors, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
      });

      },
  dataType: "json"
});
  }


    $(document).ready(function() {


  $('#pickup').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss',sideBySide: true});
  $('#dropoff').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss',sideBySide: true});
  $("#pickup").on("dp.change", function (e) {
 var to_date=$('#dropoff').data("DateTimePicker").date().format("YYYY-MM-DD HH:mm:ss");
  var from_date=e.date.format("YYYY-MM-DD HH:mm:ss");

    get_driver(from_date,to_date);
    get_vehicle(from_date,to_date);

      $('#dropoff').data("DateTimePicker").minDate(e.date);
  });

  $("#dropoff").on("dp.change", function (e) {
    $('#pickup').data("DateTimePicker").date().format("YYYY-MM-DD HH:mm:ss")
 var from_date=$('#pickup').data("DateTimePicker").date().format("YYYY-MM-DD HH:mm:ss");
  var to_date=e.date.format("YYYY-MM-DD HH:mm:ss");

    get_driver(from_date,to_date);
    get_vehicle(from_date,to_date);

  });


});
</script>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.new_booking')

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
  <strong>Hurray!</strong> Customer added successfully. Check Dropdown.
</div>

{!! Form::open(['route' => 'bookings.store','method'=>'post']) !!}
{!! Form::hidden('user_id',Auth::user()->id)!!}
{!! Form::hidden('status',0)!!}
<div class="row">
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('customer_id',__('fleet.selectCustomer'), ['class' => 'form-label']) !!}
<a href="#" data-toggle="modal" data-target="#exampleModal">@lang('fleet.new_customer')</a>
 <select id="customer_id" name="customer_id" class="form-control" required>
<option value="">-</option>
@foreach($customers as $customer)
<option value="{{$customer->id}}" data-address="{{$customer->address1}}" data-address2="{{$customer->address2}}">{{$customer->name}}</option>
@endforeach
 </select>
 </div>

 </div>

<div class="col-md-4">
  <div class="form-group">
{!! Form::label('pickup',__('fleet.pickup'), ['class' => 'form-label']) !!}
<div class='input-group date' id='pickup'>
{!! Form::text('pickup',date("Y-m-d H:i:s"),['class'=>'form-control','required']) !!}
<span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
{!! Form::label('dropoff',__('fleet.dropoff'), ['class' => 'form-label']) !!}
<div class='input-group date' id='dropoff'>
{!! Form::text('dropoff',date("Y-m-d H:i:s"),['class'=>'form-control','required']) !!}
<span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
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
<option value="{{$vehicle->id}}">{{$vehicle->make}} - {{$vehicle->model}} - {{$vehicle->license_plate}}</option>
@endforeach
 </select>

 </div>


</div>



<div class="col-md-4">

  <div class="form-group">
 {!! Form::label('driver_id',__('fleet.selectDriver'), ['class' => 'form-label']) !!}

  <select id="driver_id" name="driver_id" class="form-control" required>
<option value="">-</option>
@foreach($drivers as $driver)
<option value="{{$driver->id}}" >{{$driver->name}}</option>
@endforeach
 </select>
 </div>

</div>

      <div class="col-md-4">
  <div class="form-group">
 {!! Form::label('travellers',__('fleet.no_travellers'), ['class' => 'form-label']) !!}
 {!! Form::number('travellers',1,['class'=>'form-control','min'=>1]) !!}
 </div>
  </div>
</div>
<div class="row">


    <div class="col-md-4">
  <div class="form-group">


{!! Form::label('pickup_addr',__('fleet.pickup_addr'), ['class' => 'form-label']) !!}
{!! Form::textarea('pickup_addr',null,['class'=>'form-control','required']) !!}

  </div>
  </div>
    <div class="col-md-4">
  <div class="form-group">
{!! Form::label('dest_addr',__('fleet.dropoff_addr'), ['class' => 'form-label']) !!}
{!! Form::textarea('dest_addr',null,['class'=>'form-control','required']) !!}
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">


{!! Form::label('note',__('fleet.note'), ['class' => 'form-label']) !!}
{!! Form::textarea('note',null,['class'=>'form-control']) !!}

  </div>
  </div>
</div>
<div class="col-md-12">
{!! Form::submit(__('fleet.save_booking'), ['class' => 'btn btn-info']) !!}

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New Customer</h4>
      </div>
      {!! Form::open(['route' => 'customers.ajax_store','method'=>'post','id'=>'create_customer_form']) !!}
      <div class="modal-body">
<div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
         <div class="form-group">
         {!! Form::label('name', __('fleet.name'), ['class' => 'form-label']) !!}
         {!! Form::text('name', null,['class' => 'form-control','required']) !!}
         </div>
         <div class="form-group">
 {!! Form::label('phone',__('fleet.phone'), ['class' => 'form-label']) !!}
 {!! Form::text('phone', null,['class' => 'form-control']) !!}
 </div>
 <div class="form-group">
 {!! Form::label('email', __('fleet.email'), ['class' => 'form-label']) !!}
 {!! Form::email('email', null,['class' => 'form-control']) !!}
 </div>
  <div class="form-group">
 {!! Form::label('address1', __('fleet.address1'), ['class' => 'form-label']) !!}
 {!! Form::text('address1', null,['class' => 'form-control']) !!}
 </div>
   <div class="form-group">
 {!! Form::label('address2',__('fleet.address2'), ['class' => 'form-label']) !!}
 {!! Form::text('address2', null,['class' => 'form-control']) !!}
 </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Customer</button>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>


@endsection

@section("script")
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/datetimepicker.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
  $("#dept").select2();
$("#create_customer_form").on("submit",function(e){
  $(".print-error-msg").find("ul").html('');
  $(".print-error-msg").hide();
$.ajax({
  type: "POST",
  url: $(this).attr("action"),
  data: $(this).serialize(),
  success: function(data){
  var customers=  $.parseJSON(data);
  $('#customer_id').empty();
   $.each( customers, function( key, value ) {
                $('#customer_id').append($('<option>', {
    value: value.id,
    text: value.text
}));
      });
   $('#exampleModal').modal('hide');
   $("#msg_s").removeClass("hide");

  },
error: function(data){
var errors = $.parseJSON(data.responseText);

        $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").css('display','block');
      $.each( errors, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
      });

      },
  dataType: "html"
});
e.preventDefault();
});
function get_driver(from_date,to_date){
    $.ajax({
  type: "POST",
   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
  url: "{{url('/get_driver')}}",
  data: "req=new&from_date="+from_date+"&to_date="+to_date,
  success: function(data2){
    $("#driver_id").empty();
$("#driver_id").select2({placeholder: 'Select Driver',data:data2.data});


  },

  dataType: "json"
});
  }

  function get_vehicle(from_date,to_date){
    $.ajax({
  type: "POST",
   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

  url: "{{url('/get_vehicle')}}",
  data: "req=new&from_date="+from_date+"&to_date="+to_date,
  success: function(data2){
    $("#vehicle_id").empty();
$("#vehicle_id").select2({placeholder: 'Select Vehicle',data:data2.data});
},

  dataType: "json"
});
  }


    $(document).ready(function() {
      $("#customer_id").on("change",function(){
        var address1=$(this).find(":selected").data("address");
        var newLine = "\r\n";
        var address2=$(this).find(":selected").data("address2");
        var address=address1+newLine+address2;
        $("#pickup_addr").val(address);
        $("#dest_addr").val(address);
      })


  $("#customer_id").select2({placeholder: 'Select Customer'});
  $("#vehicle_id").select2({placeholder: 'Select Vehicle'});
  $("#driver_id").select2({placeholder: 'Select Driver'});
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.addFuel')
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

{!! Form::open(['route' => 'fuel.store','method'=>'post']) !!}
{!! Form::hidden('user_id',Auth::user()->id)!!}
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
   {!! Form::label('vehicle_id',__('fleet.selectVehicle'), ['class' => 'form-label']) !!}
     <select id="vehicle_id" name="vehicle_id" class="form-control" required>
  <option value="">-</option>
  @foreach($vehicles as $vehicle)
  <option value="{{$vehicle->id}}">{{$vehicle->make}} - {{$vehicle->model}} - {{$vehicle->license_plate}}</option>
  @endforeach
   </select>
   </div>

    <div class="form-group">
  {!! Form::label('date',__('fleet.date'), ['class' => 'form-label']) !!}
  <div class='input-group date' id='date'>
  {!! Form::text('date',date("Y-m-d"),['class'=>'form-control','required']) !!}
  <span class="input-group-addon">
  <span class="glyphicon glyphicon-calendar"></span>
  </span>
   </div>
    </div>

    <div class="form-group">
 {!! Form::label('start_meter',__('fleet.start_meter'), ['class' => 'form-label']) !!}
 {!! Form::number('start_meter',null,['class'=>'form-control']) !!}
 <small>@lang('fleet.meter_reading')</small>
 </div>

<div class="form-group">
 {!! Form::label('reference',__('fleet.reference'), ['class' => 'form-label']) !!}
 {!! Form::text('reference',null,['class'=>'form-control']) !!}
 </div>

 <div class="form-group">
 {!! Form::label('province',__('fleet.province'), ['class' => 'form-label']) !!}
 {!! Form::text('province',null,['class'=>'form-control']) !!}
 </div>

 <div class="form-group">
 {!! Form::label('note',__('fleet.note'), ['class' => 'form-label']) !!}
 {!! Form::text('note',null,['class'=>'form-control']) !!}
 </div>
<div class="form-group">
 {!! Form::label('complete', __('fleet.complete_fill_up'), ['class' => 'form-label']) !!}
 {!! Form::checkbox('complete', '1', false,['class'=>'form-check-input']) !!}
 </div>
  </div>
  
  <div class="col-md-6">
    <div class="row">
      <div class="panel panel-default" style="margin-right: 5px">
        <div class="panel-heading form-group">@lang('fleet.fuel_coming_from') </div>
        <div class="panel-body">
          {!! Form::radio('fuel_from', __('fleet.fuel_tank'), ['class'=>'form-control'])!!}
          {!! Form::label('fuel_from', __('fleet.fuel_tank'), ['class' => 'form-label']) !!}
          <br>
          {!! Form::radio('fuel_from', __('fleet.vendor'), ['class'=>'form-control'])!!}
          {!! Form::label('fuel_from', __('fleet.vendor'), ['class' => 'form-label']) !!}
            &nbsp; &nbsp;  &nbsp; &nbsp;
          {!! Form::text('vendor_name',null) !!}


          <br>
          {!! Form::radio('fuel_from',  __('fleet.nd'), ['class'=>'form-control'])!!}
          {!! Form::label('fuel_from',  __('fleet.nd'), ['class' => 'form-label']) !!}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="panel panel-default" style="margin-right: 5px">
        <div class="panel-heading">
          @lang('fleet.fuel')
        </div>
        <div class="panel-body">
          <div class="form-group">
          {!! Form::label('mileage_type','Mileage Type' , ['class' => 'form-label']) !!}
          <br>
          
          {!! Form::radio('mileage_type', 'km', ['class'=>'form-control'])!!}
          {!! Form::label('mileage_type', 'km', ['class' => 'form-label']) !!}
          <br>
          {!! Form::radio('mileage_type', 'miles', ['class'=>'form-control'])!!}
          {!! Form::label('mileage_type', 'miles', ['class' => 'form-label']) !!}
        </div>
          <div class="form-group">
           {!! Form::label('qty',__('fleet.qty').' (Gal)', ['class' => 'form-label']) !!}
           {!! Form::text('qty',"0.00",['class'=>'form-control']) !!}
         </div>

         <div class="form-group">
           {!! Form::label('cost_per_unit',__('fleet.cost_per_unit'), ['class' => 'form-label']) !!}
           {!! Form::text('cost_per_unit',"0.00",['class'=>'form-control']) !!}
         </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
<div class="col-md-12">
{!! Form::submit(__('fleet.add_fuel'), ['class' => 'btn btn-default']) !!}
</div>
</div>
</div>

                </div>

            </div>
        </div>
    </div>



@endsection

@section('script')
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/datetimepicker.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
  $('#date').datetimepicker({format: 'YYYY-MM-DD',sideBySide: true});

  $("#date").on("dp.change", function (e) {
 
  var date=e.date.format("YYYY-MM-DD");

  });
});
</script>
@endsection


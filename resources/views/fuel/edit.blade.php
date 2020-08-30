@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.edit_fuel')
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

{!! Form::open(['route' => ['fuel.update',$data->id],'method'=>'PATCH']) !!}
{!! Form::hidden('user_id',Auth::user()->id)!!}
{!! Form::hidden('vehicle_id',$vehicle_id)!!}
{!! Form::hidden('id',$data->id)!!}
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
 {!! Form::label('vehicle_id',__('fleet.selectVehicle'), ['class' => 'form-label']) !!}

 <select id="vehicle_id" disabled="" name="vehicle_id" class="form-control xxhvk" required>

<option selected value="{{$vehicle_id}}">{{$data->vehicle_data['make']}} - {{$data->vehicle_data['model']}} - {{$data->vehicle_data['license_plate']}}</option>
 </select>
 </div>
      

    <div class="form-group">
  {!! Form::label('date',__('fleet.date'), ['class' => 'form-label']) !!}
  <div class='input-group date' id='date'>
  {!! Form::text('date',$data->date,['class'=>'form-control','required']) !!}
  <span class="input-group-addon">
  <span class="glyphicon glyphicon-calendar"></span>
  </span>
   </div>
    </div>

    <div class="form-group">
 {!! Form::label('start_meter',__('fleet.start_meter'), ['class' => 'form-label']) !!}
 {!! Form::number('start_meter',$data->start_meter,['class'=>'form-control']) !!}
 <small>@lang('fleet.meter_reading')</small>
 </div>

<div class="form-group">
 {!! Form::label('reference',__('fleet.reference'), ['class' => 'form-label']) !!}
 {!! Form::text('reference',$data->reference,['class'=>'form-control']) !!}
 </div>

 <div class="form-group">
 {!! Form::label('province',__('fleet.province'), ['class' => 'form-label']) !!}
 {!! Form::text('province',$data->province,['class'=>'form-control']) !!}
 </div>

 <div class="form-group">
 {!! Form::label('note',__('fleet.note'), ['class' => 'form-label']) !!}
 {!! Form::text('note',$data->note,['class'=>'form-control']) !!}
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
          {!! Form::radio('fuel_from', __('fleet.fuel_tank'),['class'=>'form-control'])!!}
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
           {!! Form::label('qty',__('fleet.qty'), ['class' => 'form-label']) !!}
           {!! Form::text('qty',$data->qty,['class'=>'form-control']) !!}
         </div>

         <div class="form-group">
           {!! Form::label('cost_per_unit',__('fleet.cost_per_unit'), ['class' => 'form-label']) !!}
           {!! Form::text('cost_per_unit',$data->cost_per_unit,['class'=>'form-control']) !!}
         </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
<div class="col-md-12">
{!! Form::submit(__('fleet.update'), ['class' => 'btn btn-warning']) !!}

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


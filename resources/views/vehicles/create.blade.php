@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.addVehicle')

                </div>

                <div class="panel-body">
<div class="row">
<ul class="nav nav-tabs">
    <li class="active"><a href="#info-tab" data-toggle="tab"> @lang('fleet.general_info') <i class="fa"></i></a></li>
    
</ul>

    <div class="tab-content">
        <div class="tab-pane active" id="info-tab">
            {!! Form::open(['route' => 'vehicles.store','files'=>true, 'method'=>'post','class'=>'form-horizontal','id'=>'accountForm']) !!}
            {!! Form::hidden('user_id',Auth::user()->id) !!}
            <div class="col-md-6">
            <div class="form-group" style="margin-top: 20px;">
                {!! Form::label('make', __('fleet.make'), ['class' => 'col-xs-3 control-label']) !!}
                
                <div class="col-xs-5">
                    {!! Form::text('make', null,['class' => 'form-control','required']) !!}
                   
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('model', __('fleet.model'), ['class' => 'col-xs-3 control-label']) !!}
 
                <div class="col-xs-5">
                    {!! Form::text('model', null,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('type', __('fleet.type'), ['class' => 'col-xs-3 control-label']) !!}
                
                
                <div class="col-xs-5">
                    {!! Form::text('type', null,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('year', __('fleet.year'), ['class' => 'col-xs-3 control-label']) !!}
                <div class="col-xs-5">
                {!! Form::number('year', null,['class' => 'form-control','required']) !!}
                   
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('int_mileage', __('fleet.intMileage').' (km)', ['class' => 'col-xs-3 control-label']) !!}
                <div class="col-xs-5">
                    {!! Form::text('int_mileage', null,['class' => 'form-control','required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('vehicle_image', __('fleet.vehicleImage'), ['class' => 'col-xs-3 control-label']) !!}
                <div class="col-xs-5">
                    {!! Form::file('vehicle_image',null,['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('reg_exp_date',__('fleet.reg_exp_date'), ['class' => 'col-xs-3 control-label required']) !!}
                <div class="col-xs-5">
                    {!! Form::text('reg_exp_date', null,['class' => 'form-control','required']) !!}                     
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('in_service', __('fleet.service'), ['class' => 'col-xs-3 control-label']) !!}
               
                <div class="col-xs-5">
                    {!! Form::checkbox('in_service', '1', false,['class'=>'form-check-input']) !!}
                         
                </div>
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group" style="margin-top: 20px;">
                {!! Form::label('engine_type', __('fleet.engine'), ['class' => 'col-xs-3 control-label']) !!}
                <div class="col-xs-5">
                    {!! Form::select('engine_type',["Petrol"=>"Petrol","Diesel"=>"Diesel"],null,['class' => 'form-control','required']) !!}               
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('horse_power', __('fleet.horsePower'), ['class' => 'col-xs-3 control-label']) !!}
                <div class="col-xs-5">
                    {!! Form::text('horse_power', null,['class' => 'form-control','required']) !!}            
                </div>
            </div>
            
            <div class="form-group">
                {!! Form::label('color', __('fleet.color'), ['class' => 'col-xs-3 control-label']) !!}
                <div class="col-xs-5">
                     {!! Form::text('color', null,['class' => 'form-control','required']) !!}          
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('vin', __('fleet.vin'), ['class' => 'col-xs-3 control-label']) !!}
                <div class="col-xs-5">
                     {!! Form::text('vin', null,['class' => 'form-control','required']) !!}         
                </div>
            </div>
             
            <div class="form-group">
                {!! Form::label('license_plate', __('fleet.licensePlate'), ['class' => 'col-xs-3 control-label']) !!}
                <div class="col-xs-5">
                     {!! Form::text('license_plate', null,['class' => 'form-control','required']) !!}       
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('lic_exp_date',__('fleet.lic_exp_date'), ['class' => 'col-xs-3 control-label required']) !!}
                <div class="col-xs-5">
                    {!! Form::text('lic_exp_date', null,['class' => 'form-control','required']) !!}                     
                </div>
            </div>

            
         </div>
<!--          <div class="row" style=" margin-bottom: 20px;">
                <div class="form-group" style="margin-top: 15px;">
                <div class="col-xs-5 col-xs-offset-3">
                    <a href="#address-tab" data-toggle="tab" class="btn btn-default" style="margin-top: 20px;"> @lang('fleet.next')</a>

                </div>
            </div>
            </div> -->

            <div style=" margin-bottom: 20px;">
                <div class="form-group" style="margin-top: 15px;">
                <div class="col-xs-5 col-xs-offset-3">
                    {!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-default']) !!}
                </div>
            </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>

                </div>
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
    $(document).ready(function() {

  $('#start_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#end_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#exp_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#lic_exp_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#reg_exp_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#issue_date').datetimepicker({format: 'YYYY-MM-DD'});


});
</script>
@endsection
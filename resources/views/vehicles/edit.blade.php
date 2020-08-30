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
    <li><a href="#insurance" data-toggle="tab"> @lang('fleet.insurance') <i class="fa"></i></a></li>
    <li><a href="#acq-tab" data-toggle="tab"> @lang('fleet.purchase_info') <i class="fa"></i></a></li>
</ul>

    <div class="tab-content">
        <div class="tab-pane active" id="info-tab">

            {!! Form::open(['route' =>['vehicles.update',$vehicle->id],'files'=>true, 'method'=>'PATCH','class'=>'form-horizontal','id'=>'accountForm']) !!}
            {!! Form::hidden('user_id',Auth::user()->id) !!}
            {!! Form::hidden('id',$vehicle->id) !!}

            <div class="col-md-6">
            <div class="form-group" style="margin-top: 20px;">
                {!! Form::label('make', __('fleet.make'), ['class' => 'col-xs-3 control-label']) !!}

                <div class="col-xs-5">
                    {!! Form::text('make', $vehicle->make,['class' => 'form-control','required']) !!}

                </div>
            </div>

            <div class="form-group">
                {!! Form::label('model', __('fleet.model'), ['class' => 'col-xs-3 control-label']) !!}

                <div class="col-xs-5">
                    {!! Form::text('model', $vehicle->model,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('type', __('fleet.type'), ['class' => 'col-xs-3 control-label']) !!}


                <div class="col-xs-5">
                    {!! Form::text('type', $vehicle->type,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('year', __('fleet.year'), ['class' => 'col-xs-3 control-label']) !!}
                <div class="col-xs-5">
                {!! Form::number('year', $vehicle->year,['class' => 'form-control','required']) !!}

                </div>
            </div>

            <div class="form-group">
                {!! Form::label('int_mileage', __('fleet.intMileage').' (km)', ['class' => 'col-xs-3 control-label']) !!}
                <div class="col-xs-5">
                    {!! Form::text('int_mileage', $vehicle->int_mileage,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">

             {!! Form::label('vehicle_image', __('fleet.vehicleImage'), ['class' => 'col-xs-3 control-label']) !!}


            <div class="col-xs-5">
             {!! Form::file('vehicle_image',null,['class' => 'form-control']) !!}
            </div>
             </div>

             <div class="form-group" style="margin-top: -15px; margin-left: -35px">
            @if($vehicle->vehicle_image != null)
            <a href="{{ asset('uploads/'.$vehicle->vehicle_image) }}" target="_blank" class="col-xs-3 control-label">View</a>
            @endif
            </div>

            <div class="form-group">
                {!! Form::label('in_service', __('fleet.service'), ['class' => 'col-xs-3 control-label']) !!}

                <div class="col-xs-5">
                    @if($vehicle->in_service == '1')
                    {!! Form::checkbox('in_service', '1', true,['class'=>'form-check-input']) !!}
                    @else
                    {!! Form::checkbox('in_service', '1', false,['class'=>'form-check-input']) !!}
                    @endif

                </div>
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group" style="margin-top: 20px;">
                {!! Form::label('engine_type', __('fleet.engine'), ['class' => 'col-xs-3 control-label']) !!}
                <div class="col-xs-5">
                    {!! Form::select('engine_type',["Petrol"=>"Petrol","Diesel"=>"Diesel"],$vehicle->engine_type,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('horse_power', __('fleet.horsePower'), ['class' => 'col-xs-3 control-label']) !!}
                <div class="col-xs-5">
                    {!! Form::text('horse_power', $vehicle->horse_power,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('color', __('fleet.color'), ['class' => 'col-xs-3 control-label']) !!}
                <div class="col-xs-5">
                     {!! Form::text('color', $vehicle->color,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('vin', __('fleet.vin'), ['class' => 'col-xs-3 control-label']) !!}
                <div class="col-xs-5">
                     {!! Form::text('vin', $vehicle->vin,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('license_plate', __('fleet.licensePlate'), ['class' => 'col-xs-3 control-label']) !!}
                <div class="col-xs-5">
                     {!! Form::text('license_plate', $vehicle->license_plate,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('lic_exp_date',__('fleet.lic_exp_date'), ['class' => 'col-xs-3 control-label required']) !!}
                <div class="col-xs-5">
                    {!! Form::text('lic_exp_date', $vehicle->lic_exp_date,['class' => 'form-control','required']) !!}
                </div>
            </div>

               <div class="form-group">
                {!! Form::label('reg_exp_date',__('fleet.reg_exp_date'), ['class' => 'col-xs-3 control-label required']) !!}
                <div class="col-xs-5">
                    {!! Form::text('reg_exp_date', $vehicle->reg_exp_date,['class' => 'form-control','required']) !!}
                </div>
            </div>

         </div>


            <div style=" margin-bottom: 20px;">
                <div class="form-group" style="margin-top: 15px;">
                <div class="col-xs-5 col-xs-offset-3">
                    {!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-default']) !!}
                </div>
            </div>
            </div>
            {!! Form::close() !!}
        </div>

        <div class="tab-pane " id="insurance" >

            {!! Form::open(['url' => 'store_insurance','files'=>true, 'method'=>'post','class'=>'form-horizontal','id'=>'accountForm']) !!}
            {!! Form::hidden('user_id',Auth::user()->id) !!}
            {!! Form::hidden('vehicle_id',$vehicle->id) !!}

            <div class="form-group" style="margin-top: 20px;">
                {!! Form::label('insurance_number', __('fleet.insuranceNumber'), ['class' => 'col-xs-3 control-label']) !!}

                <div class="col-xs-5">
                    {!! Form::text('insurance_number', $vehicle->insurance->ins_number,['class' => 'form-control']) !!}

                </div>
            </div>

            <div class="form-group">
                {!! Form::label('documents', __('fleet.inc_doc'), ['class' => 'col-xs-3 control-label']) !!}

                <div class="col-xs-5">
                    {!! Form::file('documents',null,['class' => 'form-control']) !!}

                </div>
            </div>
            <div class="form-group" style="margin-top: -15px; margin-left: 180px">
                @if($vehicle->insurance->documents != null)
                 <a href="{{ asset('uploads/'.$vehicle->insurance->documents) }}" target="_blank">View</a>
                 @endif
            </div>

            <div class="form-group">
                {!! Form::label('exp_date', __('fleet.inc_expirationDate'), ['class' => 'col-xs-3 control-label required']) !!}
                <div class="col-xs-5">
                    {!! Form::text('exp_date', $vehicle->insurance->ins_exp_date,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div style=" margin-bottom: 20px;">
                <div class="form-group" style="margin-top: 15px;">
                <div class="col-xs-5 col-xs-offset-3">
                    {!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-default']) !!}
                </div>
            </div>
            </div>
            {!! Form::close() !!}

        </div>

        <div class="tab-pane " id="acq-tab" >
<div class="alert alert-success hide fade in alert-dismissable" id="msg_acq">
  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
  <strong>Hurray!</strong> Expense added successfully.
</div>
            <div class="row" style="margin:20px;">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">@lang('fleet.acquisition') @lang('fleet.add')
</div>
<div class="panel-body">

{!! Form::open(['route' => 'acquisition.store','method'=>'post','class'=>'form-inline','id'=>'add_form']) !!}
{!! Form::hidden('user_id',Auth::user()->id) !!}
{!! Form::hidden('vehicle_id',$vehicle->id)  !!}
<div class="form-group">
{!! Form::label('exp_name', __('fleet.expenseType'), ['class' => 'form-label']) !!}
{!! Form::text('exp_name',  null,['class'=>'form-control','required']); !!}
</div>
<div class="form-group"></div>
<div class="form-group">
{!! Form::label('exp_amount', __('fleet.expenseAmount'), ['class' => 'form-label']) !!}
{!! Form::number('exp_amount',null,['class'=>'form-control','required']); !!}
</div>
<div class="form-group"></div>
<button type="submit" class="btn btn-primary">@lang('fleet.add')</button>
{!! Form::close() !!}

</div>
</div>
</div>
</div>
<div class="row" style="margin:20px;">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">@lang('fleet.acquisition') :<strong>{{ $vehicle->make }} {{ $vehicle->model }} {{ $vehicle->license_plate }}</strong>
</div>
<div class="panel-body" id="acq_table">



<div class="row">
<div class="col-md-12">
<table class="table">
<thead>
<th>@lang('fleet.expenseType')</th>
<th>@lang('fleet.expenseAmount')</th>
<th>@lang('fleet.action')</th>
</thead>

<tbody id="hvk">
@php
$i=0;
@endphp
@foreach($vehicle->acq as $row)

<tr>

@php
$i+=$row->exp_amount;
@endphp

<td>{{$row->exp_name}}</td>
<td>{{$row->exp_amount}}</td>
<td>
 {!! Form::open(['route' =>['acquisition.destroy',$row->id],'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]) !!}

       {!! Form::hidden("id",$row->id) !!}
       {!! Form::hidden("vehicle_id",$vehicle->id) !!}

        <button type="button" class="btn btn-danger" data-id="{{$row->id}}" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

        {!! Form::close() !!}
        </td>
</tr>
@endforeach

<tr>
<td><strong>@lang('fleet.total')</strong></td>
<td><strong>{{$i}}</strong></td>
<td></td>
</tr>

</tbody>
</table>
</div>

</div>

</div>
</div>
</div>
</div>

        </div>
    </div>

                </div>
            </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">@lang('fleet.delete')</h4>
                </div>
                <div class="modal-body">
                  <p>@lang('fleet.confirm_delete')</p>
                </div>
                <div class="modal-footer">



                  <button id="del_btn" class="btn btn-danger" type="button" data-submit="">@lang('fleet.delete')</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
              </div>

            </div>
          </div>

<!-- Modal -->
@endsection

@section("script")
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/datetimepicker.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
@if(isset($_GET['tab']) && $_GET['tab']!="")
$('.nav-tabs a[href="#{{$_GET['tab']}}"]').tab('show')
@endif
  $('#start_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#end_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#exp_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#lic_exp_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#reg_exp_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#issue_date').datetimepicker({format: 'YYYY-MM-DD'});

  $("#del_btn").on("click",function(){
    var id=$(this).data("submit");
    $("#form_"+id).submit();
  });
   $('#myModal').on('show.bs.modal', function(e) {
  var id = e.relatedTarget.dataset.id;
  $("#del_btn").attr("data-submit",id);
    });

$("#add_form").on("submit",function(e){

$.ajax({
  type: "POST",
  url: $(this).attr("action"),
  data: $(this).serialize(),
  success: function(data){
    $("#acq_table").empty();
    $("#acq_table").html(data);
    $("#msg_acq").addClass("show").fadeIn(1000);
            },
  dataType: "HTML"
});
e.preventDefault();
});

});
</script>
@endsection
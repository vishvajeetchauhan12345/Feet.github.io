@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
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
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">@lang('fleet.acquisition') :<strong>{{ $vehicle->make }} {{ $vehicle->model }} {{ $vehicle->license_plate }}</strong>
</div>
<div class="panel-body">



<div class="row">
<div class="col-md-12">
<table class="table">
<thead>
<th>@lang('fleet.expenseType')</th>
<th>@lang('fleet.expenseAmount')</th>
<th>Action</th>
</thead>

<tbody id="hvk">
@php
$i=0;
@endphp
@foreach($data as $row)

<tr>

@php
$i+=$row->exp_amount;
@endphp

<td>{{$row->exp_name}}</td>
<td>{{$row->exp_amount}}</td>
<td>
 {!! Form::open(['route' =>['acquisition.destroy',$row->id],'method'=>'DELETE','class'=>'form-horizontal']) !!}

        <input type="hidden" name="id" value="{{ $row->id }}">
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

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
                  <button class="btn btn-danger" data-toggle="tooltip"  title="@lang('fleet.delete')" type="submit">@lang('fleet.delete')</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>

        {!! Form::close() !!}
@endsection


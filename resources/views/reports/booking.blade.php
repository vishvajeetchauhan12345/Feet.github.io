@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.booking_report')</div>

                <div class="panel-body">
                    {!! Form::open(['route' => 'reports.booking','method'=>'post','class'=>'form-inline']) !!}

                    <div class="form-group">
                    {!! Form::label('year', __('fleet.year'), ['class' => 'form-label']) !!}
                    {!! Form::select('year', $years, $year_select,['class'=>'form-control']); !!}
                    </div>
                    <div class="form-group">
                    {!! Form::label('month', __('fleet.month'), ['class' => 'form-label']) !!}
                    {!! Form::selectMonth('month',$month_select,['class'=>'form-control']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('vehicle', __('fleet.vehicles'), ['class' => 'form-label']) !!}
                         <select id="vehicle_id" name="vehicle_id" class="form-control vehicles">
                          <option value="">@lang('fleet.selectVehicle')</option>
                            @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" >{{$vehicle->make}}-{{$vehicle->model}}-{{$vehicle->license_plate}}</option>
                            @endforeach
                          </select>
                    </div>
                      <div class="form-group">
                        {!! Form::label('customer_id', __('fleet.selectCustomer'), ['class' => 'form-label']) !!}
                       <select id="customer_id" name="customer_id" class="form-control vehicles">
                          <option value="">@lang('fleet.selectCustomer')</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" >{{$customer->name}}</option>
                            @endforeach
                          </select>
                    </div>
                    <button type="submit" class="btn btn-primary">@lang('fleet.search')</button>
                    {!! Form::close() !!}

                </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
                <div class="panel-heading"><strong>@lang('fleet.booking_count') {{$bookings->count()}} </strong></div>
                <div class="panel-body">
    <table class="table" id="data_table">
<thead class="thead-inverse">
<tr>

  <th>@lang('fleet.customer')</th>
  <th>@lang('fleet.vehicle')</th>

  <th>@lang('fleet.from_date')</th>
  <th>@lang('fleet.to_date')</th>
  <th>@lang('fleet.passengers')</th>
  <th>@lang('fleet.status')</th>

</tr>
</thead>
<tbody>

@foreach($bookings as $row)
<tr>
  <td>{{$row->customer->name}}</td>
  <td>{{$row->vehicle->make}} - {{$row->vehicle->model}} - {{$row->vehicle->license_plate}}</td>
 
  <td>{{$row->pickup}}</td>
  <td>{{$row->dropoff}}</td>
  <td>{{$row->travellers}}</td>
  <td>@if($row->status===0)<span style="color:orange;">@lang('fleet.journey_not_ended') @else <span style="color:green;">@lang('fleet.journey_ended') @endif</span></td>


</tr>
@endforeach


</tbody>
</table>
    </div>
    </div>
    </div>
    </div>
</div>

@endsection


@section("script")
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$('#data_table').DataTable();
} );</script>
@endsection
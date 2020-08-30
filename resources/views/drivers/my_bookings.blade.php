@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('menu.my_bookings')
                
                </div>

                <div class="panel-body">
<table class="table" id="data_table">
  <thead class="thead-inverse">
    <tr>

      <th>@lang('fleet.customer')</th>
      <th>@lang('fleet.vehicle')</th>
      <th>@lang('fleet.pickup')</th>
      <th>@lang('fleet.dropoff')</th>
      <th>@lang('fleet.passengers')</th>
      
    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
      <td>{{$row->customer['name']}}</td>
      <td>{{$row->vehicle['make']}} - {{$row->vehicle['model']}} - {{$row->vehicle['license_plate']}}</td>
      <td>{{$row->pickup}}</td>
      <td>{{$row->dropoff}}</td>
      <td>{{$row->travellers}}</td>
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

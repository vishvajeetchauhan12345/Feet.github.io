@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.addPartTransaction')</div>

                <div class="panel-body">
{!! Form::open(['route' => 'transaction.store','method'=>'post']) !!}
<div class="col-md-6">
<div class="form-group col-md-12">
{!! Form::label('vehicle_id',__('fleet.selectVehicle'),['class'=>"form-label"]) !!}
    <select id="vehicle_id" name="vehicle_id" class="form-control vehicles" required>
    <option value="">@lang('fleet.selectVehicle')</option>
    @foreach($vehicels as $vehicle)

    <option value="{{ $vehicle->id }}" data-mileage="{{ $vehicle->mileage}}">{{$vehicle->make}}-{{$vehicle->model}}-{{$vehicle->license_plate}}</option>
    @endforeach
  </select>

</div>

  <div class="form-group col-md-4">
  {!! Form::label('cost',__('fleet.cost'),['class'=>"form-label"]) !!}
  {!! Form::number('cost',null,['class'=>"form-control",'required','readonly']) !!}
  </div>

  <div class="form-group col-md-4">
  {!! Form::label('qty',__('fleet.quantity'),['class'=>"form-label"]) !!}
  {!! Form::number('qty','1',['class'=>"form-control",'required']) !!}
  </div>



  <div class="form-group col-md-4">
  {!! Form::label('total',__('fleet.total'),['class'=>"form-label"]) !!}
  {!! Form::number('total',null,['class'=>"form-control",'required','readonly']) !!}
  </div>

  <div class="form-group col-md-12">
  {!! Form::label('serial_no',__('fleet.serialNumber'),['class'=>"form-label"]) !!}
  {!! Form::text('serial_no',null,['class'=>"form-control"]) !!}
  </div>
  </div>
  <div class="col-md-6">
  <div class="form-group col-md-12">
{!! Form::label('part',__('fleet.selectPart'),['class'=>"form-label"]) !!}

  <select id="part" name="part" class="form-control vehicles" required>
  <option value="" >@lang('fleet.selectPart')</option>
    @foreach($parts as $part)
    @if($part->stock>0)
    <option value="{{ $part->id }}" data-max="{{ $part->stock }}" data-amount="{{ $part->get_stock->max('price_local') }}">{{$part->brand}} {{$part->name}} {{$part->oem_ref}}</option>
    @endif
    </option>
    @endforeach
  </select>
  </div>


  <div class="form-group col-md-12">
{!! Form::label('mileage',__('fleet.mileage').' (km)',['class'=>"form-label"]) !!}
  {!! Form::number('mileage',null,['class'=>"form-control",'required']) !!}

</div>

<div class="form-group col-md-12">
{!! Form::label('Date',__('fleet.date'),['class'=>"form-label"]) !!}
  {!! Form::text('date',date("Y-m-d"),['id'=>"date",'class'=>"form-control",'required']) !!}

</div>
</div>
<div class="col-md-12">


  <button type="submit" class="btn btn-primary">@lang('fleet.add')</button>
</div>
</form>

                </div>
            </div>
        </div>
    </div>


<!--                      TABLE             -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.todayTransactions')</div>

                <div class="panel-body">
<table class="table">
  <thead class="thead-inverse">
    <tr>

      <th>@lang('fleet.make')</th>
      <th>@lang('fleet.model')</th>
      <th>@lang('fleet.licensePlate')</th>
      <th>@lang('fleet.partName')</th>
      <th>@lang('fleet.OEM')</th>
      <th>@lang('fleet.cost')</th>
      <th>@lang('fleet.quantity')</th>
      <th>@lang('fleet.total')</th>
      <th>@lang('fleet.date')</th>
      <th>@lang('fleet.mileage') (km)</th>

    </tr>
  </thead>
  <tbody>
  @foreach($today as $row)
     <tr>

      <td>{{$row->vehicle->make}}</td>
      <td>{{$row->vehicle->model}}</td>
      <td>{{$row->vehicle->license_plate}}</td>
      <td>{{$row->part->name}}</td>
      <td>{{$row->part->oem}}</td>
      <td>{{$row->cost}}</td>
      <td>{{$row->qty}}</td>
      <td>{{$row->total}}</td>
      <td>{{$row->date}}</td>
      <td>{{$row->mileage}}</td>

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

<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/datetimepicker.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>

<script type="text/javascript">

function total(){
  $("#total").val($("#qty").val()*$("#cost").val());
}

$(document).ready(function() {
  $(".vehicles").select2();

  $("#vehicle_id").on("change",function(){
    $("#mileage").val($(this).find(':selected').data("mileage"));
    $("#mileage").attr("min",$(this).find(':selected').data("mileage"));
  });

 


$("#cost,#qty").bind('keyup mouseup', function () {
    total();
});


   $('#part').change(function() {
    $("#qty").val("1");
    $("#qty").attr("max",$(this).find(':selected').data('max'));
    $("#cost").val($(this).find(':selected').data('amount'));
    total();
    });



  $('#date').datetimepicker({format: 'YYYY-MM-DD'});
    

});
</script>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">Parts Report</div>

<div class="panel-body">
{!! Form::open(['route' => 'reports.parts','method'=>'post','class'=>'form-inline']) !!}

<div class="form-group">
{!! Form::label('part', __('fleet.partName'), ['class' => 'form-label']) !!}
  <select id="part" name="part" class="form-control vehicles" required>
  <option value="" >Select Part</option>
    @foreach($parts as $part)

    <option value="{{ $part->id }}" >{{$part->brand}} {{$part->name}} {{$part->oem_ref}}</option>

    </option>
    @endforeach
  </select>
</div>
<button type="submit" class="btn btn-primary">@lang('fleet.submit')</button>
</form>

</div>
</div>
</div>
</div>



@if(isset($result))
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">@lang('fleet.report')</div>

<div class="panel-body">

<table class="table table-bordered table-striped table-hover">

<thead>
	<tr>
	<th>@lang('fleet.date')</th>
	<th>@lang('fleet.cost')</th>
	<th>@lang('fleet.vehicles')</th>
	<th>@lang('fleet.mileage') (km)</th>

	</tr>
</thead>
<tbody>
	@foreach($parts2 as $part)
	<tr>
	<td>{{ $part->date }}</td>
	<td>{{ $part->cost }}</td>
<td>{{ $part->vehicle->make }} {{ $part->vehicle->model }} {{ $part->vehicle->license_plate }}</td>
	<td>{{ $part->mileage}}</td>
	</tr>
	@endforeach
</tbody>

</table>

</div>
</div>
</div>
</div>

@endif


</div>
@endsection

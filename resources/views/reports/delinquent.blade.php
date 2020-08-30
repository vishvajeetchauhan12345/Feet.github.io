@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">@lang('fleet.deliquentReport')</div>

<div class="panel-body">
{!! Form::open(['route' => 'reports.delinquent','method'=>'post','class'=>'form-inline']) !!}

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
<option value="{{ $vehicle['id'] }}" @if($vehicle['id']==$vehicle_id) selected @endif>{{$vehicle['make']}}-{{$vehicle['model']}}-{{$vehicle['license_plate']}}</option>
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
<div class="panel-heading">Report</div>

<div class="panel-body">

<table class="table table-bordered table-striped table-hover">
<thead>

	<th>@lang('fleet.day')</th>
	<th>@lang('fleet.date')</th>
	<th>@lang('fleet.vehicle')</th>
	<th>@lang('fleet.income')</th>
	<th>@lang('fleet.expectedIncome')</th>
	<th>@lang('fleet.difference')</th>

</thead>

<tbody>
	@foreach($data as $row)
	<tr>
		<td>{{$row->day}}</td>
		<td>{{$row->date}}</td>
		<td>{{$v[$row->vehicle_id]['make']}}-{{$v[$row->vehicle_id]['model']}}-{{$v[$row->vehicle_id]['license_plate']}}</td>
		<td>{{$row->Income2}}</td>
		<td>{{$income_cats[$row->income_cat]}}</td>
		<td>

		@if(($row->Income2-$income_cats[$row->income_cat])<0)
		<a href="{{ route("income.index")}}">
			{{$row->Income2-$income_cats[$row->income_cat]}}
		</a>
		@else
{{$row->Income2-$income_cats[$row->income_cat]}}
		@endif
		</td>


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


@section("script")
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#vehicle_id").select2();
	});
</script>
@endsection
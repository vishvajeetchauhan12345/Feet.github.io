@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">@lang('fleet.monthlyReport')</div>

<div class="panel-body">
{!! Form::open(['route' => 'reports.monthly','method'=>'post','class'=>'form-inline']) !!}

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
<button type="submit" class="btn btn-primary">@lang('fleet.search')</button>
{!! Form::close() !!}

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

<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-heading">Chart - @lang('fleet.income')</div>

<div class="panel-body">
<canvas id="canvas1" width="400" height="300"></canvas>
</div>
</div>
<table class="table table-bordered table-striped table-hover">
<?php $income_amt = (is_null($income[0]->income) ? 0 : $income[0]->income);?>
<?php $expense_amt = (is_null($expenses[0]->expense) ? 0 : $expenses[0]->expense);?>
<thead>
<tr>
<th scope="row">@lang('fleet.pl')</th>

<td><strong>{{ Hyvikk::get("currency")}}{{ $income_amt-$expense_amt}}</strong></td>
</tr>
</thead>

<tbody>
<tr>
<th scope="row">@lang('fleet.income')</th>

<td>{{ Hyvikk::get("currency")}}{{$income_amt}}</td>
</tr>
<tr>
<th scope="row">@lang('fleet.expenses')</th>

<td>{{ Hyvikk::get("currency")}}{{$expense_amt}}</td>
</tr>


</tbody>
</table>

</div>


<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-heading">Chart - @lang('fleet.incomeByCategory')</div>

<div class="panel-body">
<canvas id="canvas2" width="400" height="300"></canvas>
</div>
</div>
<table class="table table-bordered table-striped table-hover">
<?php
$tot = 0;
foreach ($income_by_cat as $exp) {
	$tot = $tot + $exp->amount;
}
?>
<thead>
<tr>
<th scope="row">@lang('fleet.incomeByCategory')</th>

<td>{{ Hyvikk::get("currency")}}{{$tot}}</td>
</tr>
</thead>
<tbody>


@foreach($income_by_cat as $exp)

<tr>
<th scope="row">{{$income_cats[$exp->income_cat]}}</th>

<td>{{ Hyvikk::get("currency")}}{{$exp->amount}}</td>
</tr>
@endforeach


</tbody>
</table>

</div>

<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-heading">Chart - @lang('fleet.expensesByCategory')</div>

<div class="panel-body">
<canvas id="canvas3" width="400" height="300"></canvas>
</div>
</div>
<table class="table table-bordered table-striped table-hover">
<thead>
    <tr>
    <?php
$tot = 0;
foreach ($expense_by_cat as $exp) {
	$tot = $tot + $exp->expense;
}

?>
<th scope="row">@lang('fleet.expensesByCategory')</th>
<td><strong>{{ Hyvikk::get("currency")}}{{$tot}}</strong></td>
</tr>
</thead>
<tbody>


@foreach($expense_by_cat as $exp)
<tr>
<th scope="row">{{$expense_cats[$exp->expense_type]}}</th>

<td>{{ Hyvikk::get("currency")}}{{$exp->expense}}</td>
</tr>
@endforeach


</tbody>
</table>

</div>



</div>
</div>
</div>

</div>

@endif


</div>
@endsection

@section("script2")

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
<script>
window.chartColors = {
  red: 'rgb(255, 99, 132)',
  orange: 'rgb(255, 159, 64)',
  yellow: 'rgb(255, 205, 86)',
  green: 'rgb(75, 192, 192)',
  blue: 'rgb(54, 162, 235)',
  purple: 'rgb(153, 102, 255)',
  grey: 'rgb(201, 203, 207)',
  black: 'rgb(0,0,0)'
};
function random_color(i){
  var color1,color2,color3;
  var col_arr=[];
  for(x=0;x<=i;x++){

  color1=Math.floor((Math.random() * 255) + 1);
  color2=Math.floor((Math.random() * 255) + 1);
  color3=Math.floor((Math.random() * 255) + 1);
    col_arr.push("rgba("+color1+","+color2+","+color3+",0.5)");
  }
  return col_arr;
}

        var chartData = {
            labels: ["@lang('fleet.income')", "@lang('fleet.expenses')"],
            datasets: [{
                type: 'pie',
                label: '',
                backgroundColor: random_color(2),
                borderColor: window.chartColors.black,
                borderWidth: 1,
                data: [{{@$income_amt}},{{@$expense_amt}}]
            }]
        };
            var chartData2 = {
            labels: [@foreach($income_by_cat as $exp) "{{$income_cats[$exp->income_cat]}}", @endforeach],
            datasets: [{
                type: 'pie',
                label: '',
                backgroundColor: random_color({{count($income_by_cat)}}),
                borderColor: window.chartColors.black,
                borderWidth: 1,
                data: [@foreach($income_by_cat as $exp) {{$exp->amount}}, @endforeach]
            }]
        };
                 var chartData3 = {
            labels: [@foreach($expense_by_cat as $exp) "{{$expense_cats[$exp->expense_type]}}", @endforeach],
            datasets: [{
                type: 'pie',
                label: '',
                backgroundColor: random_color({{count($expense_by_cat)}}),
                borderColor: window.chartColors.black,
                borderWidth: 1,
                data: [@foreach($expense_by_cat as $exp) {{$exp->expense}}, @endforeach]
            }]
        };
        window.onload = function() {
            var ctx = document.getElementById("canvas1").getContext("2d");
            window.myMixedChart = new Chart(ctx, {
                type: 'pie',
                data: chartData,
                options: {

                    responsive: true,
                    title: {
                        display: false,
                        text: "@lang('fleet.chart')"
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true
                    }
                }
            });
                     var ctx = document.getElementById("canvas3").getContext("2d");
            window.myMixedChart = new Chart(ctx, {
                type: 'pie',
                data: chartData3,
                options: {

                    responsive: true,
                    title: {
                        display: false,
                        text: "@lang('fleet.chart')"
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true
                    }
                }
            });

            var ctx = document.getElementById("canvas2").getContext("2d");
            window.myMixedChart = new Chart(ctx, {
                type: 'pie',
                data: chartData2,
                options: {

                    responsive: true,
                    title: {
                        display: false,
                        text: "@lang('fleet.chart')"
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true
                    }
                }
            });
        };

    </script>
@endsection
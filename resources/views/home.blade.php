@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
    <div class="col-md-4">
    <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.chart')</div>
                <div class="panel-body">

                        <canvas id="canvas" width="400" height="375"></canvas>

                </div>
    </div>
    </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.dashboard')</div>
                <div class="panel-body">
            <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-brown">
                      <div class="inner">
                        <h3>{{$users}}</h3>
                        <p>@lang('fleet.users')</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-users"></i>
                      </div>
                      <a href="{{ route("users.index") }}" class="small-box-footer">@lang('fleet.moreinfo')<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>{{$drivers}}</h3>
                  <p>@lang('fleet.drivers')</p>
                </div>
                <div class="icon">
                  <i class="fa fa-id-card"></i>
                </div>
                <a href="{{ route("drivers.index") }}" class="small-box-footer">@lang('fleet.moreinfo')<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
                     <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-violet">
                <div class="inner">
                  <h3>{{$customers}}</h3>
                  <p>@lang('fleet.customers')</p>
                </div>
                <div class="icon">
                  <i class="fa fa-address-book"></i>
                </div>
                <a href="{{ route("customers.index") }}" class="small-box-footer">@lang('fleet.moreinfo')<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-grey">
                <div class="inner">
                  <h3>{{$bookings}}</h3>
                  <p>@lang('fleet.bookings')</p>
                </div>
                <div class="icon">
                  <i class="fa fa-book"></i>
                </div>
                <a href="{{ route("bookings.index") }}" class="small-box-footer">@lang('fleet.moreinfo')<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
                  <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>{{$vehicles}}</h3>
                      <p>@lang('fleet.vehicles')</p>
                    </div>
                    <div class="icon">
                       <i class="fa fa-taxi"></i>
                    </div>
                    <a href="{{ route("vehicles.index") }}" class="small-box-footer">@lang('fleet.moreinfo') <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>


            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3>{{$parts}}</h3>
                  <p>@lang('fleet.parts')</p>
                </div>
                <div class="icon">
                  <i class="fa fa-cog"></i>
                </div>
                <a href="{{ route("parts.index") }}" class="small-box-footer">@lang('fleet.moreinfo') <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{ Hyvikk::get("currency")}}{{$income}}</h3>
                  <p>@lang('fleet.income') </p>

                </div>
                <div class="icon">
                  <i class="fa fa-money"></i>
                </div>
                <a href="{{ route("reports.monthly") }}" class="small-box-footer">( {{date("F")}} )</a>

              </div>
            </div>
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>{{ Hyvikk::get("currency")}}{{$expense}}</h3>
                  <p>@lang('fleet.expense')</p>
                </div>
                <div class="icon">
                  <i class="fa fa-credit-card"></i>
                </div>
<a href="{{ route("reports.monthly") }}" class="small-box-footer">( {{date("F")}} )</a>
              </div>
            </div>

        </div>
    </div>

</div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
                  <div class="panel-heading">@lang('fleet.yearly_chart')</div>
                  <div class="panel-body">
                  <canvas id="yearly" width="800" height="200"></canvas>
                  </div>
      </div>
    </div>
</div>
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
  grey: 'rgb(201, 203, 207)'
};

        var chartData = {
            labels: ["@lang('fleet.income')", "@lang('fleet.expense')"],
            datasets: [{
                type: 'pie',
                label: '',
               backgroundColor: ['rgba(54, 162, 235, 0.5)','rgba(255, 99, 132, 0.5)'],
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: [{{$income}},{{$expense}}]
            }]
        };

              var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var config = {
            type: 'line',
            data: {
                labels: MONTHS,
                datasets: [{
                    label: "@lang('fleet.expense')",
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: [{{$yearly_expense}}],
                    fill: false,
                }, {
                    label: "@lang('fleet.income')",
                    fill: false,
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: [{{$yearly_income}}],
                }]
            },
            options: {
                responsive: true,
                title:{
                    display:false,
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "@lang('fleet.month')"
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "@lang('fleet.amount')"
                        }
                    }]
                }
            }
        };

        window.onload = function() {
          var ctx = document.getElementById("yearly").getContext("2d");
            window.myLine = new Chart(ctx, config);
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myMixedChart = new Chart(ctx, {
                type: 'pie',
                data: chartData,
                options: {

                    responsive: true,
                    title: {
                        display: true,
                        text: '@lang("fleet.monthly_chart") {{date("F")}}'
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
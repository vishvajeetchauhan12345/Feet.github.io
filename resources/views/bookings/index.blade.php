@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.manage_bookings')
                <a href="{{route("bookings.create")}}" class="btn btn-success">@lang('fleet.new_booking')</a>
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
      <th>@lang('fleet.action')</th>

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

      <td>


            {!! Form::open(['url' => 'bookings/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]) !!}

            {!! Form::hidden("id",$row->id) !!}

        <button type="button" class="btn btn-danger" data-id="{{$row->id}}" data-toggle="modal" data-target="#myModal" title="@lang('fleet.delete')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>


        <a href="{{ url('bookings/'.$row->id.'/edit')}}" class="btn btn-warning" data-toggle="tooltip"  title="@lang('fleet.edit')"><span aria-hidden="true" class="glyphicon glyphicon-pencil"></span></a>
        @if($row->status==0)
        <a data-toggle="modal" data-target="#receiptModal" class="open-AddBookDialog btn btn-success" data-toggle="tooltip"  title="@lang('fleet.complete')" data-booking-id="{{$row->id}}" data-user-id="{{$row->user_id}}" data-customer-id="{{$row->customer_id}}" data-vehicle-id= "{{$row->vehicle_id}}"><span aria-hidden="true" class="glyphicon glyphicon-ok"></span></a>
        @else
        <a href="{{ url('bookings/receipt/'.$row->id)}}" class="btn btn-info" data-toggle="tooltip"  title="@lang('fleet.receipt')" ><span aria-hidden="true" class="glyphicon glyphicon-list"></span></a>

        @endif


        {!! Form::close() !!}

      </td>

    </tr>
  @endforeach

  </tbody>
  </table>
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
<div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
         <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.add_payment')

                </div>

                <div class="panel-body">

                  {!! Form::open(['route' => 'bookings.complete','method'=>'post']) !!}



                  <input type="hidden" name="status" id="status" value="1"/>
                  <input type="hidden" name="bookingId" id="bookingId" value=""/>
                  <input type="hidden" name="userId" id="userId" value=""/>
                  <input type="hidden" name="customerId" id="customerId" value=""/>
                  <input type="hidden" name="vehicleId" id="vehicleId" value=""/>
                    <div class="col-md-12">
                      <div class="form-group">
                      <label class="form-label">@lang('fleet.incomeType')</label>
                        <select id="income_type" name="income_type" class="form-control vehicles" required>
                        <option value="">@lang('fleet.incomeType')</option>
                          @foreach($types as $type)
                          <option value="{{ $type->id }}">{{$type->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                        <label class="form-label">@lang('fleet.amount')</label>
                        {!! Form::number('revenue',1,['class'=>'form-control','min'=>1]) !!}
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                        <label class="form-label">@lang('fleet.trip_mileage') (km)</label>
                        {!! Form::number('mileage',1,['class'=>'form-control','min'=>1]) !!}
                        </div>
                      </div>

                      <div class="col-md-12">
                      <div class="form-group">
                      <label class="form-label">@lang('fleet.date')</label>
                      <div class='input-group date' id='date'>
                      {!! Form::text('date',date('Y-m-d'),['class'=>'form-control']) !!}
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                      </div>

                      </div>
                      </div>
                      <div class="col-md-12">
                      {!! Form::submit(__('fleet.record'), ['class' => 'btn btn-info']) !!}

                      </div>
                  {!! Form::close() !!}
                </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
@section("script")
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/datetimepicker.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
  $(".xxhvk").select2();
   $('#date').datetimepicker({
    format: 'YYYY-MM-DD',


    });

});
</script>
<script type="text/javascript">
  $(document).on("click", ".open-AddBookDialog", function () {
     var booking_id = $(this).data('booking-id');
     $(".panel-body #bookingId").val( booking_id );

     var user_id = $(this).data('user-id');
     $(".panel-body #userId").val( user_id );

     var customer_id = $(this).data('customer-id');
     $(".panel-body #customerId").val( customer_id );

     var vehicle_id = $(this).data('vehicle-id');
     $(".panel-body #vehicleId").val( vehicle_id );


});
  $("#del_btn").on("click",function(){
    var id=$(this).data("submit");
    $("#form_"+id).submit();
  });
   $('#myModal').on('show.bs.modal', function(e) {
  var id = e.relatedTarget.dataset.id;
  $("#del_btn").attr("data-submit",id);
    });
</script>
@endsection
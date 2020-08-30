@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.addRecord')</div>

                <div class="panel-body">

                @if (count($errors) > 0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
{!! Form::open(['route' => 'expense.store','method'=>'post','class'=>'form-inline']) !!}


  <select id="vehicle_id" name="vehicle_id" class="form-control vehicles" required>
  <option value="" >@lang('fleet.selectVehicle')</option>
    @foreach($vehicels as $vehicle)
    <option value="{{ $vehicle->id }}">{{$vehicle->make}}-{{$vehicle->model}}-{{$vehicle->license_plate}}</option>
    @endforeach
  </select>

  <select id="expense_type" name="expense_type" class="form-control vehicles" required>
  <option value="" >@lang('fleet.expenseType')</option>
    @foreach($types as $type)
    <option value="{{ $type->id }}" data-amount="{{ $type->cost }}">{{$type->name}}</option>
    @endforeach
  </select>
    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon">@lang('fleet.amount')</div>
  <input required="required" name="revenue" type="number" step="0.01" id="revenue" class="form-control">
  </div>

    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon">@lang('fleet.comment')</div>
  <input  name="comment" type="text" id="comment" class="form-control">
  </div>


<input  name="date" type="text"  id="date" value="{{ date('Y-m-d')}}" class="form-control">
  <button type="submit" class="btn btn-primary">@lang('fleet.add')</button>
</form>

                </div>
            </div>
        </div>
    </div>

<!--                      TABLE             -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">

                  <div class="row">
                  <div class="col-md-3">
                     @lang('fleet.todayExpense') : <strong>{{ $total}}</strong>
                  </div>
                 <div class="col-md-6 pull-right">

                  {!! Form::open(['url'=>'/expense_records','class'=>'form-inline']) !!}

                  <div class="form-group">
                    {!! Form::label('date1','From',['class'=>'control-label']) !!}
                    {!! Form::text('date1', null,['class' => 'form-control','placeholder'=> __('fleet.start_date')]) !!}
                  </div>


                  <div class="form-group ">
                    {!! Form::label('date2','To') !!}
                    {!! Form::text('date2', null,['class' => 'form-control','placeholder'=>__('fleet.end_date')]) !!}
                   </div>


                  <div class="form-group ">
                     {!! Form::submit(__('fleet.search'), ['class' => 'btn btn-default']) !!}
                   </div>

                  {!! Form::close() !!}

                 </div>
                </div>


                </div>

                <div class="panel-body">
<table class="table" id="data_table">
  <thead class="thead-inverse">
    <tr>

      <th>@lang('fleet.make')</th>
      <th>@lang('fleet.model')</th>
      <th>@lang('fleet.licensePlate')</th>
      <th>@lang('fleet.expenseType')</th>
      <th>@lang('fleet.date')</th>
      <th>@lang('fleet.amount')</th>
      <th>@lang('fleet.comment')</th>
      <th>@lang('fleet.delete')</th>
    </tr>
  </thead>
  <tbody>
  @foreach($today as $row)
     <tr>

      <td>{{$row->vehicle->make}}</td>

      <td>{{$row->vehicle->model}}</td>
      <td>{{$row->vehicle->license_plate}}</td>
      <td>{{$row->category->name}}</td>
      <td>{{$row->date}}</td>
      <td>{{$row->amount}}</td>
      <td>{{$row->comment}}</td>
      <td>
        {!! Form::open(['url' => 'expense/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]) !!}

          {!! Form::hidden("id",$row->id) !!}

        <button type="button" class="btn btn-danger" data-id="{{$row->id}}" data-toggle="modal" data-target="#myModal" title="@lang('fleet.delete')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>


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
@endsection


@section("script")

<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/datetimepicker.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $(".vehicles").select2();

  $('#date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#date1').datetimepicker({format: 'YYYY-MM-DD'});
  $('#date2').datetimepicker({format: 'YYYY-MM-DD'});
   $('#expense_type').change(function() {

    $("#revenue").val($(this).find(':selected').data('amount'));

    });

   $("#del_btn").on("click",function(){
    var id=$(this).data("submit");
    $("#form_"+id).submit();
  });
   $('#myModal').on('show.bs.modal', function(e) {
  var id = e.relatedTarget.dataset.id;
  $("#del_btn").attr("data-submit",id);
    });

});
</script>
@endsection

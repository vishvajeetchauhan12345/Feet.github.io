@extends("layouts.app")

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">

                  @lang('fleet.manageFuel')
                <a href="{{ route('fuel.create')}}" class="btn btn-success">@lang('fleet.addNew')</a>
                </div>

                <div class="panel-body">
                    <table class="table" id="data_table">
  <thead class="thead-inverse">
    <tr>
      <th></th>
      <th></th>
      <th>@lang('fleet.date')</th>
      <th>@lang('fleet.qty')</th>
      <th>@lang('fleet.cost')</th>
      <th>@lang('fleet.meter')</th>
      <th>@lang('fleet.consumption')</th>
      <th>@lang('fleet.province')</th>
      <th>@lang('fleet.action')</th>
    </tr>
  </thead>
  <tbody>
@foreach($data as $row)
   <tr>
      <td>
        @if($row->vehicle_data['vehicle_image'] != null)
        <img src="{{url('uploads/'.$row->vehicle_data['vehicle_image'])}}" height="70px" width="70px">
        @else
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHuy_Zxg3ifpNuMtUE1DE_s-qfTPHLfPyOrc_geOvkQm1oSZhA9A" height="70px" width="70px">
      @endif
      </td>
      <td>
        @lang('fleet.unit') #: {{$row->vehicle_data['id']}}
        <br>
        {{$row->vehicle_data['year']}} {{$row->vehicle_data['make']}}-{{$row->vehicle_data['model']}}
        <br>
        @lang('fleet.vin'): {{$row->vehicle_data['vin']}}
        </td>
      <td>{{$row->date}}</td>
      <td> {{$row->qty}} @lang('fleet.gal') </td>
      <td>
        @php ($total = $row->qty * $row->cost_per_unit)
        $ {{$total}}
        <br>
       $ {{$row->cost_per_unit}}/@lang('fleet.gallon')
      </td>
      <td>
       @lang('fleet.start'): {{$row->start_meter}} km
       <br>
       @lang('fleet.end'): {{$row->end_meter}} km
       <br>
       @lang('fleet.distence'):

       @if($row->end_meter == 0)
       0.00 km
       @else
       {{$row->end_meter - $row->start_meter}}
       @endif
      </td>
      <td>
        {{ $row->consumption }} @if($row->mileage_type == "km") KMPG  @else MPG @endif
      </td>
      <td>
        {{$row->province}}
      </td>
      <td>

          {!! Form::open(['url' => 'fuel/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]) !!}

          <a href="{{ url("fuel/".$row->id."/edit")}}" class="btn btn-warning" data-toggle="tooltip"  title="@lang('fleet.edit_fuel')">
          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
          </a>
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

@section('script')
<script type="text/javascript">
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

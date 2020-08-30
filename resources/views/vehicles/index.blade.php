@extends("layouts.app")

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.manageVehicles')
                <a href="{{ route('vehicles.create')}}" class="btn btn-success">@lang('fleet.addNew')</a>
                </div>

                <div class="panel-body">
                    <table class="table" id="data_table">
  <thead class="thead-inverse">
    <tr>
      <th>@lang('fleet.make')</th>
      <th>@lang('fleet.model')</th>
      <th>@lang('fleet.type')</th>
      <th>@lang('fleet.color')</th>
      <th>@lang('fleet.licensePlate')</th>
      <th>@lang('fleet.intMileage') (km)</th>
      <th>@lang('fleet.service')</th>
      <th>@lang('fleet.action')</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
		<td>{{$row->make}}</td>
		<td>{{$row->model}}</td>
		<td>{{$row->type}}</td>
		<td>{{$row->color}}</td>
		<td>{{$row->license_plate}}</td>
		<td>{{$row->int_mileage}}</td>
		<td>{{($row->in_service)?"YES":"NO"}}</td>
      <td>

            {!! Form::open(['url' => 'vehicles/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]) !!}

          <a href="{{ url("vehicles/".$row->id."/edit")}}" class="btn btn-warning" data-toggle="tooltip"  title="@lang('fleet.edit_vehicle')">
          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
          </a>
           {!! Form::hidden("id",$row->id) !!}

        <button type="button" class="btn btn-danger" data-id="{{$row->id}}" data-toggle="modal" data-target="#myModal" title="@lang('fleet.delete_vehicle')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

         <button type="button" class="btn btn-success openBtn" data-id="{{$row->id}}" data-toggle="modal" data-target="#myModal2" id="openBtn" title="@lang('fleet.view_vehicle')">
          <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
         </button>
          
          {!! Form::close() !!}
      </td>

    </tr>
    @endforeach

  </tbody>
  </table>
  {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog" role="document">

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

<!--model 2 -->

<div id="myModal2" class="modal fade" role="dialog" tabindex="-1">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">@lang('fleet.vehicle')</h4>
                </div>
                <div class="modal-body">
                  
                  
                </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">
                Close
              </button>
            </div>
            </div>
          </div>
<!--model 2 -->
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

   $('.openBtn').click(function(){ 
  
    // alert($(this).data("id"));
    var id = $(this).attr("data-id");
    $('#myModal2 .modal-body').load('{{ url("vehicle/event")}}/'+id,function(result){
      $('#myModal2').modal({show:true});
    });
  
  
});
</script>

@endsection

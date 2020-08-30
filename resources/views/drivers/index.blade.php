@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>@lang('menu.drivers')</strong>
                <a href="{{ route('drivers.create')}}" class="btn btn-success">@lang('fleet.addDriver')</a>
                </div>

                <div class="panel-body">
                    <table class="table" id="data_table">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>@lang('fleet.driverImage')</th>
      <th>@lang('fleet.name')</th>
      <th>@lang('fleet.email')</th>
      <th>@lang('fleet.is_active')</th>
      <th>@lang('fleet.phone')</th>
      <th>@lang('fleet.start_date')</th>

      <th>@lang('fleet.action')</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
      <td>{{$row->id}}</td>
      <td>
        @if($row->get_detail['profile_image'] != null)
        <img src="{{url('uploads/'.$row->get_detail['profile_image'])}}" height="70px" width="70px">
        @else
        <img src="http://tektutor.org/wp-content/uploads/2015/07/no-user.jpg" height="70px" width="70px">
        @endif

      </td>
      <td>{{$row->name}}</td>
      <td>{{$row->email}}</td>
      <td>{{($row->get_detail['is_active']) ? "YES" : "NO"}}</td>
      <td>{{$row->get_detail['phone']}}</td>
      <td>{{$row->get_detail['start_date']}}</td>
      <th>


            {!! Form::open(['url' => 'drivers/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]) !!}
<a href="{{ url("/changepass/".$row->id)}}" class="btn btn-info" data-toggle="tooltip"  title="@lang('fleet.change_password')"><i class="fa fa-key"  aria-hidden="true"></i></a>
<a href="{{ url("drivers/".$row->id."/edit")}}" class="btn btn-warning" data-toggle="tooltip"  title="@lang('fleet.edit_driver')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
@if($row->get_detail['is_active'])
<a href="{{ url("drivers/disable/".$row->id)}}" class="btn btn-success" data-toggle="tooltip"  title="@lang('fleet.disable_driver')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
@else
<a href="{{ url("drivers/enable/".$row->id)}}" class="btn btn-success" data-toggle="tooltip"  title="@lang('fleet.enable_driver')"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
@endif

        {!! Form::hidden("id",$row->id) !!}

        <button type="button" class="btn btn-danger" data-id="{{$row->id}}" data-toggle="modal" data-target="#myModal" title="@lang('fleet.delete')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>

        {!! Form::close() !!}
      </th>

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
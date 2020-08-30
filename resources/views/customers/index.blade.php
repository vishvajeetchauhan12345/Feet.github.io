@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.manage_customers')
                <a href="{{route("customers.create")}}" class="btn btn-success">@lang('fleet.add_new')</a>
                </div>

                <div class="panel-body">
                    <table class="table" id="data_table">
  <thead class="thead-inverse">
    <tr>

      <th>@lang('fleet.name')</th>
      <th>@lang('fleet.email')</th>
      <th>@lang('fleet.phone')</th>
      <th>@lang('fleet.address1')</th>
      <th>@lang('fleet.city')</th>
      <th>@lang('fleet.action')</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
      <td>{{$row->name}}</td>
      <td>{{$row->email}}</td>
      <td>{{$row->phone}}</td>
      <td>{{$row->address1}}</td>
      <td>{{$row->city}}</td>

      <td>


            {!! Form::open(['url' => 'customers/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]) !!}
            {!! Form::hidden("id",$row->id) !!}


        <button type="button" class="btn btn-danger" data-id="{{$row->id}}" data-toggle="modal" data-target="#myModal" title="@lang('fleet.delete')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

<a href="{{ url("/customers/".$row->id."/edit")}}" class="btn btn-warning" data-toggle="tooltip"  title="@lang('fleet.edit')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>

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
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#data_table').DataTable();
} );

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
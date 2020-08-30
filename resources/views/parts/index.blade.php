@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.manageStock')
                <a href="{{ route('parts.create')}}" class="btn btn-success">@lang('fleet.addParts')</a>
                </div>

                <div class="panel-body">
                    <table class="table" id="data_table">
  <thead class="thead-inverse">
    <tr>
      <th>@lang('fleet.name')</th>
      <th>@lang('fleet.OEM')</th>
      <th>@lang('fleet.brandRef')</th>
      <th>@lang('fleet.brand')</th>
      <th>@lang('fleet.volume')</th>
      <th>@lang('fleet.action')</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
      <td>{{$row->name}}</td>
      <td>{{$row->oem}}</td>
      <td>{{$row->tp_ref}}</td>
      <td>{{$row->brand}}</td>

      <td>{{$row->stock}}</td>


      <td>


            {!! Form::open(['url' => 'parts/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]) !!}

<a href="{{ url("parts/".$row->id."/edit")}}" class="btn btn-warning" data-toggle="tooltip"  title="@lang('fleet.editParts')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
        {!! Form::hidden("id",$row->id) !!}
       <button type="button" class="btn btn-danger" data-id="{{$row->id}}" data-toggle="modal" data-target="#myModal" title="@lang('fleet.delete')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
         <a href="{{ url("stock/".$row->id)}}" class="btn btn-success" data-toggle="tooltip"  title="@lang('fleet.inventory')"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
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
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.expenseCategories')
                <a href="{{ route('expensecategories.create')}}" class="btn btn-success">@lang('fleet.addNew')</a>
                </div>

                <div class="panel-body">
                    <table class="table" id="data_table">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>@lang('fleet.name')</th>
      <th>@lang('fleet.cost')</th>
      <th>@lang('fleet.frequency')</th>
      <th>@lang('fleet.created')</th>
      <th>@lang('fleet.action')</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
      <td>{{$row->id}}</td>
      <td>{{$row->name}}</td>

      <td>{{$row->cost}}</td>
      <td>{{$row->frequancy}}</td>
      <td>{{substr($row->created_at,0,10)}}</td>
      <th>


            {!! Form::open(['url' => 'expensecategories/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]) !!}

<a href="{{ url("expensecategories/".$row->id."/edit")}}" class="btn btn-warning" data-toggle="tooltip"  title="@lang('fleet.editExpenseType')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>

       {!! Form::hidden("id",$row->id) !!}
        @if($row->type == 'u')

        <button type="button" class="btn btn-danger" data-id="{{$row->id}}" data-toggle="modal" data-target="#myModal" title="@lang('fleet.delete')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        @endif
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

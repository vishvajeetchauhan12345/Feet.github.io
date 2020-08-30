<div class="row">
<div class="col-md-12">
<table class="table">
<thead>
<th>@lang('fleet.expenseType')</th>
<th>@lang('fleet.expenseAmount')</th>
<th>@lang('fleet.action')</th>
</thead>

<tbody id="hvk">
@php
$i=0;
@endphp
@foreach($data as $row)

<tr>

@php
$i+=$row->exp_amount;
@endphp

<td>{{$row->exp_name}}</td>
<td>{{$row->exp_amount}}</td>
<td>
 {!! Form::open(['route' =>['acquisition.destroy',$row->id],'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]) !!}

       {!! Form::hidden("id",$row->id) !!}
       {!! Form::hidden("vehicle_id",$row->vehicle_id) !!}

        <button type="button" class="btn btn-danger" data-id="{{$row->id}}" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

        {!! Form::close() !!}
        </td>
</tr>
@endforeach

<tr>
<td><strong>@lang('fleet.total')</strong></td>
<td><strong>{{$i}}</strong></td>
<td></td>
</tr>

</tbody>
</table>
</div>

</div>
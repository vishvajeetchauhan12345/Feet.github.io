@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.editIncomeType')

                </div>

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

{!! Form::open(['route' => ['incomecategories.update',$incomecategory->id],'method'=>'PATCH']) !!}
{!! Form::hidden('id',$incomecategory->id) !!}
 <div class="form-group">
 {!! Form::label('name', __('fleet.incomeType'), ['class' => 'form-label']) !!}
 {!! Form::text('name', $incomecategory->name,['class' => 'form-control','required']) !!}
 </div>


 <div class="form-group">
 {!! Form::label('cost', __('fleet.incomeAmount')." Expected", ['class' => 'form-label']) !!}
 {!! Form::number('cost', $incomecategory->cost,['class' => 'form-control','required']) !!}
 </div>



<div class="form-group">
{!! Form::submit(__('fleet.update'), ['class' => 'btn btn-default']) !!}

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    </div>
    @endsection

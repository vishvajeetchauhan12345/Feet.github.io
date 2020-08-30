@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.editExpenseType')

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

{!! Form::open(['route' => ['expensecategories.update',$expensecategory->id],'method'=>'PATCH']) !!}
{!! Form::hidden('id',$expensecategory->id) !!}
 <div class="form-group">
 {!! Form::label('name',  __('fleet.expenseType'), ['class' => 'form-label']) !!}
 {!! Form::text('name', $expensecategory->name,['class' => 'form-control','required']) !!}
 </div>
  <div class="form-group">
 {!! Form::label('frequancy', __('fleet.frequency'), ['class' => 'form-label']) !!}
 {!! Form::select('frequancy', ['Daily' => 'Daily', 'Weekly' => 'Weekly','Monthly'=>'Monthly','Quarterly'=>"Quarterly",'Yearly'=>'Yearly'], $expensecategory->frequancy,['class'=>'form-control']); !!}
 </div>
 <div class="form-group">
 {!! Form::label('cost', __('fleet.expenseCost'), ['class' => 'form-label']) !!}
 {!! Form::number('cost', $expensecategory->cost,['class' => 'form-control','required']) !!}
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

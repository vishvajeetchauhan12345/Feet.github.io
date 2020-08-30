@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.addExpenseType')

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

{!! Form::open(['route' => 'expensecategories.store','method'=>'post']) !!}

 <div class="form-group">
 {!! Form::label('name', __('fleet.expenseType'), ['class' => 'form-label']) !!}
 {!! Form::text('name', null,['class' => 'form-control','required']) !!}
 </div>
  <div class="form-group">
 {!! Form::label('frequancy', __('fleet.frequency'), ['class' => 'form-label']) !!}
 {!! Form::select('frequancy', ['Daily' => 'Daily', 'Weekly' => 'Weekly','Monthly'=>'Monthly','Quarterly'=>"Quarterly",'Yearly'=>'Yearly'], null,['class'=>'form-control']); !!}
 </div>

 <div class="form-group">
 {!! Form::label('cost', __('fleet.def_cost'), ['class' => 'form-label']) !!}
 {!! Form::number('cost', null,['class' => 'form-control','required']) !!}
 </div>


<div class="form-group">
{!! Form::submit(__('fleet.save'), ['class' => 'btn btn-default']) !!}

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    </div>
    @endsection

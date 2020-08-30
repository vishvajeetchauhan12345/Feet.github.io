@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.incomeType')

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

{!! Form::open(['route' => 'incomecategories.store','method'=>'post']) !!}

 <div class="form-group">
 {!! Form::label('name', __('fleet.incomeType'), ['class' => 'form-label']) !!}
 {!! Form::text('name', null,['class' => 'form-control','required']) !!}
 </div>


 <div class="form-group">
 {!! Form::label('cost', __('fleet.incomeAmount'), ['class' => 'form-label']) !!}
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.addParts')

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

{!! Form::open(['route' => 'parts.store','method'=>'post']) !!}
{!! Form::hidden("user_id",Auth::user()->id) !!}
<div class="col-md-6">
 <div class="form-group">
 {!! Form::label('name', __('fleet.name'), ['class' => 'form-label']) !!}
 {!! Form::text('name', null,['class' => 'form-control','required']) !!}
 </div>

  <div class="form-group">
 {!! Form::label('oem', __('fleet.OEM'), ['class' => 'form-label']) !!}
 {!! Form::text('oem', null,['class' => 'form-control','required']) !!}
 </div>


</div>


<div class="col-md-6">
<div class="form-group">
 {!! Form::label('brand', __('fleet.brand'), ['class' => 'form-label']) !!}
 {!! Form::text('brand', null,['class' => 'form-control','required']) !!}
 </div>


 <div class="form-group">
 {!! Form::label('tp_ref', __('fleet.brandRef'), ['class' => 'form-label']) !!}
 {!! Form::text('tp_ref', null,['class' => 'form-control','required']) !!}
 </div>

</div>
<div class="col-md-12">
{!! Form::submit(__('fleet.savePart'), ['class' => 'btn btn-default']) !!}

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

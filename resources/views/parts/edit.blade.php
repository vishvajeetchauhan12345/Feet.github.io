@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.editParts')


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

{!! Form::open(['route' => ['parts.update',$data->id],'method'=>'PATCH']) !!}
{!! Form::hidden("user_id",Auth::user()->id) !!}
{!! Form::hidden("id",$data->id)!!}
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('name', __('fleet.name'), ['class' => 'form-label']) !!}
 {!! Form::text('name', $data->name,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-4">
  <div class="form-group">
 {!! Form::label('oem', __('fleet.OEM'), ['class' => 'form-label']) !!}
 {!! Form::text('oem', $data->oem,['class' => 'form-control','required']) !!}
 </div>



</div>


<div class="col-md-4">
<div class="form-group">
 {!! Form::label('brand', __('fleet.brand'), ['class' => 'form-label']) !!}
 {!! Form::text('brand', $data->brand,['class' => 'form-control','required']) !!}
 </div>



</div>
<div class="col-md-12">
{!! Form::submit(__('fleet.update'), ['class' => 'btn btn-default']) !!}

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

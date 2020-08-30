@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.edit_customer')

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

{!! Form::open(['route' => ['customers.update',$data->id],'method'=>'PATCH']) !!}
{!! Form::hidden('id',$data->id) !!}
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('name', __('fleet.name'), ['class' => 'form-label']) !!}
 {!! Form::text('name', $data->name,['class' => 'form-control','required']) !!}
 </div>

 </div>
<div class="col-md-4">
  <div class="form-group">
 {!! Form::label('phone',__('fleet.phone'), ['class' => 'form-label']) !!}
 {!! Form::text('phone', $data->phone,['class' => 'form-control']) !!}
 </div>


</div>
<div class="col-md-4">
<div class="form-group">
 {!! Form::label('email', __('fleet.email'), ['class' => 'form-label']) !!}
 {!! Form::email('email', $data->email,['class' => 'form-control']) !!}
 </div>
</div>
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('address1', __('fleet.address1'), ['class' => 'form-label']) !!}
 {!! Form::text('address1', $data->address1,['class' => 'form-control']) !!}
 </div>

 </div>
<div class="col-md-4">
  <div class="form-group">
 {!! Form::label('address2',__('fleet.address2'), ['class' => 'form-label']) !!}
 {!! Form::text('address2', $data->address2,['class' => 'form-control']) !!}
 </div>


</div>
<div class="col-md-4">
<div class="form-group">
 {!! Form::label('city', __('fleet.city'), ['class' => 'form-label']) !!}
 {!! Form::text('city', $data->city,['class' => 'form-control']) !!}
 </div>
</div>

<div class="col-md-12">
{!! Form::submit(__('fleet.update'), ['class' => 'btn btn-warning']) !!}

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

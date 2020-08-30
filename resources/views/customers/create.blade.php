    @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.add_new')

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

{!! Form::open(['route' => 'customers.store','method'=>'post']) !!}
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('name', __('fleet.name'), ['class' => 'form-label']) !!}
 {!! Form::text('name', null,['class' => 'form-control','required']) !!}
 </div>

 </div>
<div class="col-md-4">
  <div class="form-group">
 {!! Form::label('phone',__('fleet.phone'), ['class' => 'form-label']) !!}
 {!! Form::text('phone', null,['class' => 'form-control']) !!}
 </div>


</div>
<div class="col-md-4">
<div class="form-group">
 {!! Form::label('email', __('fleet.email'), ['class' => 'form-label']) !!}
 {!! Form::email('email', null,['class' => 'form-control']) !!}
 </div>
</div>
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('address1', __('fleet.address1'), ['class' => 'form-label']) !!}
 {!! Form::text('address1', null,['class' => 'form-control']) !!}
 </div>

 </div>
<div class="col-md-4">
  <div class="form-group">
 {!! Form::label('address2',__('fleet.address2'), ['class' => 'form-label']) !!}
 {!! Form::text('address2', null,['class' => 'form-control']) !!}
 </div>


</div>
<div class="col-md-4">
<div class="form-group">
 {!! Form::label('city', __('fleet.city'), ['class' => 'form-label']) !!}
 {!! Form::text('city', null,['class' => 'form-control']) !!}
 </div>
</div>

<div class="col-md-12">
{!! Form::submit(__('fleet.add_new'), ['class' => 'btn btn-info']) !!}

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.addStock')  : <strong>{{$cnt->name}}</strong>

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

{!! Form::open(['route' => 'stock.store','method'=>'post']) !!}
{!! Form::hidden("user_id",Auth::user()->id) !!}
{!! Form::hidden("part_id",$cnt->id) !!}
<div class="col-md-6">
 <div class="form-group">
 {!! Form::label('price_eur', __('fleet.cost'), ['class' => 'form-label']) !!}
 {!! Form::text('price_eur', null,['class' => 'form-control','required']) !!}
 </div>

  <div class="form-group">
 {!! Form::label('transport', __('fleet.transport'), ['class' => 'form-label']) !!}
 {!! Form::text('transport', null,['class' => 'form-control','required']) !!}
 </div>




</div>


<div class="col-md-6">
  <div class="form-group">
 {!! Form::label('customs', __('fleet.customDuties'), ['class' => 'form-label']) !!}
 {!! Form::text('customs', null,['class' => 'form-control','required']) !!}
 </div>
 <div class="form-group">
 {!! Form::label('volume', __('fleet.quantity'), ['class' => 'form-label']) !!}
 {!! Form::number('volume', null,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-12">
{!! Form::submit(__('fleet.addStock'), ['class' => 'btn btn-default']) !!}

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

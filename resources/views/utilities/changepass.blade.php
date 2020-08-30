@extends('layouts.app')
@section('content')

<div class="container">
<div class="row">
<div class="col-md-12 ">
<div class="panel panel-default">
<div class="panel-heading">@lang('fleet.change_details') : <strong>{{ $user_data->name}}</strong></div>
<div class="panel-body">
{{$error}}

{!! Form::open(array("url"=>"changepass/".$user_data->id))!!}
<input type="hidden" name="id" value="{{ $user_data->id}}">
<div class="form-group">
{!! Form::label('name',__('fleet.name'),['class'=>"form-label"]) !!}
{!! Form::text('name',$user_data->name,['class'=>"form-control"]) !!}

</div>

<div class="form-group">
{!! Form::label('email',__('fleet.email'),['class'=>"form-label"]) !!}
{!! Form::text('email',$user_data->email,['class'=>"form-control"]) !!}

</div>


<div class="form-group">
{!! Form::label('passwd',__('fleet.password'),['class'=>"form-label"]) !!}
{!! Form::password('passwd',['class'=>"form-control"]) !!}

</div>

<div class="form-group">


<input type="submit"  class="form-control btn btn-primary"  value="@lang('fleet.change_details')" />
</div>
{!! Form::close()!!}

</div>
</div>
</div>
</div>
</div>
@endsection
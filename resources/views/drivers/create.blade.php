@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.addDriver')

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

{!! Form::open(['route' => 'drivers.store','files'=>true,'method'=>'post']) !!}
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('first_name', __('fleet.firstname'), ['class' => 'form-label required']) !!}
 {!! Form::text('first_name', null,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('middle_name', __('fleet.middlename'), ['class' => 'form-label']) !!}
 {!! Form::text('middle_name', null,['class' => 'form-control']) !!}
 </div>
</div>
<div class="col-md-4">
  <div class="form-group">
 {!! Form::label('last_name', __('fleet.lastname'), ['class' => 'form-label required']) !!}
 {!! Form::text('last_name', null,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-6">
 <div class="form-group">
 {!! Form::label('address', __('fleet.address'), ['class' => 'form-label required']) !!}
 {!! Form::text('address', null,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-6">

<div class="form-group">
 {!! Form::label('email', __('fleet.email'), ['class' => 'form-label required']) !!}
 {!! Form::email('email', null,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-4">
   <div class="form-group">
 {!! Form::label('phone', __('fleet.phone'), ['class' => 'form-label required']) !!}
 {!! Form::text('phone', null,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('emp_id', __('fleet.employee_id'), ['class' => 'form-label']) !!}
 {!! Form::text('emp_id', null,['class' => 'form-control']) !!}
 </div>
</div>
<div class="col-md-4">
    <div class="form-group">
 {!! Form::label('contract_number', __('fleet.contract'), ['class' => 'form-label']) !!}
 {!! Form::text('contract_number', null,['class' => 'form-control']) !!}
 </div>

</div>
<div class="col-md-4">
    <div class="form-group">
 {!! Form::label('license_number', __('fleet.licenseNumber'), ['class' => 'form-label required']) !!}
 {!! Form::text('license_number', null,['class' => 'form-control','required']) !!}
 </div>
</div>

<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('issue_date', __('fleet.issueDate'), ['class' => 'form-label']) !!}
 {!! Form::text('issue_date', null,['class' => 'form-control','required']) !!}
 </div>
</div>

<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('exp_date', __('fleet.expirationDate'), ['class' => 'form-label required']) !!}
 {!! Form::text('exp_date', null,['class' => 'form-control','required']) !!}
 </div>
</div>

<div class="col-md-4">
   <div class="form-group">
 {!! Form::label('end_date', __('fleet.end_date'), ['class' => 'form-label']) !!}
 {!! Form::text('end_date', null,['class' => 'form-control']) !!}
 </div>
</div>
<div class="col-md-4">

  <div class="form-group">
 {!! Form::label('start_date', __('fleet.start_date'), ['class' => 'form-label']) !!}
 {!! Form::text('start_date', null,['class' => 'form-control']) !!}
 </div>
  </div>
<div class="col-md-4">
<div class="form-group">
 {!! Form::label('password', __('fleet.password'), ['class' => 'form-label']) !!}
 {!! Form::password('password', ['class' => 'form-control','required']) !!}
 </div>
</div>

<div class="col-md-6">

 <div class="form-group">
 {!! Form::label('driver_image', __('fleet.driverImage'), ['class' => 'form-label']) !!}

 {!! Form::file('driver_image',null,['class' => 'form-control','required']) !!}
 </div>
  <div class="form-group">
 {!! Form::label('documents', __('fleet.documents'), ['class' => 'form-label']) !!}
 {!! Form::file('documents',null,['class' => 'form-control','required']) !!}
 </div>


<div class="form-group">
 {!! Form::label('license_image', __('fleet.licenseImage'), ['class' => 'form-label']) !!}
 {!! Form::file('license_image',null,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-6">

<div class="form-group">
 {!! Form::label('econtact', __('fleet.emergency_details'), ['class' => 'form-label']) !!}
 {!! Form::textarea('econtact',null,['class' => 'form-control']) !!}
 </div>
</div>

<div class="col-md-12">
{!! Form::submit(__('fleet.saveDriver'), ['class' => 'btn btn-default']) !!}

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/datetimepicker.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

  $('#start_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#end_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#exp_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#issue_date').datetimepicker({format: 'YYYY-MM-DD'});


});
</script>
@endsection

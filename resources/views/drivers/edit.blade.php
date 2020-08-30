@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.edit_driver')

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

{!! Form::open(['route' => ['drivers.update',$driver->id],'files'=>true,'method'=>'PATCH']) !!}
{!! Form::hidden('id',$driver->id) !!}
{!! Form::hidden('edit',"1") !!}
{!! Form::hidden('detail_id',$driver->get_detail->id) !!}
{!! Form::hidden('user_id',Auth::user()->id) !!}
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('first_name', __('fleet.firstname'), ['class' => 'form-label required']) !!}
 {!! Form::text('first_name', $driver->get_detail->first_name,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('middle_name', __('fleet.middlename'), ['class' => 'form-label']) !!}
 {!! Form::text('middle_name', $driver->get_detail->middle_name,['class' => 'form-control']) !!}
 </div>
</div>
<div class="col-md-4">
  <div class="form-group">
 {!! Form::label('last_name', __('fleet.lastname'), ['class' => 'form-label required']) !!}
 {!! Form::text('last_name', $driver->get_detail->last_name,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-6">
 <div class="form-group">
 {!! Form::label('address', __('fleet.address'), ['class' => 'form-label required']) !!}
 {!! Form::text('address', $driver->get_detail->address,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-6">

<div class="form-group">
 {!! Form::label('email', __('fleet.email'), ['class' => 'form-label required']) !!}
 {!! Form::email('email', $driver->email,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-4">
   <div class="form-group">
 {!! Form::label('phone', __('fleet.phone'), ['class' => 'form-label required']) !!}
 {!! Form::text('phone', $driver->get_detail->phone,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('emp_id', __('fleet.employee_id'), ['class' => 'form-label']) !!}
 {!! Form::text('emp_id', $driver->get_detail->emp_id,['class' => 'form-control']) !!}
 </div>
</div>
<div class="col-md-4">
    <div class="form-group">
 {!! Form::label('contract_number', __('fleet.contract'), ['class' => 'form-label']) !!}
 {!! Form::text('contract_number', $driver->get_detail->contract_number,['class' => 'form-control']) !!}
 </div>

</div>
<div class="col-md-4">
    <div class="form-group">
 {!! Form::label('license_number', __('fleet.licenseNumber'), ['class' => 'form-label required']) !!}
 {!! Form::text('license_number', $driver->get_detail->license_number,['class' => 'form-control','required']) !!}
 </div>
</div>

<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('issue_date', __('fleet.issueDate'), ['class' => 'form-label']) !!}
 {!! Form::text('issue_date', $driver->get_detail->issue_date,['class' => 'form-control','required','disabled']) !!}
 </div>
</div>

<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('exp_date', __('fleet.expirationDate'), ['class' => 'form-label required']) !!}
 {!! Form::text('exp_date', $driver->get_detail->exp_date,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-4">

  <div class="form-group">
 {!! Form::label('start_date', __('fleet.start_date'), ['class' => 'form-label']) !!}
 {!! Form::text('start_date', $driver->get_detail->start_date,['class' => 'form-control']) !!}
 </div>
  </div>
<div class="col-md-4">
   <div class="form-group">
 {!! Form::label('end_date', __('fleet.end_date'), ['class' => 'form-label']) !!}
 {!! Form::text('end_date', $driver->get_detail->end_date,['class' => 'form-control']) !!}
 </div>
</div>


<div class="col-md-6">


 <div class="form-group">
 {!! Form::label('driver_image', __('fleet.driverImage'), ['class' => 'form-label']) !!}
@if($driver->get_detail->profile_image != null)
<a href="{{ asset('uploads/'.$driver->get_detail->profile_image) }}" target="_blank">View</a>
@endif
 {!! Form::file('driver_image',null,['class' => 'form-control','required']) !!}
 </div>
  <div class="form-group">
 {!! Form::label('documents', __('fleet.documents'), ['class' => 'form-label']) !!}
 @if($driver->get_detail->documents != null)
 <a href="{{ asset('uploads/'.$driver->get_detail->documents) }}" target="_blank">View</a>
 @endif
 {!! Form::file('documents',null,['class' => 'form-control','required']) !!}
 </div>


<div class="form-group">
 {!! Form::label('license_image', __('fleet.licenseImage'), ['class' => 'form-label']) !!}
 @if($driver->get_detail->license_image != null)
 <a href="{{ asset('uploads/'.$driver->get_detail->license_image) }}" target="_blank">View</a>
 @endif
 {!! Form::file('license_image',null,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-6">

<div class="form-group">
 {!! Form::label('econtact', __('fleet.emergency_details'), ['class' => 'form-label']) !!}
 {!! Form::textarea('econtact',$driver->get_detail->econtact,['class' => 'form-control']) !!}
 </div>
</div>

<div class="col-md-12">
{!! Form::submit(__('fleet.updateDriver'), ['class' => 'btn btn-default']) !!}
<a href="{{route("drivers.index")}}" class="btn btn-danger" >@lang('fleet.back')</a>

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

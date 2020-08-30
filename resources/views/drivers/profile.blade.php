@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: -30px">
  <h1 class="page-header">@lang('fleet.myProfile')</h1>
  <div class="row">
    <!-- left column -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="text-center">
        <h6>@lang('fleet.profile_photo')</h6>

        @if($data->get_detail['profile_image'] != null)
        <img src="{{url('uploads/'.$data->get_detail['profile_image'])}}" class="avatar img-circle img-thumbnail" alt="avatar">
        @else
        <img src="http://tektutor.org/wp-content/uploads/2015/07/no-user.jpg" height="70px" width="70px">
        @endif
        
        
      </div>

      <div class="text-center" style="margin-top: 70px">
        <h6>@lang('fleet.lic_photo')</h6>
        @if($data->get_detail['license_image'] == null)
          <img src="http://besocialchange.org/wp-content/uploads/2014/04/1398730499_seo_reports.jpg" alt="avatar" height="100px" width="70px">
        @else
        <img src="{{url('uploads/'.$data->get_detail['license_image'])}}" class="avatar img-square img-thumbnail" alt="avatar">
        @endif
      </div>
    </div>
    <!-- edit form column -->
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
      @if (count($errors) > 0)
      <div class="alert alert-info alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a> 
        <i class="fa fa-coffee"></i>
        
      </div>
      @endif
      <h3 class="text-center">@lang('fleet.personal_info')</h3>
      {!! Form::open(['files'=>true,'method'=>'POST','class'=>'form-horizontal','role'=>'form']) !!}
      {!! Form::hidden('id',$data->id) !!}
      {!! Form::hidden('user_id',Auth::user()->id) !!}
      
        <div class="form-group" style="margin-top: 30px">
          {!! Form::label('first_name', __('fleet.firstname'), ['class' => 'col-lg-3 control-label']) !!}
          
          <div class="col-lg-8">
            {!! Form::text('first_name', $data->get_detail['first_name'],['class' => 'form-control','disabled']) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('last_name', __('fleet.lastname'), ['class' => 'col-lg-3 control-label']) !!}
          
          <div class="col-lg-8">
            {!! Form::text('last_name', $data->get_detail['last_name'],['class' => 'form-control','disabled']) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('middle_name', __('fleet.middlename'), ['class' => 'col-lg-3 control-label']) !!}
          
          <div class="col-lg-8">
           {!! Form::text('middle_name', $data->get_detail['middle_name'],['class' => 'form-control','disabled']) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('phone', __('fleet.phone'), ['class' => 'col-lg-3 control-label']) !!}
          
          <div class="col-lg-8">
            {!! Form::text('phone', $data->get_detail['phone'],['class' => 'form-control','disabled']) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('license_number', __('fleet.licenseNumber'), ['class' => 'col-lg-3 control-label']) !!}
          
          <div class="col-lg-8">
            {!! Form::text('license_number', $data->get_detail['license_number'],['class' => 'form-control','disabled']) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('address', __('fleet.address'), ['class' => 'col-md-3 control-label']) !!}
         
          <div class="col-md-8">
            {!! Form::text('address', $data->get_detail['address'],['class' => 'form-control','disabled']) !!}
          </div>
        </div>
      
        <div class="form-group">
          {!! Form::label('issue_date', __('fleet.issueDate'), ['class' => 'col-md-3 control-label']) !!}
          <div class="col-md-8">
            {!! Form::date('issue_date', $data->get_detail['issue_date'],['class' => 'form-control','disabled']) !!}  
          </div>
        </div>

        <div class="form-group">
         {!! Form::label('exp_date', __('fleet.expirationDate'), ['class' => 'col-md-3 control-label']) !!}
          <div class="col-md-8" style="margin-bottom: 70px">
            {!! Form::date('exp_date', $data->get_detail['exp_date'],['class' => 'form-control','disabled']) !!}
          </div>
        </div>
 
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')
@section('content')

<div class="container">
<div class="row">
<div class="col-md-12 ">
<div class="panel panel-default">
<div class="panel-heading">@lang('fleet.change_settings')</div>
<div class="panel-body">


{!! Form::open(['route' => 'settings.store','files'=>true,'method'=>'post']) !!}
@foreach($settings as $setting)

<div class="form-group col-md-6">
{!! Form::label($setting->name,__('fleet.'.$setting->name),['class'=>"form-label"]) !!}
@if($setting->name=="language")

{!! Form::select('name['.$setting->name.']', ['en' => 'English', 'de' => 'German', 'es' => 'Spanish', 'fr' => 'French', 'pt' => 'Portuguese'], Hyvikk::get("language"),['class'=>"form-control"]) !!}

@elseif($setting->name=="icon_img")
    @if(Hyvikk::get('icon_img')!= null)
    	<button type="button" class="btn btn-success view1" data-toggle="modal" data-target="#myModal3" id="view" title="@lang('fleet.image')">
          View
         </button>

	@endif
	{!! Form::file('icon_img') !!}

@elseif($setting->name=="logo_img")
	@if(Hyvikk::get('logo_img')!= null)
	<button type="button" class="btn btn-success view2" data-toggle="modal" data-target="#myModal3" id="view" title="@lang('fleet.image')">
          View
         </button>

	@endif
	{!! Form::file('logo_img') !!}
@else

{!! Form::text('name['.$setting->name.']',$setting->value,['class'=>"form-control"]) !!}

@endif
</div>
@endforeach
<div class="form-group">

<input type="submit"  class="form-control btn btn-primary"  value="@lang('fleet.save')" />
</div>
{!! Form::close()!!}

</div>
</div>
</div>
</div>
</div>

<!--model 2 -->

<div id="myModal3" class="modal fade" role="dialog" tabindex="-1">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">

                  		<img src="" class="myimg">


                </div>
              <div class="modal-footer">

              <button type="button" class="btn btn-default" data-dismiss="modal">
                Close
              </button>

            </div>
            </div>
          </div>
<!--model 2 -->
@endsection

@section('script')

<script type="text/javascript">
	$('.view2').click(function(){

    $('#myModal3 .modal-body .myimg').attr( "src","{{ url( Hyvikk::get('logo_img') ) }}");

});
	$('.view1').click(function(){

    $('#myModal3 .modal-body .myimg').attr( "src","{{ url( Hyvikk::get('icon_img') ) }}");

});
</script>
@endsection
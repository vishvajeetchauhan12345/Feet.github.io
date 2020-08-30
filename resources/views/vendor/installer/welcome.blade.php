@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.welcome.title'))
@section('style')
    <link href="{{ asset('installer/froiden-helper/helper.css') }}" rel="stylesheet"/>
    <style>
        .form-control{
            height: 14px;
            width: 100%;
        }
        .has-error{
            color: red;
        }
        .has-error input{
            color: black;
            border:1px solid red;
        }
    </style>
@endsection
@section('container')
    <p class="paragraph" style="text-align: center;">{{ trans('installer_messages.welcome.message') }}</p>
       <form method="post" action="{{ route('LaravelInstaller::welcome') }}" id="env-form">
        {!! csrf_field() !!}
        <div class="form-group">
            <label class="col-sm-2 control-label">your name:</label>

            <div class="col-sm-10">
                <input type="text" name="purchase_code" class="form-control" required>
            </div>
        </div>

        <div class="modal-footer">
            <button class="button" onclick="checkEnv();return false">
                    {{ trans('installer_messages.next') }}
                </button>

        </div>
    </form>
   <script>
        function checkEnv() {
            $.easyAjax({
                url: "{!! route('LaravelInstaller::welcome') !!}",
                type: "POST",
                data: $("#env-form").serialize(),
                container: "#env-form",
                messagePosition: "inline"
            });
        }
    </script>
@endsection
@section('scripts')
    <script src="{{ asset('installer/js/jQuery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('installer/froiden-helper/helper.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection
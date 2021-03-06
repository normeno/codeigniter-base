@extends('layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
    <body class="hold-transition login-page">
    <div class="login-box">

        <div class="login-logo">
            <a href="{{ site_url() }}"><b>Admin</b>LTE</a>
        </div>

        @if (validation_errors() || isset($errors))
            @include('partials.error_validation')
        @endif

        <div class="login-box-body">
            <p class="login-box-msg"> {{ $ci->lang->line('login_to_platform') }} </p>
            {!! form_open('admin/auth/login') !!}
                <input type="hidden" name="_token" value="">

                <div class="form-group has-feedback">
                    {!! form_input(['type' => 'email', 'class' => 'form-control', 'name' => 'identity', 'placeholder' => 'Email']) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    {!! form_input(['type' => 'password', 'class' => 'form-control', 'name' => 'password', 'placeholder' => 'Password']) !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> {{ $ci->lang->line('remember') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ $ci->lang->line('sign_in') }}</button>
                    </div>
                </div>

            {!! form_close() !!}

            <a href="{{ site_url('/password/reset') }}">{{ $ci->lang->line('forgot_password') }}</a>

        </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->

    @include('partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
                increaseArea: '20%' // optional
            });
        });
    </script>
    </body>

@endsection
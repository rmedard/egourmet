@extends('layouts.app')

@section('content')
<div class="container" id="login-page">
    <div class="row">
        <div class="offset-md-2 col-md-8" style="margin-top: 20px;">
            <!--Form with header-->
            <div class="card">
                <div class="card-block">
                    <!--Header-->
                    <div class="form-header elegant-color-dark darken-4">
                        <h3><i class="fa fa-lock"></i> {{trans('gui.login')}}</h3>
                    </div>
                    <!--Body-->
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
                            <i class="fa fa-envelope prefix"></i>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus placeholder="{{trans('gui.email')}}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
                            <i class="fa fa-lock prefix"></i>
                            <input id="password" type="password" class="form-control" name="password" placeholder="{{trans('gui.password')}}">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="text-xs-center">
                            <button class="btn btn-deep-purple" type="submit">Login</button>
                        </div>

                    </form>

                    <!--Footer-->
                    <div class="modal-footer">
                        <div class="options">
                            <p>Not a member? <a href="#">Sign Up</a></p>
                            <p>Forgot <a href="{{ url('/password/reset') }}">Password?</a></p>
                        </div>
                    </div>

                </div>

            </div>
            <!--/Form with header-->
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('styles')
<style>
    .form_container{
        margin-top: 0px !important;
    }
</style>
@endsection
@section('content')
    <!-- page title -->
    <section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="@@page-link">Sign In</a></li>
                        <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                    </ul>
                    <p class="text-lighten">Enter credentials to Sign-in your account </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->
    <!-- ##### Login Area Start ##### -->
    <div class="container h-100 login-margin">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                {{-- <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="{{asset('images/logo2.png')}}" class="brand_logo" alt="Logo">
                    </div>
                </div> --}}
                <div class="d-flex justify-content-center form_container">
                    <form action="{{route('login.authenticate')}}" method="post" id="loginform" style="width: 90%;">
                        {{csrf_field()}}
                        <input type="hidden" name="role" value="User">
                        <div class="input-group mb-3{{ $errors->has('user_name') ? ' has-error' : '' }}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-user fa-2x"></i></span>
                            </div>
                            <input type="text" class="form-control custom-input input_user" name="user_name" value="{{ old('email') }}" placeholder="Username" required="" autocomplete="off">
                            @if ($errors->has('user_name'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('user_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group mb-2{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-key fa-2x"></i></span>
                            </div>
                            <input type="password" class="form-control custom-input input_pass" name="password" placeholder="Password" required="" autocomplete="off">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="button" class="btn btn-secondary login_btn">Login</button>
                        </div>
                    </form>
                </div>
                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        <a href="{{ route('password.request') }}" class="text-white">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $validator->selector('#loginform') !!}
@endsection

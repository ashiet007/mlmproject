@extends('layouts.backend')

@section('content')
    @include('partials.header')
    <h2 class="text-center">Security</h2>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="container alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>{{ $error }}</div>
        @endforeach
    @endif
    <form method="POST" action="{{ route('profile.changeSecurity') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
            <div class="col-md-8">
                <input id="current_password" type="password" class="form-control custom-input" name="current_password" placeholder="CURRENT PASSWORD" required="required">
                @if ($errors->has('current_password'))
                    <span class="help-block">
<strong>{{ $errors->first('current_password') }}</strong>
</span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-md-8">
                <input id="password" type="password" class="form-control custom-input" name="password" placeholder="NEW PASSWORD" required="required">
                @if ($errors->has('password'))
                    <span class="help-block">
<strong>{{ $errors->first('password') }}</strong>
</span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
                <input id="password-confirm" type="password" class="form-control custom-input" name="password_confirmation" placeholder="CONFIRM PASSWORD" required="required">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
                <button class="form-submit btn btn-secondary" type="submit" onclick="return confirm('Confirm update?');">Update Password</button>
            </div>
        </div>
    </form>
    @include('partials.footer')
@endsection
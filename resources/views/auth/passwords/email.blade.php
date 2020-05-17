@extends('layouts.app')

@section('content')
    <!-- page title -->
    <section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="@@page-link">Forget Password</a></li>
                        <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                    </ul>
                    <p class="text-lighten">Our courses offer a good compromise between the continuous assessment favoured by some universities and the emphasis placed on final exams by others.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->
    <div class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ml-auto bg-primary newsletter-block form-border">
                    <h2 class="text-center heading-color">Forget Password</h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('flash_message'))
                        <div class="alert alert-danger">
                            {{ session('flash_message') }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <div class="alert alert-warning">
                                    Enter Your Username to get password on your registered Email.
                                </div>
                                <input id="user_name" type="text" class="form-control custom-input" name="user_name" value="{{ old('user_name') }}" placeholder="Enter your username" required>
                                @if ($errors->has('user_name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-secondary m-2">Send Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

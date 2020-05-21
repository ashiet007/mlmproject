@extends('layouts.backend')
@section('styles')
    <style>
        .section {
            padding-top: 40px;
            padding-bottom: 40px;
        }
        p{
            margin-bottom: 0rem;
        }
        .rounded-circle {
            border-radius: 50%!important;
            width: 40px;
            height: 40px;
            text-align: -webkit-center;
            padding-top: 8px;
            border: 3px solid #182b45!important;
        }
    </style>
@endsection
@section('content')
@include('partials.header')
    <h2 class="text-center heading-color">Pooled Users</h2>
    <section class="section">
        <div class="container">
            <div class="row">
                @if(count($pooledUsers))
                    @foreach($pooledUsers as $item)
                        <!-- blog post -->
                            <article class="col-lg-3 col-sm-3 mb-3">
                                <div class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
                                    <div class="card-body">
                                        <p><h5 class="card-title border border-success rounded-circle">{{$loop->iteration}}</h5></p>
                                        <p class="card-text">Username: <h5 class="card-title">{{$item->user->user_name}}</h5></p>
                                        <p class="card-text">Name: <h5 class="card-title">{{$item->user->name}}</h5></p>
                                        <a href="#" class="btn btn-primary btn-sm">Pool Amount: 5000</a>
                                    </div>
                                </div>
                            </article>
                            <!-- blog post -->
                        @endforeach
                @else
                    <h3>No User Available</h3>
                @endif
            </div>
        </div>
    </section>
@include('partials.footer')
@endsection

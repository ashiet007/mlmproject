@extends('layouts.backend')
@section('styles')
@endsection
@section('content')
@include('partials.header')
    <h2 class="text-center">Total Downline</h2>
    <div class="card-body">
        <div class="container">
            {!! Form::open(['method' => 'GET', 'url' => '/admin/downline/total-downline', 'class' => 'form-inline my-2 my-lg-0 float-right','role' => 'search'])  !!}
            <div class="form-group">
                {!! Form::label('user_name', 'Username', ['class' => 'col-md-4 control-label font-weight-bold']) !!}
                <div class="col-md-8">
                    {!! Form::select('user_name',$username,null,('required' == 'required') ? ['class' => 'js-example-basic-single form-control', 'required' => 'required','placeholder'=> 'Select Username'] : ['class' => 'js-example-basic-single form-control','placeholder'=> 'Select Username']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-4 col-md-4">
                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Show', ['class' => 'btn btn-secondary']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="card-body">
        <div class="table-responsive my-table">
            <table class="table">
                <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Level</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Mobile Number</th>
                    <th>Date of Joining</th>
                    <th>Sponsor ID</th>
                </tr>
                </thead>
                <tbody>
                @if(!is_null($teamDetails))
                    @foreach($teamDetails as $teamDetail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $teamDetail->level }}</td>
                            <td>{{ $teamDetail->user_name }}</td>
                            <td>{{ $teamDetail->name }}</td>
                            <td>{{ $teamDetail->userDetails->mob_no }}</td>
                            <td>{{ $teamDetail->created_at->format('d, M Y h:i:s A') }}</td>
                            <td>{{ $teamDetail->sponsor_id }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@include('partials.footer')
@endsection
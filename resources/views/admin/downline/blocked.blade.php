@extends('layouts.backend')
@section('styles')
@endsection
@section('content')
@include('partials.header')
    <h2 class="text-center">Total Blocked List</h2>
    <div class="container">
        {!! Form::open(['method' => 'GET', 'route' => 'downline.blockedMembers', 'class' => 'form-inline my-2 my-lg-0 float-right'])  !!}
        <div class="form-group">
            {!! Form::label('user_name', 'Username', ['class' => 'col-md-4 control-label font-weight-bold']) !!}
            <div class="col-md-8">
                {!! Form::select('user_name',$username,null,('required' == 'required') ? ['class' => 'js-example-basic-single form-control', 'required' => 'required','placeholder'=> 'Select Username'] : ['class' => 'js-example-basic-single form-control','placeholder'=> 'Select Username']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-4 col-md-4">
                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Filter', ['class' => 'btn btn-secondary p-1']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <div class="table-responsive my-table">
        <table class="table">
            <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Name</th>
                <th>Username</th>
                <th>Mobile Number</th>
                <th>Date of Joining</th>
                <th>Sponsor ID</th>
                <th>Blocked Date</th>
            </tr>
            </thead>
            <tbody>
            @if(!is_null($users))
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->user_name }}</td>
                        <td>{{ $user->userDetails->mob_no }}</td>
                        <td>{{ $user->created_at->format('d, M Y h:i:s A') }}</td>
                        <td>{{ $user->sponsor_id }}</td>
                        <td>{{ $user->updated_at->format('d, M Y h:i:s A') }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@include('partials.footer')
@endsection
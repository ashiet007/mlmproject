@extends('layouts.backend')
@section('styles')
@endsection
@section('content')
@include('partials.header')
    <h2 class="text-center">Total Direct Team</h2>
    <div class="card-body">
        <div class="container">
            {!! Form::open(['method' => 'GET', 'url' => '/admin/downline/total-direct-team', 'class' => 'form-inline my-2 my-lg-0 float-right','role' => 'search'])  !!}
            <div class="form-group">
                {!! Form::label('user_name', 'User_name', ['class' => 'col-md-4 control-label font-weight-bold']) !!}
                <div class="col-md-8">
                    {!! Form::select('user_name',$username,null,('required' == 'required') ? ['class' => 'js-example-basic-single form-control', 'required' => 'required','placeholder'=> 'Select Username'] : ['class' => 'js-example-basic-single form-control','placeholder'=> 'Select Username']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-4 col-md-4">
                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Show', ['class' => 'btn btn-secondary p-2 m-1']) !!}
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
                    <th>Sr No.</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Mobile No.</th>
                    <th>State</th>
                    <th>District</th>
                    <th>Status</th>
                    <th>Current Package</th>
                    <th>Total Direct Team</th>
                    <th>Total Team</th>
                </tr>
                </thead>
                <tbody>
                @if(!is_null($teamDetails))
                    @foreach($teamDetails as $member)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$member->user_name}}</td>
                            <td>{{$member->name}}</td>
                            <td>{{$member->userDetails->mob_no}}</td>
                            <td>{{$member->userDetails->userState->name}}</td>
                            <td>{{$member->userDetails->userDistrict->name}}</td>
                            <td>{{$member->status}}</td>
                            @php
                                $userSetting = $member->userSetting()->first();
                            @endphp
                            <td>{{$userSetting->give_help_amount.'/'.$userSetting->get_help_amount}}</td>
                            <td>{{count(getTotalDirectTeam($member->user_name))}}</td>
                            <td>{{count(getTotalTeam($member->user_name))}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@include('partials.footer')
@endsection
@extends('layouts.backend')

@section('content')
    @include('partials.header')
    <h2 class="text-center">Total Team List</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Sr No.</th>
                <th>Level</th>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile No.</th>
                <th>State</th>
                <th>District</th>
            </tr>
            </thead>
            <tbody>
            @foreach($teamDetails as $member)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$member->level}}</td>
                    <td>{{$member->user_name}}</td>
                    <td>{{$member->name}}</td>
                    <td>{{$member->email}}</td>
                    <td>{{$member->userDetails->mob_no}}</td>
                    <td>{{$member->userDetails->userState->name}}</td>
                    <td>{{$member->userDetails->userDistrict->name}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('partials.footer')
@endsection

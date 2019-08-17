@extends('layouts.backend')

@section('content')
@include('partials.header')
<h2 class="text-center">Direct List</h2>
<div class="table-responsive">
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
            <th>Total Direct Team</th>
            <th>Total Team</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @foreach($team as $member)
            <tr>
                <td>{{$i}}</td>
                <td>{{$member->user_name}}</td>
                <td>{{$member->name}}</td>
                <td>{{$member->userDetails->mob_no}}</td>
                <td>{{$member->userDetails->userState->name}}</td>
                <td>{{$member->userDetails->userDistrict->name}}</td>
                <td>{{$member->status}}</td>
                <td>{{count(getTotalDirectTeam($member->user_name))}}</td>
                <td>{{count(getTotalTeam($member->user_name))}}</td>
            </tr>
            @php
            $i = $i+1;
            @endphp
        @endforeach
        </tbody>
    </table>
</div>
@include('partials.footer')
@endsection

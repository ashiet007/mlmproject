@extends('layouts.backend')

@section('content')
@include('partials.header')
<h2 class="text-center">Active List</h2>
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
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @foreach($activeUsers as $activeUser)
        <tr>
            <td>{{$i}}</td>
            <td>{{$activeUser->user_name}}</td>
            <td>{{$activeUser->name}}</td>
            <td>{{$activeUser->userDetails->mob_no}}</td>
            <td>{{$activeUser->userDetails->userState->name}}</td>
            <td>{{$activeUser->userDetails->userDistrict->name}}</td>
        </tr>
        @php
        $i =$i+1;
        @endphp
        @endforeach
        </tbody>
    </table>
</div>
@include('partials.footer')
@endsection

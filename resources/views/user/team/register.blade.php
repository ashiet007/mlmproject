@extends('layouts.backend')

@section('content')
@include('partials.header')
<h2 class="text-center">Direct Register List</h2>
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
        @foreach($registerUsers as $registerUser)
            <tr>
                <td>{{$i}}</td>
                <td>{{$registerUser->user_name}}</td>
                <td>{{$registerUser->name}}</td>
                <td>{{$registerUser->userDetails->mob_no}}</td>
                <td>{{$registerUser->userDetails->userState->name}}</td>
                <td>{{$registerUser->userDetails->userDistrict->name}}</td>
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

@extends('layouts.backend')
@section('styles')
@endsection
@section('content')
@include('partials.header')
<h2 class="text-center">Total Neglected List</h2>
<div class="table-responsive my-table">
    <table class="table">
        <thead>
        <tr>
            <th>Sr. No.</th>
            <th>Name</th>
            <th>Username</th>
            <th>Mobile Number</th>
            <th>Account Number</th>
            <th>Date of Joining</th>
            <th>Sponsor ID</th>
        </tr>
        </thead>
        <tbody>
        @if(!is_null($neglectedUsers))
            @foreach($neglectedUsers as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data['user']['name'] }}</td>
                    <td>{{ $data['user']['user_name'] }}</td>
                    <td>{{ $data['mob_no'] }}</td>
                    <td>{{ $data['account_no'] }}</td>
                    <td>{{ $data['user']['created_at'] }}</td>
                    <td>{{ $data['user']['sponsor_id'] }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
@include('partials.footer')
@endsection
@extends('layouts.backend')
@section('styles')
@endsection
@section('content')
@include('partials.header')
<h2 class="text-center">Total Pending Links</h2>
<div class="table-responsive my-table">
    <table class="table">
        <thead>
        <tr>
            <th>Sr. No.</th>
            <th>Sender Username</th>
            <th>Sender Name</th>
            <th>Amount</th>
            <th>Receiver Username</th>
            <th>Receiver Name</th>
            <th>Created Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pendingData as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data['user_name'] }}</td>
                <td>{{ $data['name'] }}</td>
                <td>{{ $data['amount'] }}</td>
                <td>{{ $data['rc_user_name'] }}</td>
                <td>{{ $data['rc_name'] }}</td>
                <td>{{ $data['created_date'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@include('partials.footer')
@endsection
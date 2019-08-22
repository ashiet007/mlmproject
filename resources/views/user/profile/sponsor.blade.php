@extends('layouts.backend')

@section('content')
@include('partials.header')
<h2 class="text-center">Sponsor Details</h2>
<div class="table-responsive my-table">
    <table class="table">
        <tbody>
        <tr>
            <th>Sponsor ID</th>
            <td>{{ $sponsorDetails->user_name }}</td>
        </tr>
        <tr>
            <th> Sponsor Name </th>
            <td class="text-capitalize">{{ $sponsorDetails->name }}</td>
        </tr>
        <tr>
            <th> Mobile Number </th>
            <td>{{ $sponsorDetails->userDetails['mob_no'] }}</td>
        </tr>
        <tr>
            <th> Email </th>
            <td>{{ $sponsorDetails->email }}</td>
        </tr>
        </tbody>
    </table>
</div>
@include('partials.footer')

@endsection
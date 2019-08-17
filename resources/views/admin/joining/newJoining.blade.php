@extends('layouts.backend')

@section('content')
@include('partials.header')
    <div class="card-body">
        <h2 class="text-center">Total New Joining</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Mobile No.</th>
                    <th>Sponsor ID</th>
                    <th>DOJ</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach($users as $user)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$user->user_name}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->userDetails->mob_no}}</td>
                        <td>{{$user->sponsor_id}}</td>
                        <td>{{$user->created_at->format('d, M Y h:i:s A')}}</td>
                    </tr>
                    @php
                        $i =$i+1;
                    @endphp
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@include('partials.footer')
@endsection

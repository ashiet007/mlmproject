@extends('layouts.backend')

@section('content')
    @include('partials.header')
    <div class="card-body">
        <h2 class="text-center">Total Registered List</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
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
                        <td>{{$user['user_name']}}</td>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>{{$user['user_details']['mob_no']}}</td>
                        <td>{{$user['sponsor_id']}}</td>
                        <td>{{date('d, M Y h:i:s',strtotime($user['created_at']))}}</td>
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

@extends('layouts.backend')

@section('content')
    @include('partials.header')
    <h2 class="text-center">Pending Pool List</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Sr No.</th>
                <th>Username</th>
                <th>Name</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>Link Status</th>
                <th>Added date</th>
            </tr>
            </thead>
            <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($userData as $item)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$item->user->user_name}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->user->userdetails->mob_no}}</td>
                    <td>{{$item->user->email}}</td>
                    <td>{{ucwords($item->completion_state)}}</td>
                    <td>{{$item->created_at->format('d, M Y h:i:s A')}}</td>
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

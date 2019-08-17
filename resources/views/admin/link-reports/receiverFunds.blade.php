@extends('layouts.backend')

@section('content')
@include('partials.header')
    <h2 class="text-center">Receiver List</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Sr No.</th>
                <th>Username</th>
                <th>Name</th>
                <th>Amount</th>
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
                    <td>{{$user->singleLineIncome->amount}}</td>
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

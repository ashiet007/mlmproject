@extends('layouts.backend')

@section('content')
    @include('partials.header')
    <h2 class="text-center">Total Team List</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Sr No.</th>
                <th>Level</th>
                <th>Username</th>
                <th>Sponsor Id</th>
                <th>Name</th>
                <th>Current Package</th>
                <th>Total Direct</th>
                <th>Total Team</th>
                <th>Status</th>
                <th>DOJ</th>
            </tr>
            </thead>
            <tbody>
            @foreach($teamDetails as $member)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$member->level}}</td>
                    <td>{{$member->user_name}}</td>
                    <td>{{$member->sponsor_id}}</td>
                    <td>{{$member->name}}</td>
                    @php
                    $userSetting = $member->userSetting()->first();
                    @endphp
                    <td>{{$userSetting->give_help_amount.'/'.$userSetting->get_help_amount}}</td>
                    <td>{{count(getTotalDirectTeam($member->user_name))}}</td>
                    <td>{{count(getTotalTeam($member->user_name))}}</td>
                    <td>{{$member->status}}</td>
                    <td>{{$member->created_at->format('d, M Y h:i:s')}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('partials.footer')
@endsection

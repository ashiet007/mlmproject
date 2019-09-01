@extends('layouts.backend')
@section('content')
@include('partials.header')
    <h2 class="text-center">Users</h2>
    <a href="{{ route('exportUserData') }}"><button class="btn btn-secondary float-left mb-3">Download Excel xls</button></a>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Sr. No.</th><th>Sponsor ID</th><th>Name</th><th>Username</th><th>Password</th><th>Email</th><th>Mobile Number</th><th>State</th><th>District</th><th>DOJ</th><th>Identity</th><th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->sponsor_id }}</td>
                    <td>{{ $item->name }}</td><td>{{ $item->user_name }}</td>
                    @if(!is_null($item->userPassword))
                        <td>{{ $item->userPassword->password }}</td>
                    @else
                        <td></td>
                    @endif
                    <td>{{$item->email}}</td>
                    <td>{{ $item->userDetails->mob_no }}</td><td>{{ $item->userDetails->userState->name }}</td>
                    <td>{{ $item->userDetails->userDistrict->name }}</td>
                    <td>{{$item->created_at->format('d, M Y h:i:s A')}}</td>
                    <td>{{$item->identity}}</td>
                    <td>
                        <a href="{{ url('/admin/users/' . $item->id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                        <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@include('partials.footer')
@endsection
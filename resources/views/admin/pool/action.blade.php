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
                <th>Status</th>
                <th>Action date</th>
            </tr>
            </thead>
            <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($data as $item)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$item->user->user_name}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->user->userdetails->mob_no}}</td>
                    <td>{{$item->user->email}}</td>
                    <td>
                        @if($item->status == 'agree')
                            Agreed
                        @elseif($item->status == 'deny')
                            Deny
                        @else
                            Pending
                        @endif
                    </td>
                    <td>{{$item->updated_at->format('d, M Y h:i:s A')}}</td>
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

@extends('layouts.backend')
@section('styles')
@endsection
@section('content')
@include('partials.header')
    <h2 class="text-center">Total Rejected Links</h2>
    <div class="card-body">
        <h2 class="text-center">Total Pre-Rejected Links</h2>
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
                    <th>Rejected Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($preRejectedData as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data['user_name'] }}</td>
                        <td>{{ $data['name'] }}</td>
                        <td>{{ $data['amount'] }}</td>
                        <td>{{ $data['rc_user_name'] }}</td>
                        <td>{{ $data['rc_name'] }}</td>
                        <td>{{ $data['created_date'] }}</td>
                        <td>
                            {!! Form::open(['method' => 'GET', 'route' => 'linkReport.resendRejectedLink', 'class' => 'form-inline '])  !!}
                            <input type="hidden" name="give_help_id" value="{{ $data['id'] }}">
                            <input type="hidden" name="get_help_id" value="{{ $data['get_help_id'] }}">
                            <input type="hidden" name="amount" value="{{ $data['amount'] }}">
                            <input type="submit" class="btn btn-success" value="Resend Link">
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </br>
        </br>
        <h2 class="text-center">Total Post Rejected Links</h2>
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
                    <th>Rejected Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($postRejectedData as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data['user_name'] }}</td>
                        <td>{{ $data['name'] }}</td>
                        <td>{{ $data['amount'] }}</td>
                        <td>{{ $data['rc_user_name'] }}</td>
                        <td>{{ $data['rc_name'] }}</td>
                        <td>{{ $data['created_date'] }}</td>
                        <td>
                            {!! Form::open(['method' => 'GET', 'route' => 'linkReport.resendRejectedLink', 'class' => 'form-inline '])  !!}
                            <input type="hidden" name="give_help_id" value="{{ $data['id'] }}">
                            <input type="hidden" name="get_help_id" value="{{ $data['get_help_id'] }}">
                            <input type="hidden" name="amount" value="{{ $data['amount'] }}">
                            <input type="submit" class="btn btn-success" value="Resend Link">
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@include('partials.footer')
@endsection
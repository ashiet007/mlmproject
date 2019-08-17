@extends('layouts.backend')
@section('content')
@include('partials.header')
<h2 class="text-center">Message</h2>
<a href="{{ url('/user/messages') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
<div class="table-responsive">
    <table class="table">
        <tbody>
        <tr><th>Sender Name</th>
            <td> {{ $messages->user->name }} </td></tr>
        <tr><th>Message</th><td> {{ $messages->message }} </td>
        </tr>
        <tr><th>Date</th> <td>{{ $messages->created_at }}</td></tr>
        </tbody>
    </table>
</div>
@include('partials.footer')
@endsection
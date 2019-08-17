@extends('layouts.backend')
@section('content')
@include('partials.header')
<h2 class="text-center">Messages</h2>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Sr No.</th><th>Sender Name</th><th>Message</th><th>Sent Date</th><th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($messages as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->name }}</td><td>{{ $item->message }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                    <a href="{{ url('/user/messages/' . $item->id) }}" title="View Role"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                    {!! Form::open([
                    'method' => 'DELETE',
                    'url' => ['/user/messages', $item->id],
                    'style' => 'display:inline'
                    ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'title' => 'Delete Role',
                    'onclick'=>'return confirm("Confirm delete?")'
                    )) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination"> {!! $messages->appends(['search' => Request::get('search')])->render() !!} </div>
</div>
@include('partials.footer')
@endsection
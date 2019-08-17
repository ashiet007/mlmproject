@extends('layouts.backend')
@section('content')
@include('partials.header')
    <h2 class="text-center">View Contact</h2>
    <a href="{{ url('/admin/contact') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
    {!! Form::open([
    'method'=>'DELETE',
    'url' => ['admin/contact', $contact->id],
    'style' => 'display:inline'
    ]) !!}
    {!! Form::button('<i class="fas fa-trash-alt"></i> Delete', array(
    'type' => 'submit',
    'class' => 'btn btn-danger btn-sm',
    'title' => 'Delete contact',
    'onclick'=>'return confirm("Confirm delete?")'
    ))!!}
    {!! Form::close() !!}
    <br/>
    <br/>
    <div class="table-responsive">
        <table class="table">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $contact->id }}</td>
                </tr>
                <tr><th> Name </th><td> {{ $contact->name }} </td></tr><tr><th> Email </th><td> {{ $contact->email }} </td></tr>
                <tr>
                    <th> Comment </th>
                    <td> {{ $contact->message }} </td>
                </tr>
                <tr>
                    <th> Created at </th>
                    <td> {{ $contact->created_at }} </td>
                </tr>
            </tbody>
        </table>
    </div>
@include('partials.footer')
@endsection
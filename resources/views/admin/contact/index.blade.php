@extends('layouts.backend')
@section('content')
@include('partials.header')
    <h2 class="text-center">Contacts</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th><th>Name</th><th>Email</th><th>Comment</th><th>Created Date</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contact as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td><td>{{ $item->email }}</td><td>{{ $item->message }}</td><td>{{ $item->created_at }}</td>
                    <td>
                        <a href="{{ url('/admin/contact/' . $item->id) }}" title="View Contact"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                        {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['/admin/contact', $item->id],
                        'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<i class="fas fa-trash-alt"></i> Delete', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-sm',
                        'title' => 'Delete Contact',
                        'onclick'=>'return confirm("Confirm delete?")'
                        )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $contact->appends(['search' => Request::get('search')])->render() !!} </div>
    </div>
@include('partials.footer')
@endsection
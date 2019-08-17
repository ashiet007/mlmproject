@extends('layouts.backend')
@section('content')
@include('partials.header')
    <h2 class="text-center">Edit News #{{ $news->type }}</h2>
    <a href="{{ url('/admin/news') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
    <br />
    <br />
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    {!! Form::model($news, [
    'method' => 'PATCH',
    'url' => ['/admin/news', $news->id],
    'class' => 'form-horizontal',
    'files' => true
    ]) !!}
    @include ('admin.news.form', ['submitButtonText' => 'Update'])
    {!! Form::close() !!}
@include('partials.footer')
@endsection
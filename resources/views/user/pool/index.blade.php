@extends('layouts.backend')
@section('content')
    <div class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ml-auto bg-primary newsletter-block form-border">
                    <h2 class="text-center heading-color">User Pools</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Pool Number</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userPools as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->pool_no}}</td>
                                    <td>
                                        @if($data->status == 'pending')
                                        <div class="row">
                                            <form action="{{route('pool.action')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="pool_id" value="{{$data->id}}">
                                                <input type="hidden" name="action" value="agree">
                                                <button class="btn btn-secondary p-2 mr-1">Agree</button>
                                            </form>
                                            <form action="{{route('pool.action')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="pool_id" value="{{$data->id}}">
                                                <input type="hidden" name="action" value="deny">
                                                <button class="btn btn-secondary p-2 ml-1">Deny</button>
                                            </form>
                                        </div>
                                        @else
                                            @if($data->status == 'agree')
                                            <button class="btn btn-secondary p-2 mr-1">Agreed</button>
                                            @else
                                            <button class="btn btn-secondary p-2 mr-1">Denied</button>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
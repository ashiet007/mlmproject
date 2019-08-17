@extends('layouts.backend')
@section('content')
@include('partials.header')
<h2 class="text-center">Get Helps Working</h2>
<div class="table-responsive">
    <table class="table table-borderless">
        <thead>
        <tr>
            <th>#</th><th>Name</th><th>Username</th><th>Amount</th><th>Status</th><th>Type</th><th>Requested Date</th><th>Actions</th><th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($gethelps as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->name }}</td><td>{{ $item->user->user_name }}</td><td>{{ $item->amount }}</td><td class="text-capitalize">{{ $item->status }}</td><td class="text-capitalize">{{ $item->type }}</td><td>{{ $item->created_at }}</td>
                <td>
                    {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/get-helps-working', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                    {!! Form::button('<i class="fas fa-trash-alt"></i> Delete', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete Get Help Working',
                            'onclick'=>'return confirm("Confirm delete?")'
                    )) !!}
                    {!! Form::close() !!}
                </td>
                @if(count($item->giveHelps) >= 1 )
                    <td><button class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$item->id}}">Show Sub-Transactions</button>
                        <div class="modal" id="myModal{{$item->id}}">
                            <div class="modal-dialog modal-style">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Sub Transactions</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                <tr>
                                                    <th>#</th><th>Sender Name</th><th>Sender Username</th><th>Amount</th><th>Status</th><th>Requested Date</th><th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($item->giveHelps as $giveHelp)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{ $giveHelp->user->name }}</td>
                                                        <td>{{ $giveHelp->user->user_name }}</td>
                                                        <td>{{ $giveHelp->pivot->assigned_amount }}</td>
                                                        <td class="text-capitalize">{{ $giveHelp->pivot->status }}</td>
                                                        <td>{{ $giveHelp->pivot->created_at }}
                                                        </td>
                                                        @if($giveHelp->pivot->status == 'pending')
                                                            <td>
                                                                {!! Form::open(['method' => 'post', 'route' => 'linkReport.deleteLink', 'class' => 'form-inline '])  !!}
                                                                <input type="hidden" name="get_help_id" value="{{ $item->id }}">
                                                                <input type="hidden" name="give_help_id" value="{{ $giveHelp->id }}">
                                                                <input type="hidden" name="amount" value="{{ $giveHelp->pivot->assigned_amount }}">
                                                                <input type="submit" class="btn btn-success" value="Delete">
                                                                {!! Form::close() !!}
                                                            </td>
                                                        @else
                                                            <td><input type="button" class="btn btn-success disabled" value="Delete">
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                @else
                    <td><button class="btn btn-warning disabled">Show Sub-Transactions</button></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@include('partials.footer')

@endsection
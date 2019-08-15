@extends('layouts.backend')
@section('content')
    <div class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ml-auto bg-primary newsletter-block form-border">
                    <h2 class="text-center heading-color">Transaction Reports</h2>
                    <div class="table-responsive my-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Amount</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($getHelps as $getHelp)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $getHelp->amount }}</td>
                                    <td>{{ $getHelp->created_at->format('d, M Y h:i:s A') }}</td>
                                    <td>{{ $getHelp->status }}</td>
                                    @if(count($getHelp->giveHelps) >= 1 )
                                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$getHelp->id}}">Show Sub-Transactions</button>
                                            <div class="modal" id="myModal{{$getHelp->id}}">
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
                                                                        <th>#</th><th>Sender Name</th><th>Sender Username</th><th>Amount</th><th>Status</th><th>Requested Date</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($getHelp->giveHelps as $giveHelp)
                                                                        <tr>
                                                                            <td>{{$loop->iteration}}</td>
                                                                            <td>{{ $giveHelp->user->name }}</td>
                                                                            <td>{{ $giveHelp->user->user_name }}</td>
                                                                            <td>{{ $giveHelp->pivot->assigned_amount }}</td>
                                                                            <td class="text-capitalize">{{ $giveHelp->pivot->status }}</td>
                                                                            <td>{{ $giveHelp->pivot->created_at->format('d, M Y h:i:s A') }}</td>
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
                                        <td><button class="btn btn-primary disabled">Show Sub-Transactions</button></td>
                                    @endif
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
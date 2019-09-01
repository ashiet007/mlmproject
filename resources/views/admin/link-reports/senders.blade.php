@extends('layouts.backend')

@section('content')
@include('partials.header')
<h2 class="text-center">Senders List</h2>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Sr No.</th>
            <th>Username</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Type</th>
            <th>Help Number</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @foreach($giveHelps as $giveHelp)
            <tr>
                <td>{{$i}}</td>
                <td>{{$giveHelp->user->user_name}}</td>
                <td>{{$giveHelp->user->name}}</td>
                <td>{{$giveHelp->amount}}</td>
                <td>{{$giveHelp->type}}</td>
                <td>{{$giveHelp->help_no}}</td>
                <td>{{$giveHelp->status}}</td>
                <td>{{$giveHelp->created_at->format('d, M Y h:i:s A')}}</td>
                <td>{{$giveHelp->match_order_date}}</td>
                <!-- Button to Open the Modal -->
                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$giveHelp->id}}">
                        Change Order
                    </button></td>

                <!-- The Modal -->
                <div class="modal" id="myModal{{$giveHelp->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Change Help Order Timestamp</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="{{route('link.changeOrderGive')}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="giveHelpId" value="{{$giveHelp->id}}">
                                    <div class="form-group">
                                        <label class="control-label">Enter Timestamp</label>
                                        <div class="col-md-8">
                                            <input type="datetime-local" class="form-control" name="match_order_date">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success">
                                    </div>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
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

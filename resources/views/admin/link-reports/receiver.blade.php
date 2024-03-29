@extends('layouts.backend')

@section('content')
@include('partials.header')
    <h2 class="text-center">Receiver List</h2>
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
            @foreach($getHelps as $getHelp)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$getHelp->user->user_name}}</td>
                    <td>{{$getHelp->user->name}}</td>
                    <td>{{$getHelp->amount}}</td>
                    <td>{{$getHelp->type}}</td>
                    <td>{{$getHelp->help_no}}</td>
                    <td>{{$getHelp->status}}</td>
                    <td>{{$getHelp->created_at->format('d, M Y h:i:s A')}}</td>
                    <td>{{$getHelp->match_order_date}}</td>
                    <!-- Button to Open the Modal -->
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$getHelp->id}}">
                        Change Order
                    </button></td>

                    <!-- The Modal -->
                    <div class="modal" id="myModal{{$getHelp->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Change Help Order Timestamp</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="{{route('link.changeOrder')}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="getHelpId" value="{{$getHelp->id}}">
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

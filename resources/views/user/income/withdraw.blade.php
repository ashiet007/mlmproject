@extends('layouts.backend')

@section('content')
<div class="mt-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ml-auto bg-primary newsletter-block form-border">
                <h2 class="text-center heading-color">Income Report</h2>
                <div class="row col-md-8">
                    <h4>Total Income = ₹{{$income['working']}}</h4>
                </div>
                <div class="row col-md-8">
                    <h4>Available Fund = ₹{{ $availableBalance }}</h4>
                    <button class="btn btn-secondary ml-3 mb-3" data-toggle="modal" data-target="#myModal"> Withdraw</button>
                </div>
                <div class="card col-md-12 mb-3 custom-card">
                    <h3 class="text-center text-white mt-3">Transfer Fund to Epin Wallet</h3>
                    <div class="card-body">
                        <form action="{{route('epin.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="available_fund" value="{{ $availableBalance }}">
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input class="form-control custom-input" type="number" name="amount" placeholder="Enter Amount" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-secondary m-2">Transfer </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-0 border-0 p-4">
            <div class="modal-header border-0">
                <h3>Withdraw Fund</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('income.workingWithrawal')}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="balance" class="form-control" value="{{$availableBalance}}">
                    <div class="col-12">
                        <input type="hidden" id="userId" name="user_id">
                        <input type="number" class="form-control mb-3" name="amount" placeholder="Enter Amount" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Withdraw</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
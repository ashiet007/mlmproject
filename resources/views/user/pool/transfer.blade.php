@extends('layouts.backend')

@section('content')
    <div class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ml-auto bg-primary newsletter-block form-border">
                    <h2 class="text-center heading-color">Transfer to Fund Wallet</h2>
                    <div class="row col-md-8">
                        <h4>Total Income = ₹{{$userPoolFund}}</h4>
                    </div>
                    <div class="row col-md-8">
                        <h4>Available Fund = ₹{{ $availableFund }}</h4>
                    </div>
                    <div class="card col-md-12 mb-3 custom-card">
                        <div class="card-body">
                            <form action="{{route('pool.fundTransfer')}}" method="post">
                                @csrf
                                <input type="hidden" name="available_fund" value="{{ $availableFund }}">
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
@endsection
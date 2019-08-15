@extends('layouts.backend')
@section('content')
<div class="mt-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ml-auto bg-primary newsletter-block form-border">
                <h2 class="text-center heading-color">Generate Epin</h2>
                <div class="row col-md-8">
                    <h4>Total Fund = ₹2000</h4>
                </div>
                <div class="row col-md-8">
                    <h4>Available Fund = ₹1000</h4>
                </div>
                <div class="card col-md-12 mb-3 custom-card">
                    <div class="card-body">
                        <form action="{{route('epin.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="available_fund" value="1000">
                            <div class="form-group">
                                <label class="control-label col-md-4">Amount</label>
                                <div class="col-md-8">
                                    <select class="form-control custom-input" name="amount" required>
                                        <option value="">--Select Amount--</option>
                                        <option value="250">₹250</option>
                                        <option value="500">₹500</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">No Of Epin</label>
                                <div class="col-md-8">
                                    <input class="form-control custom-input" type="number" name="no_of_epin" placeholder="Enter number of Epin" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-secondary m-2">Generate </button>
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
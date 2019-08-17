@extends('layouts.backend')
@section('content')
    @include('partials.header')
        <h2 class="text-center heading-color">Generate Epin</h2>
        <div class="card col-md-12 mb-3 custom-card">
            <div class="card-body">
                <form action="{{route('adminEpin.store')}}" method="post">
                    @csrf
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
    @include('partials.footer')
@endsection
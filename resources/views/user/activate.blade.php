@extends('layouts.backend')
@section('content')
    <div class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ml-auto bg-primary newsletter-block form-border">
                    <h2 class="text-center heading-color">Activate Account</h2>
                    <div class="card col-md-12 mb-3 custom-card">
                        <div class="card-body">
                            <form action="{{route('user.activate')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="col-md-8">
                                        <select class="form-control custom-input" id="pinId" name="epin_id" required>
                                            <option value="">--Select Epin--</option>
                                            @foreach($unusedEpins as $epin)
                                            <option data-pin-amount="{{$epin->amount}}" value="{{$epin->id}}">{{$epin->pin}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8">
                                        <input  id="amount" class="form-control custom-input" type="number" name="amount" placeholder="Epin Amount" readonly="readonly" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-secondary m-2">Activate </button>
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
@section('scripts')
    <script>
        $('#pinId').change(function (event) {
            $('#amount').val('');
            let amount = $(this).find(':selected').data('pin-amount');
            $('#amount').val(amount);
        })
    </script>
@endsection
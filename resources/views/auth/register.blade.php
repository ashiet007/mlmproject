@extends('layouts.app')
@section('styles')

    <style type="text/css">
        .text-style1 {
            text-transform: uppercase;
        }

        .text-style2 {
            text-transform: lowercase;
        }
    </style>
@endsection
@section('content')
    <!-- page title -->
    <section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="@@page-link">Register With Us</a></li>
                        <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                    </ul>
                    <p class="text-lighten">Our courses offer a good compromise between the continuous assessment favoured by some universities and the emphasis placed on final exams by others.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->
    <div class="mt-5 mb-5 register-form">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ml-auto bg-primary newsletter-block form-border">
                    <h2 class="text-center heading-color">Register</h2>
                    <form action="{{route('register.create')}}" method="post" id="registerform">
                        {{csrf_field()}}
                        <h3 class="text-capitalize heading-color">Sponsor Details</h3>
                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <input id="sponsorId" type="text" class="margin2 form-control custom-input" name="sponsor_id" value="{{!empty($sponsorDetails) ? $sponsorDetails['user_name']:old('sponsor_id')}}" placeholder="SPONSOR ID" required="" onchange="getSponsorDetails();" autocomplete="off">
                                @if ($errors->has('sponsor_id'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('sponsor_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <input id="sponsorName" type="text" class="form-control custom-input text-style1" name="sponsor_name" value="{{!empty($sponsorDetails) ? $sponsorDetails['name']:old('sponsor_name')}}" placeholder="SPONSOR NAME" required="" readonly="readonly">
                                @if ($errors->has('sponsor_name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('sponsor_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <h3 class="text-capitalize heading-color">Personal Details</h3>
                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <input id="name" type="text" class="margin2 custom-input form-control text-style1" name="name" value="{{ old('name') }}" placeholder="FULL NAME AS PER BANK DETAILS" required="" autocomplete="off">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <input id="user_name" type="text" class="form-control custom-input text-style2" name="user_name" value="{{ old('user_name') }}" placeholder="USERNAME" required="" autocomplete="off">
                                @if ($errors->has('user_name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <select class="margin2 form-control custom-input" name="state_id" id="state" required="" onchange="getdistricts();" autocomplete="off">
                                    <option value="">-- SELECT STATE --</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}" {{$state->id == old('state_id') ? 'selected':''}}>{{$state->name}}</option>
                                    @endforeach
                                    @if ($errors->has('state_id'))
                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('state_id') }}</strong>
                                    </span>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <select class="form-control custom-input" name="district_id" required id="district" required="" autocomplete="off">
                                    <option value="">-- SELECT DISTRICT --</option>
                                    @if ($errors->has('district_id'))
                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('district_id') }}</strong>
                                    </span>
                                    @endif
                                </select>

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <input id="mobile" type="number" class="margin2 form-control custom-input" name="mob_no" value="" placeholder="MOBILE NUMBER" required="" autocomplete="off">
                                @if ($errors->has('mob_no'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('mob_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <input id="email" type="email" class="margin2 form-control custom-input" name="email" value="" placeholder="EMAIL" required="" autocomplete="off">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <h3 class="text-capitalize heading-color">Bank Details</h3>
                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <select id="bank_name" class="margin2 form-control custom-input" name="bank_id" required="" autocomplete="off">
                                    <option value="">-- SELECT BANK --</option>
                                    @foreach($banks as $bank)
                                        <option value="{{$bank->id}}" {{$bank->id == old('bank_id') ? 'selected':''}}>{{$bank->name}}</option>
                                    @endforeach
                                    @if ($errors->has('bank_id'))
                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('bank_id') }}</strong>
                                    </span>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <input id="account-number" type="text" class="form-control custom-input" name="account_no" value="{{ old('account_no') }}" placeholder="ACCOUNT NUMBER" required="" autocomplete="off">
                                @if ($errors->has('account_no'))
                                    <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('account_no') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <select id="account-type" class="margin2 form-control custom-input text-style1" placeholder="SELECT ACCOUNT TYPE" name="account_type" required="" autocomplete="off">
                                    <option value="SAVING"> Saving</option>
                                    <option value="CURRENT"> Current</option>
                                    @if ($errors->has('account_type'))
                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('account_type') }}</strong>
                                    </span>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <input id="ifsc-code" type="text" class="form-control custom-input custom-input text-style1" name="ifsc_code" value="{{ old('ifsc_code') }}" placeholder="BANK IFSC CODE" autocomplete="off">
                                @if ($errors->has('ifsc_code'))
                                    <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('ifsc_code') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <input id="branch" type="text" class="form-control custom-input text-style1" name="branch" value="{{ old('branch') }}" placeholder="BANK BRANCH" required="" autocomplete="off">
                                @if ($errors->has('branch'))
                                    <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('branch') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <h3 class="text-capitalize heading-color">Wallet Details</h3>
                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <input id="paytm" type="number" class="margin2 form-control custom-input" name="paytm_no" value="{{ old('paytm_no') }}" placeholder="PAYTM NUMBER (OPTIONAL)" autocomplete="off">
                                @if ($errors->has('paytm_no'))
                                    <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('paytm_no') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <input id="gpay" type="number" class="form-control custom-input" name="gpay_no" value="{{ old('gpay_no') }}" placeholder="GPAY/PHONEPAY NUMBER (OPTIONAL)" autocomplete="off">
                                @if ($errors->has('gpay_no'))
                                    <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('gpay_no') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <input id="bitcoin" type="text" class="form-control custom-input" name="bitcoin_add" value="{{ old('bitcoin_add') }}" placeholder="BITCOIN ADDRESS" autocomplete="off">
                                @if ($errors->has('bitcoin_add'))
                                    <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('bitcoin_add') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <h3 class="text-capitalize heading-color">Password Details</h3>
                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <input id="password" type="password" class="margin2 form-control custom-input" name="password" placeholder="PASSWORD" required="" autocomplete="off">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <input id="password-confirm" type="password" class="form-control custom-input" name="password_confirmation" placeholder="CONFIRM PASSWORD" required="" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group1 mt-3">
                            <button type="button" class="btn btn-secondary m-2 nextBtn"> Next </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5 mb-5 preview-form d-none">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ml-auto bg-primary newsletter-block form-border">
                    <h2 class="text-center heading-color mb-5">Preview</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Sponsor Id:</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewSponsorId"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Sponsaor Name:</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewSponsorName"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Name:</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewName"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Username</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewUserName"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>State</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewState"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>District</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewDistrict"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Email</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewEmail"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Mobile Number</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewMobNumber"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Bank Name</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewBankName"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Account Number</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewAccNumber"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Bank Branch</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewBranch"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>IFSC Code</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewIfscCode"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Account Type</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewAccType"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Paytm Number</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewPaytmNumber"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Gpay/Phonepay Number</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewGpayNumber"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Bitcoin Address</h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="previewBitcoin"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group1 mt-3 col-md-2">
                            <button type="button" class="btn btn-secondary m-2 preBtn"> Previous </button>
                        </div>
                        <div class="input-group1 mt-3 col-md-2">
                            <button type="button" class="btn btn-secondary m-2 submit"><i class="fa fa-spinner fa-spin d-none submit-loader"></i> Submit </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content rounded-0 border-0 p-4">
                <div class="modal-header border-0">
                    <h3>Mobile Number Verification</h3>
                </div>
                <div class="modal-body">
                    <div class="message">

                    </div>
                    <div class="form-group row">
                        <input id="sentOtp" type="hidden" name="sentOtp" value="{{Session::get('otp')}}" id="sentOtp">
                        <div class="col-md-12">
                            <input type="number" name="otp" class="form-control" id="otp" placeholder="Enter OTP">
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="button" class="btn btn-primary" id="resend"></button>
                            <button type="button" class="btn btn-primary" id="verifyOtp"><i class="fa fa-spinner fa-spin d-none verify-loader"></i> Verify OTP</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $validator->selector('#registerform') !!}
    <script>
        $('.submit').click(function () {
            if($('#registerform').valid())
            {
                $('.submit-loader').removeClass('d-none');
                var number = $('#mobile').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('register.sendOtp') }}",
                    method: 'post',
                    data: {
                        number: number
                    },
                    success: function (result) {
                        $('.submit-loader').addClass('d-none');
                        $('#sentOtp').val(result.otp);
                        $('#exampleModal').modal('show');
                        var successHtml = '<div class="alert alert-success">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></i></strong> '+ result.message +
                            '</div>';
                        $('.message').html(successHtml);
                        counter();
                    },
                    error: function (xhr) {
                        $('.submit-loader').addClass('d-none');
                        swal({
                            title: "Error!",
                            text: "Something went wrong",
                            icon: "error",
                        });
                    }
                });
            }
        });
    </script>
    <script>
        function getdistricts() {
            $('.loader').show();
            var stateId = $('#state').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('register.getDistricts') }}",
                method: 'post',
                data: {
                    state_id: stateId
                },
                success: function (result) {
                    $('.loader').css('display', 'none');
                    $('#district').empty();
                    $('#district').append('<option value="">--SELECT DISTRICT--</option>');
                    $.each(result.districts, function (index, value) {
                        $('#district').append($('<option>', {
                            value: index,
                            text: value
                        }));
                    });
                },
                error: function (xhr) {
                    $('.loader').css('display', 'none');
                }
            });
        }

        function getSponsorDetails() {
            $('.loader').show();
            var sponsorId = $('#sponsorId').val();
            $('#sponsorName').val('');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('register.getSponsorDetails') }}",
                method: 'post',
                data: {
                    sponsorId: sponsorId
                },
                success: function (result) {
                    $('.loader').css('display', 'none');
                    $('#sponsorName').val(result.sponsorName);
                    $('#sponsorName').attr('readonly', 'readonly');
                },
                error: function (xhr) {
                    $('.loader').css('display', 'none');
                    swal({
                        title: "Error!",
                        text: "Invalid Sponsor",
                        icon: "error",
                    });
                }
            });

        }
    </script>
    <script>
        $('#verifyOtp').click(function () {
            $('.verify-loader').removeClass('d-none');
            var otp = $('#otp').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('register.verifyOtp') }}",
                method: 'post',
                data: {
                    otp: otp
                },
                success: function (result) {
                    swal({
                        title: "Success!",
                        text: result.message,
                        icon: "success",
                    }).then((value) => {
                        $('#exampleModal').modal('hide');
                        $('#registerform').submit();
                    });
                },
                error: function (xhr) {
                    $('.verify-loader').addClass('d-none');
                    swal({
                        title: "Error!",
                        text: xhr.responseJSON.error,
                        icon: "error",
                    });
                }
            });
        });
        $("#resend").on('click', function () {
            var number = $('#mobile').val();
            $.ajax({
                url: "{{route('register.sendOtp')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                method: 'post',
                data: {
                    number: number,
                },
                success: function(data){
                    counter();
                    swal({
                        title: "Success!",
                        text: data.message,
                        icon: "success",
                    });
                },
                error: function(xhr, status, error){
                    swal({
                        title: "Error!",
                        text: "Someting went wrong",
                        icon: "error",
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">

        function counter(){
            var counter = 100;
            setInterval(function() {
                counter--;
                if (counter >= 0) {
                    $('#resend').attr('disabled','disabled');
                    $('#resend').html('Resend '+counter+' sec');
                }
                // Display 'counter' wherever you want to display it.
                if (counter === 0) {
                    $('#resend').removeAttr('disabled');
                    clearInterval(counter);
                    $('#resend').html('Resend');
                }

            }, 1000);
        }

    </script>
@endsection

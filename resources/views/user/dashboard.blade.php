@extends('layouts.backend')
@section('styles')
    <style>
        .section {
            padding-top: 30px;
            padding-bottom: 0px;
        }
        .section-sm {
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .custom-button{
            padding: .375rem .75rem;
        }
        @media (max-width: 768px){
            .data-row {
                display: inherit;
            }
        }
    </style>
@endsection
@section('content')
    @php
    $username = Auth::User()->user_name;
    $user = Auth::User();
    @endphp
    <!-- ##### Breadcumb Area Start ##### -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="list-unstyled">
                        <!-- notice item -->
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"> Referral Link</div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <a href="#" class="h4 mb-3 d-block" id="foo">{{ route('register') }}?sponsor-id={{ str_rot13($username) }}</a>
                            </div>
                            <div class="d-md-table-cell text-right pr-0 pr-md-4"><a href="#" class="btn btn-primary"><i class="btn-clip" data-clipboard-action="copy" data-clipboard-target="#foo"> Copy</i></a></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Notice -->
        <div class="container">
            <marquee direction="left" onmouseover="this.stop()" onmouseout="this.start()"><p class="dashboard-news"><span class="text-danger font-weight-bold">News</span> <span style="font-weight: 900" class="text-success">{{ $news->details }}</span> <span class="font-weight-bold">Posted Date: {{$news->updated_at->format('d, M Y h:i:s A')}}</span></p></marquee>
        </div>
        @if($user->status == 'pending')
            <div class="container text-center">
                <p class="imp-note"><span class="text-danger font-weight-bold">Please aware:- </span><span class="font-weight-bold text-success">Every single line counting will calculate after Id activated.</span></p>
            </div>
        @endif
        @if($isUnmatchedGetHelpHelping || ($userDetail->singleLineIncome->amount >= $userSetting->get_help_amount && $userSetting->get_help_amount != 0))
            <div class="container text-center">
                <p class="imp-note"><span class="text-danger font-weight-bold">Note:- </span><span>Please wait, You are in the Get Help queue. Link may be match any time on sender availability thanks.</span></p>
            </div>
        @endif
        @if(checkUserforOnHold(Auth::User()->id))
            <div class="container text-center">
                <p><span class="text-danger font-weight-bold">Note:- Your Id has been NEGLECTED</span></p>
            </div>
        @endif
        <!-- Notice -->
    </section>
    <!-- facts -->
    <section class="section-sm bg-primary mb-3">
        <div class="container" style="max-width: 100%">
            <div class="row data-row">
                <!-- funfacts item -->
                <div class="d-md-table-cell text-center p-4 bg-success text-white mb-4 mb-md-0 m-2"><span class="h2 d-block">{{count(getTotalTeam($username))}}</span> My Total Team</div>

                <!-- funfacts item -->
                <div class="d-md-table-cell text-center p-4 bg-success text-white mb-4 mb-md-0 m-2"><span class="h2 d-block">{{count(getTotalDirectTeam($username))}}</span> My Direct Team</div>
                <!-- funfacts item -->
                @php
                $totalIncome = totalIncome($username);
                $workingIncome = $totalIncome['working'];
                @endphp
                <div class="d-md-table-cell text-center p-4 bg-success text-white mb-4 mb-md-0 m-2"><span class="h2 d-block">{{totalEpinIncome() + $workingIncome}}</span> My Working Income</div>

                <!-- funfacts item -->
                <div class="d-md-table-cell text-center p-4 bg-success text-white mb-4 mb-md-0 m-2"><span class="h2 d-block">{{availableBalance($username,Auth::User()->id)}}</span> My Working Fund</div>
                <!-- funfacts item -->
                <div class="d-md-table-cell text-center p-4 bg-success text-white mb-4 mb-md-0 m-2"><span class="h2 d-block">{{$userDetail->singleLineIncome->amount >= $userSetting->get_help_amount ? 0:$userDetail->singleLineIncome->amount}}</span> My Single Line Income</div>
                <!-- funfacts item -->
                <div class="d-md-table-cell text-center p-4 bg-success text-white mb-4 mb-md-0 m-2"><span class="h2 d-block">{{availableEpinIncome()}}</span> My Epin Fund</div>
                <!-- funfacts item -->
                <div class="d-md-table-cell text-center p-4 bg-success text-white mb-4 mb-md-0 m-2"><span class="h2 d-block">{{$availablePoolFund}}</span>My Pool Fund</div>

                <!-- funfacts item -->
                <div class="d-md-table-cell text-center p-4 bg-success text-white mb-4 mb-md-0 m-2"><span class="h2 d-block">{{totalEpinIncome()+$workingIncome + $userPoolFund + helpingIncome()}}</span>My Total Income</div>

                <div class="d-md-table-cell text-center p-4 bg-success text-white mb-4 mb-md-0 m-2"><span class="h2 d-block">{{isset($userSetting->give_help_amount)?$userSetting->give_help_amount:0}}</span>My Give help Package</div>

                <div class="d-md-table-cell text-center p-4 bg-success text-white mb-4 mb-md-0 m-2"><span class="h2 d-block">{{isset($userSetting->get_help_amount)?$userSetting->get_help_amount:0}}</span>My Get help Package</div>
            </div>
        </div>
    </section>
    <!-- /funfacts -->
    <div class="row mb-4 ml-3 mr-3">
        <div class="col-lg-6 mb-4 mb-lg-0 pl-0 pr-0">
            <div class="card">
                <div class="card-header bg-danger">
                    <h2 class="h6 text-uppercase mb-0 text-white text-center" style="font-size: x-large"><span class="icon-wallet" style="font-size: x-large"></span> Give Help Links</h2>
                </div>
                <div class="card-body">
                @if(count($assignedGiveHelps))
                    @php
                        $i = 1000;
                    @endphp
                    @foreach($assignedGiveHelps as $assignedGiveHelp)
                        @php
                            $giveHelpId = $assignedGiveHelp->id;
                        @endphp
                        @if(count($assignedGiveHelp->getHelps))
                            @foreach($assignedGiveHelp->getHelps as $getHelp)
                                @if($getHelp->pivot->status == 'pending')
                                    @php
                                    $m = $getHelp->pivot->proof_file_name != null?'2':0;
                                    @endphp
                                    <div class="col-lg-12 col-sm-12 pl-0 pr-0 mb-3">
                                        <div class="card p-0 rounded-0 hover-shadow bg-danger border-danger">
                                            <div class="card-body p-0">
                                                <div class="table-bg-color font-weight-bold">
                                                    <br>
                                                    <div class="container text-white">
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Receiver ID:
                                                            </div>
                                                            <div class="col-md-6 font-weight-light">
                                                                {{ $getHelp->user->user_name }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Receiver Name:
                                                            </div>
                                                            <div class=" col-md-6 text-uppercase font-weight-light">
                                                                {{ $getHelp->user->name }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Receiver Mobile:
                                                            </div>
                                                            <div class=" col-md-6 font-weight-light">
                                                                {{ $getHelp->user->userDetails['mob_no'] }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Receiver Email:
                                                            </div>
                                                            <div class=" col-md-6 font-weight-light">
                                                                {{ $getHelp->user->email }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Receiver State:
                                                            </div>
                                                            <div class=" col-md-6 text-uppercase font-weight-light">
                                                                {{ $getHelp->user->userDetails->userState->name }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Receiver District:
                                                            </div>
                                                            <div class=" col-md-6 text-uppercase font-weight-light">
                                                                {{ $getHelp->user->userDetails->userDistrict->name }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Receiver Bank Name:
                                                            </div>
                                                            <div class=" col-md-6 text-uppercase font-weight-light">
                                                                {{ $getHelp->user->userDetails->userBank->name }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Receiver A/C:
                                                            </div>
                                                            <div class=" col-md-6 text-uppercase font-weight-light">
                                                                {{ $getHelp->user->userDetails['account_no'] }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                A/C Type:
                                                            </div>
                                                            <div class=" col-md-6 text-uppercase font-weight-light">
                                                                {{ $getHelp->user->userDetails['account_type'] }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Receiver Bank IFSC:
                                                            </div>
                                                            <div class=" col-md-6 text-uppercase font-weight-light">
                                                                {{ $getHelp->user->userDetails['ifsc_code'] }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Receiver Bank Branch:
                                                            </div>
                                                            <div class=" col-md-6 font-weight-light">
                                                                {{ $getHelp->user->userDetails['branch'] }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Receiver Paytm Number:
                                                            </div>
                                                            <div class=" col-md-6 font-weight-light">
                                                                {{ isset($getHelp->user->userDetails['paytm_no'])? $getHelp->user->userDetails['paytm_no']:'N/A'}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Receiver Gpay/Phonepe Number:
                                                            </div>
                                                            <div class=" col-md-6 font-weight-light">
                                                                {{ isset($getHelp->user->userDetails['gpay_no'])? $getHelp->user->userDetails['gpay_no']:'N/A'}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Receiver Bitcoin Address:
                                                            </div>
                                                            <div class=" col-md-6 font-weight-light">
                                                                {{ isset($getHelp->user->userDetails['bitcoin_add'])? $getHelp->user->userDetails['bitcoin_add']:'N/A'}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Link Amount:
                                                            </div>
                                                            <div class=" col-md-6 font-weight-light">
                                                                <i class="fas fa-rupee-sign"></i> {{ $getHelp->pivot->assigned_amount }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Link Created Date:
                                                            </div>
                                                            <div class=" col-md-6 font-weight-light">
                                                                {{ $getHelp->pivot->created_at->format('d, M Y h:i:s A') }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Link Status:
                                                            </div>
                                                            <div class=" col-md-6">
                                                                <span class="text-white text-uppercase font-weight-bold" style="font-size: 20px;"> {{ $getHelp->pivot->status }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="container-fluid container-padding mr-auto">
                                                        @if($getHelp->pivot->proof_file_name != null)
                                                            <button class="btn btn-secondary custom-button m-2 disabled"><i class="fas fa-upload"></i> Upload Slip</button>
                                                        @else
                                                        <button class="btn btn-secondary custom-button m-2" data-toggle="modal" data-target="#myModal{{$i}}"><i class="fas fa-upload"></i> Upload Slip</button>
                                                        <!-- The Modal -->
                                                        <div class="modal" id="myModal{{$i}}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Upload Proof Slip</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <!-- Modal body -->
                                                                    <div class="modal-body">
                                                                        <form action="{{route('proof.uploadProof')}}" enctype="multipart/form-data" method="post">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="give_help_id" value="{{$giveHelpId}}">
                                                                            <input type="hidden" name="user_id" value="{{$getHelp->user->id}}">
                                                                            <input type="hidden" name="get_help_id" value="{{$getHelp->id}}">
                                                                            <input type="hidden" name="help_amount" value="{{$getHelp->pivot->assigned_amount }}">
                                                                            <input type="file" name="proof_file_name" class="form-control">
                                                                            <input class="btn btn-primary" type="submit" value="upload">
                                                                        </form>
                                                                    </div>
                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <button type="button" class="btn btn-secondary custom-button m-2 btn-timer" id="demo{{$i}}"></button>
                                                        <script>
                                                            // Set the date we're counting down to
                                                            var countDownDate{{$i}} = new Date("{{ date('Y-m-d H:i:s', strtotime( $getHelp->pivot->created_at ) + 8 * 3600 + $m * 3600 + 12 * $getHelp->pivot->extend_timer_count * 3600) }}").getTime();
                                                            // Update the count down every 1 second
                                                            var x{{$i}} = setInterval(function() {
                                                                // Get todays date and time
                                                                var now = new Date().getTime();

                                                                // Find the distance between now and the count down date
                                                                var distance = countDownDate{{$i}} - now;

                                                                // Time calculations for days, hours, minutes and seconds
                                                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                                                // Output the result in an element with id="demo"
                                                                document.getElementById("demo{{$i}}").innerHTML = days + "d " + hours + "h "
                                                                    + minutes + "m " + seconds + "s ";

                                                                // If the count down is over, write some text
                                                                if (distance < 0) {
                                                                    clearInterval(x{{$i}});
                                                                    document.getElementById("demo{{$i}}").innerHTML = "00:00:00";
                                                                }
                                                            }, 1000);
                                                        </script>
                                                        <button class="btn btn-secondary custom-button m-2" data-toggle="modal" data-target="#messageModal{{$i}}"><i class="fas fa-comment-alt"></i> Message</button>
                                                        <!-- The Modal -->
                                                        <div class="modal" id="messageModal{{$i}}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Send Message to {{ $getHelp->user->name }}</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <!-- Modal body -->
                                                                    <div class="modal-body">
                                                                        <form action="{{route('user.message')}}" enctype="multipart/form-data" method="post">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="receiver_id" value="{{$getHelp->user->id}}">
                                                                            <label id="message" class="text-dark">Message</label>
                                                                            <textarea id="message" name="message" class="form-control" required></textarea>
                                                                            <input class="btn btn-primary" type="submit" value="send">
                                                                        </form>
                                                                    </div>
                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-secondary custom-button m-2" data-toggle="modal" data-target="#viewModal{{$i}}"><i class="fas fa-eye"></i> View Slip</button>
                                                        <!-- The Modal -->
                                                        <div class="modal" id="viewModal{{$i}}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Proof Slip</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <!-- Modal body -->
                                                                    <div class="modal-body">
                                                                        @if($getHelp->pivot->proof_file_name != null)
                                                                            <img src="{{url('uploads/proof-files/'.$getHelp->pivot->proof_file_name)}}" width="100%">
                                                                        @else
                                                                            <img src="{{ asset('images/noimage.png') }}" width="100%">
                                                                        @endif
                                                                    </div>
                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $i = $i + 1;
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if($i == 1000)
                    <!--    If No Receiver Available  -->
                        <div class="container user-container text-center font-weight-bold bg-danger" style="padding-top: 50px; padding-bottom: 50px;">
                            <div class="col-12 col-sm-12 col-lg-12">
                                <div class="single-cool-fact">
                                    <div class="scf-text">
                                        <i class="icon-cocktail-1"></i>
                                        <p class="text-white">No Receivers Available</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--    //If No Receiver Available  -->
                    @endif
                @else
                <!--    If No Receiver Available  -->
                <div class="container user-container text-center font-weight-bold bg-danger" style="padding-top: 50px; padding-bottom: 50px;">
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="single-cool-fact">
                            <div class="scf-text">
                                <i class="icon-cocktail-1"></i>
                                <p class="text-white">No Receivers Available</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--    //If No Receiver Available  -->
                @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4 mb-lg-0 pl-0 pr-0">
            <div class="card">
                <div class="card-header bg-success">
                    <h2 class="h6 text-uppercase mb-0 text-center text-white" style="font-size: x-large"><span class="icon-credit-card" style="font-size: x-large"></span> Get Help Links</h2>
                </div>
                <div class="card-body">
                    @if(!$assignedGetHelps->isEmpty())
                        @php
                            $j = 2000;
                        @endphp
                        @foreach($assignedGetHelps as $assignedGetHelp)
                            @php
                                $getHelpId = $assignedGetHelp->id;
                            @endphp
                            @if(!$assignedGetHelp->giveHelps->isEmpty())
                                @foreach($assignedGetHelp->giveHelps as $giveHelp)
                                    @if($giveHelp->pivot->status == 'pending')
                                        @php
                                            $n = $giveHelp->pivot->proof_file_name != null?'2':0;
                                        @endphp
                                    <div class="col-lg-12 col-sm-12 pl-0 pr-0 mb-3">
                                        <div class="card p-0 border-primary rounded-0 hover-shadow bg-success text-white">
                                            <div class="card-body p-0">
                                                <div class="table-bg-color font-weight-bold">
                                                    <br>
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Sender Name:
                                                            </div>
                                                            <div class=" col-md-6 text-uppercase font-weight-light">
                                                                {{ $giveHelp->user->name }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Sender ID:
                                                            </div>
                                                            <div class=" col-md-6 font-weight-light">
                                                                {{ $giveHelp->user->user_name }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Sender Mobile:
                                                            </div>
                                                            <div class=" col-md-6 font-weight-light">
                                                                {{ $giveHelp->user->userDetails['mob_no'] }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Sender Email:
                                                            </div>
                                                            <div class=" col-md-6 font-weight-light">
                                                                {{ $giveHelp->user->email }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Sender State:
                                                            </div>
                                                            <div class=" col-md-6 text-uppercase font-weight-light">
                                                                {{ $giveHelp->user->userDetails->userState->name }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Sender District:
                                                            </div>
                                                            <div class=" col-md-6 text-uppercase font-weight-light">
                                                                {{ $giveHelp->user->userDetails->userDistrict->name }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Link Amount:
                                                            </div>
                                                            <div class=" col-md-6 font-weight-light">
                                                                <i class="fas fa-rupee-sign"></i> {{ $giveHelp->pivot->assigned_amount }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Link Created Date:
                                                            </div>
                                                            <div class=" col-md-6 font-weight-light">
                                                                {{ $giveHelp->pivot->created_at->format('d,M Y h:i:s A') }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 font-weight-bold">
                                                                Link Status:
                                                            </div>
                                                            <div class=" col-md-6 font-weight-light">
                                                                <span class="text-uppercase font-weight-bold text-danger" style="font-size: 20px;">{{ $giveHelp->pivot->status }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="container-fluid">
                                                        <button class="btn btn-secondary m-2 custom-button" data-toggle="modal" data-target="#viewModal{{$j}}"><i class="fas fa-eye"></i> View Slip</button>
                                                        <div class="modal" id="viewModal{{$j}}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Proof Slip</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <!-- Modal body -->
                                                                    <div class="modal-body">
                                                                        @if($giveHelp->pivot->proof_file_name != null)
                                                                            <img src="{{url('uploads/proof-files/'.$giveHelp->pivot->proof_file_name)}}" width="100%">
                                                                        @else
                                                                            <img src="{{ asset('images/noimage.png') }}" width="100%">
                                                                        @endif
                                                                    </div>
                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if($giveHelp->pivot->status == 'pending' && isset($giveHelp->pivot->proof_file_name))
                                                            <form action="{{route('user.acceptHelp')}}" method="post" style="display: inline;">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="get_help_id" value="{{ $getHelpId }}">
                                                                <input type="hidden" name="give_help_id" value="{{ $giveHelp->id }}">
                                                                <input type="hidden" name="sender_id" value="{{ $giveHelp->user->id }}">
                                                                <button type="button" class="btn btn-secondary custom-button m-2 acceptButton"><i class="fas fa-check-square"></i> Accept</button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-secondary custom-button m-2 disabled"><i class="fas fa-check-square"></i> Accept</button>
                                                        @endif
                                                        <button type="button" class="btn btn-secondary custom-button m-2 btn-timer" id="demo{{$j}}"></button>
                                                        <script>
                                                            // Set the date we're counting down to
                                                            var countDownDate{{$j}} = new Date("{{ date('Y-m-d H:i:s', strtotime( $giveHelp->pivot->created_at ) + 8 * 3600 + $n * 3600 + 12 * $giveHelp->pivot->extend_timer_count * 3600) }}").getTime();
                                                            // Update the count down every 1 second
                                                            var x{{$j}} = setInterval(function() {
                                                                // Get todays date and time
                                                                var now = new Date().getTime();

                                                                // Find the distance between now and the count down date
                                                                var distance = countDownDate{{$j}} - now;

                                                                // Time calculations for days, hours, minutes and seconds
                                                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                                                // Output the result in an element with id="demo"
                                                                document.getElementById("demo{{$j}}").innerHTML = days + "d " + hours + "h "
                                                                    + minutes + "m " + seconds + "s ";

                                                                // If the count down is over, write some text
                                                                if (distance < 0) {
                                                                    clearInterval(x{{$j}});
                                                                    document.getElementById("demo{{$j}}").innerHTML = "00:00:00";
                                                                }
                                                            }, 1000);
                                                        </script>
                                                        @if($giveHelp->pivot->status == 'pending' && time() >= strtotime( $giveHelp->pivot->created_at ) + 8 * 3600 + $n * 3600 + 12 * $giveHelp->pivot->extend_timer_count * 3600)
                                                            <form method="post" action="{{route('user.rejectHelp')}}" style="display: inline;">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="get_help_id" value="{{ $getHelpId }}">
                                                                <input type="hidden" name="give_help_id" value="{{ $giveHelp->id }}">
                                                                <input type="hidden" name="amount" value="{{ $giveHelp->pivot->assigned_amount }}">
                                                                <input type="hidden" name="sender_id" value="{{ $giveHelp->user->id }}">
                                                                <button type="button" class="btn btn-secondary custom-button m-2 rejectButton"><i class="fas fa-times-circle"></i> Reject</button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-secondary custom-button m-2 disabled"><i class="fas fa-times-circle"></i> Reject</button>
                                                        @endif
                                                        <button class="btn btn-secondary custom-button m-2" data-toggle="modal" data-target="#messageModal{{$j}}"><i class="fas fa-comment-alt"></i> Message</button>
                                                        <div class="modal" id="messageModal{{$j}}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Send Message to {{ $giveHelp->user->name }}</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <!-- Modal body -->
                                                                    <div class="modal-body">
                                                                        <form action="{{route('user.message')}}" method="post">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="receiver_id" value="{{$giveHelp->user->id}}">
                                                                            <label id="message" class="text-dark">Message</label>
                                                                            <textarea id="message" name="message" class="form-control" required></textarea>
                                                                            <input class="btn btn-primary" type="submit" value="send">
                                                                        </form>
                                                                    </div>
                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if($giveHelp->pivot->status == 'pending' && $giveHelp->pivot->extend_timer_count != 1)
                                                            <form method="post" action="{{route('user.extendTimer')}}" style="display: inline;">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="get_help_id" value="{{$getHelpId}}">
                                                                <input type="hidden" name="give_help_id" value="{{$giveHelp->id}}">
                                                                <button class="btn btn-secondary custom-button m-2"><i class="fas fa-plus-square"></i> Ext.Timer</button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-secondary custom-button m-2" disabled="disabled"><i class="fas fa-plus-square"></i> Ext.Timer</button>
                                                        @endif
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        @php
                                            $j = $j + 1;
                                        @endphp
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        @if($j == 2000)
                            <div class="container user-container text-center font-weight-bold bg-success" style="padding-top: 50px; padding-bottom: 50px;">
                                <div class="col-12 col-sm-12 col-lg-12">
                                    <div class="single-cool-fact">
                                        <div class="scf-text">
                                            <i class="icon-cocktail-1"></i>
                                            <p class="text-white">No Providers Available</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                    <div class="container user-container text-center font-weight-bold bg-success" style="padding-top: 50px; padding-bottom: 50px;">
                        <div class="col-12 col-sm-12 col-lg-12">
                            <div class="single-cool-fact">
                                <div class="scf-text">
                                    <i class="icon-cocktail-1"></i>
                                    <p class="text-white">No Providers Available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $('.rejectButton').click(function () {
        var form = $(this).parents('form');
        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons:[
                'No, cancel it!',
                'Yes, I am sure!'
            ],
        }).then(function(isConfirm){
            if(isConfirm){
                form.submit();
            }
        });
    });
    $('.acceptButton').click(function () {
        var form = $(this).parents('form');
        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons:[
                'No, cancel it!',
                'Yes, I am sure!'
            ],
        }).then(function(isConfirm){
            if(isConfirm){
                form.submit();
            }
        });
    });
</script>
@endsection

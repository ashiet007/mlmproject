@extends('layouts.backend')
@section('styles')
    <style>
        .row {
            color: #182b45;
            font-weight: 900;
        }
    </style>
@endsection
@section('content')
@php
	$username = Auth::User()->user_name;
    $i = 1;
    $j = 100;
    $timestamp = date("Y-m-d H:i:s");
@endphp
<section class="py-5">
    <div class="container-fluid px-xl-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="list-unstyled">
                        <!-- notice item -->
                        <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"> Referral Link</div>
                            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                <a href="#" class="h4 mb-3 d-block" id="foo">{{ route('register') }}?sponsor-id={{ $username }}</a>
                            </div>
                            <div class="d-md-table-cell text-right pr-0 pr-md-4"><a href="#" class="btn btn-primary"><i class="btn-clip" data-clipboard-action="copy" data-clipboard-target="#foo"> Copy</i></a></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <marquee direction="left" onmouseover="this.stop()" onmouseout="this.start()"><p><span class="text-danger font-weight-bold">News</span> {{ $news->details }} <span class="font-weight-bold">Posted Date: {{$news->updated_at->format('d, M Y h:i:s')}}</span></p></marquee>
            </div>
        </div>
    </div>
    @include('partials.header')
    <h3 class="text-center mb-5">Company Reporting Panel</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <label class="font-weight-bold">TOTAL SYSTEM ID:</label>
                </div>
                <div class="col-md-4">
                    {{ $totalSystemId }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <label class="font-weight-bold">TOTAL SYSTEM FUND:</label>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-rupee-sign"></i> {{$totalSystemFund}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <label class="font-weight-bold">TOTAL NEW ID:</label>
                </div>
                <div class="col-md-4">
                    {{$totalNewId}}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <label class="font-weight-bold">TOTAL ACCEPTED FUND:</label>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-rupee-sign"></i> {{$totalAcceptedFund}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <label class="font-weight-bold">TOTAL ACTIVE ID:</label>
                </div>
                <div class="col-md-4">
                    {{$totalActiveId}}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <label class="font-weight-bold">TOTAL REJECTED FUND:</label>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-rupee-sign"></i> {{$totalRejectedFund}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <label class="font-weight-bold">TOTAL INACTIVE ID:</label>
                </div>
                <div class="col-md-4">
                    {{$totalInActiveId}}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <label class="font-weight-bold">TOTAL BALANCE FUND:</label>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-rupee-sign"></i> {{$totalBalanceFund}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <label class="font-weight-bold">TOTAL BLOCKED ID:</label>
                </div>
                <div class="col-md-4">
                    {{$totalBlockedId}}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <label class="font-weight-bold">TOTAL ADDED FUND:</label>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-rupee-sign"></i> {{ $totalAddedFund }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <label class="font-weight-bold">TOTAL POST REJECTED FUND:</label>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-rupee-sign"></i> {{$postRejectedFund}}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <label class="font-weight-bold">TOTAL RECEIVERS FUND:</label>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-rupee-sign"></i> {{ $totalReceiverFund }}
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
</section>
@endsection


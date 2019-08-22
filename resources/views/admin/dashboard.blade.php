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


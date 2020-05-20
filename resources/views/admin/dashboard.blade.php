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
        <div class="col-lg-6 col-sm-6 mb-5">
            <div class="card p-0 border-primary rounded-0 hover-shadow">
                <div class="card-body">
                    <h4 class="card-title">TOTAL SYSTEM ID:</h4>
                    <button type="button" class="btn btn-primary btn-lg">{{ $totalSystemId }}</button>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 mb-5">
            <div class="card p-0 border-primary rounded-0 hover-shadow">
                <div class="card-body">
                    <h4 class="card-title">TOTAL SYSTEM FUND:</h4>
                    <button type="button" class="btn btn-primary btn-lg">{{$totalSystemFund}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 mb-5">
            <div class="card p-0 border-primary rounded-0 hover-shadow">
                <div class="card-body">
                    <h4 class="card-title">TOTAL NEW ID:</h4>
                    <button type="button" class="btn btn-primary btn-lg">{{$totalNewId}}</button>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 mb-5">
            <div class="card p-0 border-primary rounded-0 hover-shadow">
                <div class="card-body">
                    <h4 class="card-title">TOTAL ACCEPTED FUND:</h4>
                    <button type="button" class="btn btn-primary btn-lg">{{$totalAcceptedFund}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 mb-5">
            <div class="card p-0 border-primary rounded-0 hover-shadow">
                <div class="card-body">
                    <h4 class="card-title">TOTAL ACTIVE ID:</h4>
                    <button type="button" class="btn btn-primary btn-lg">{{$totalActiveId}}</button>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 mb-5">
            <div class="card p-0 border-primary rounded-0 hover-shadow">
                <div class="card-body">
                    <h4 class="card-title">TOTAL REJECTED FUND:</h4>
                    <button type="button" class="btn btn-primary btn-lg">{{$totalRejectedFund}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 mb-5">
            <div class="card p-0 border-primary rounded-0 hover-shadow">
                <div class="card-body">
                    <h4 class="card-title">TOTAL INACTIVE ID:</h4>
                    <button type="button" class="btn btn-primary btn-lg">{{$totalInActiveId}}</button>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 mb-5">
            <div class="card p-0 border-primary rounded-0 hover-shadow">
                <div class="card-body">
                    <h4 class="card-title">TOTAL BALANCE FUND:</h4>
                    <button type="button" class="btn btn-primary btn-lg">{{$totalBalanceFund}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 mb-5">
            <div class="card p-0 border-primary rounded-0 hover-shadow">
                <div class="card-body">
                    <h4 class="card-title">TOTAL BLOCKED ID:</h4>
                    <button type="button" class="btn btn-primary btn-lg">{{$totalBlockedId}}</button>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 mb-5">
            <div class="card p-0 border-primary rounded-0 hover-shadow">
                <div class="card-body">
                    <h4 class="card-title">TOTAL ADDED FUND:</h4>
                    <button type="button" class="btn btn-primary btn-lg">{{ $totalAddedFund }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 mb-5">
            <div class="card p-0 border-primary rounded-0 hover-shadow">
                <div class="card-body">
                    <h4 class="card-title">TOTAL POST REJECTED FUND:</h4>
                    <button type="button" class="btn btn-primary btn-lg">{{$postRejectedFund}}</button>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 mb-5">
            <div class="card p-0 border-primary rounded-0 hover-shadow">
                <div class="card-body">
                    <h4 class="card-title">TOTAL RECEIVERS FUND:</h4>
                    <button type="button" class="btn btn-primary btn-lg">{{ $totalReceiverFund }}</button>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
</section>
@endsection


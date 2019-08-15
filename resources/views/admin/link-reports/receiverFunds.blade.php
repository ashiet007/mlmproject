@extends('layouts.backend')

@section('content')
    <section class="py-5 col-md-12">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="h6 text-uppercase mb-0">Receiver List</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$user->user_name}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->singleLineIncome->amount}}</td>
                                    </tr>
                                    @php
                                        $i =$i+1;
                                    @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

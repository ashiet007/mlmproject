@extends('layouts.backend')
@section('styles')
    <style>
        .comment-para{
            margin-bottom: 0px;
            font-weight: 900;
            color: #182b45;
        }
    </style>
@endsection
@section('content')
    <div class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ml-auto bg-primary newsletter-block form-border">
                    <h2 class="text-center heading-color">Epin Reports</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Epin</th>
                                <th>Amount</th>
                                <th>Comment</th>
                                <th>Used Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($report as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->pin}}</td>
                                    <td>{{$data->amount}}</td>
                                    <td>@php echo getEpinReportComment($data)@endphp</td>
                                    <td>{{$data->updated_at->format('d, M Y h:i:s A')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
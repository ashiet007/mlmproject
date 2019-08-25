@extends('layouts.backend')
@section('styles')
    <style>
        .color-red{
            color: red;
        }
        .color-yellow{
            color: #007bff;
        }
    </style>
@endsection
@section('content')
<form action="{{route('epin.transferEpin')}}" method="post">
    @csrf
    <div class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ml-auto bg-primary newsletter-block form-border">
                    <h2 class="text-center heading-color">Transfer Epin</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll"> Select All</th>
                                <th>Sr No.</th>
                                <th>Epin</th>
                                <th>Amount</th>
                                <th>Created/Transferred Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($unusedEpins as $data)
                                <tr>
                                    <td><input type="checkbox" name="pin_id[]" value="{{$data->id}}"></td>
                                    <td>{{$loop->iteration}}</td>
                                    <td class="{{$data->amount == '500'?'color-red':'color-yellow'}}">{{$data->pin}}</td>
                                    <td>{{$data->amount}}</td>
                                    <td>{{$data->created_at->format('d, M Y h:i:s A')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row col-md-12">
                        <button type="button" class="btn btn-secondary m-2" data-toggle="modal" data-target="#epinModal"> Transfer Epin </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="epinModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content rounded-0 border-0 p-4">
                <div class="modal-header border-0">
                    <h3>Transfer Epin</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-12">
                            <input type="text" class="form-control custom-input" id="userId" name="user_name" placeholder="Enter Username" required onchange="getUserDetails();">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <input type="text" class="form-control custom-input" id="name" name="name" placeholder="Name" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary d-none" id="transferBtn">Transfer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('scripts')
    <script type="text/javascript">
        function getUserDetails() {
            var userId = $('#userId').val();
            $('#name').val('');
            $('#transferBtn').addClass('d-none');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('register.getSponsorDetails') }}",
                method: 'post',
                data: {
                    sponsorId: userId
                },
                success: function (result) {
                    $('#name').val(result.sponsorName);
                    $('#transferBtn').removeClass('d-none');
                },
                error: function (xhr) {
                    $('.loader').css('display', 'none');
                    swal({
                        title: "Error!",
                        text: "Invalid User",
                        icon: "error",
                    });
                }
            });

        }
    </script>
    <script>
        $("#selectAll").click(function(){
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

        });
    </script>
@endsection

@extends('layouts.backend')
@section('content')
    <form action="{{route('adminEpin.transferEpin')}}" method="post">
        @csrf
        <div class="mt-5 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ml-auto bg-primary newsletter-block form-border">
                        <h2 class="text-center heading-color">Unused Epin</h2>
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
                                        <td>{{$data->pin}}</td>
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
                        <div class="col-12">
                            <input type="hidden" id="userId" name="user_id">
                            <input type="text" class="form-control mb-3" id="search" name="user" autocomplete="off" placeholder="Search User...">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Transfer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript">
        var path = "{{ route('epin.userAjax') }}";
        $('#search').typeahead({
            minLength: 2,
            source:  function (query, process) {
                return $.get(path, { query: query }, function (data) {
                    return process(data);
                });
            },
            afterSelect: function (data) {
                //print the id to developer tool's console
                $('#userId').val(data.id);
            }
        });
    </script>
    <script>
        $("#selectAll").click(function(){
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

        });
    </script>
@endsection
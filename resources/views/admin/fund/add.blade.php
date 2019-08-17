@extends('layouts.backend')

@section('content')
@include('partials.header')
<h2 class="text-center">Add fund To User</h2>
<div class="card-body">
    <form role="form" action="{{route('fund.addFund')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <div class="col-md-8">
                <input type="hidden" id="userId" name="user_id">
                <input type="text" class="form-control custom-input mb-3" id="search" autocomplete="off" placeholder="Search User...">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
                <input type="number" name="amount" class="form-control custom-input" placeholder="Enter Amount">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </div>
    </form>
</div>
@include('partials.footer')
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
@endsection
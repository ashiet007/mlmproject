@extends('layouts.backend')
@section('styles')
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #182b45;
        }
    </style>
@endsection
@section('content')
    @include('partials.header')
    <h2 class="text-center heading-color">Send SMS</h2>
    <div class="card col-md-12 mb-3 custom-card">
        <div class="card-body">
            <form action="{{route('action.sendSms')}}" method="post">
                @csrf
                <div class="form-group">
                    <label class="control-label col-md-4">Amount</label>
                    <div class="col-md-8">
                        <select class="form-control" name="mob_no[]" required multiple id="user">
                            @foreach($users as $user)
                            <option value="{{$user->userDetails->mob_no}}">{{$user->name}}({{$user->user_name}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8 mt-3">
                        <input type="checkbox" id="selectAll"> Select All
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Message</label>
                    <div class="col-md-8">
                        <textarea class="form-control" name="message" placeholder="Enter Messase" required style="height: 200px!important;"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-secondary m-2">Send </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('partials.footer')
@endsection
@section('scripts')
    <script>
        $('#user').select2({
            placeholder: 'Select Users...',
            closeOnSelect: false
        });
        $("#selectAll").click(function(){
            if($("#selectAll").is(':checked') ){
                $("#user").find('option').prop("selected",true);
                $("#user").trigger('change');
            }else{
                $("#user").find('option').prop("selected",false);
                $("#user").trigger('change');
            }
        });
    </script>
@endsection
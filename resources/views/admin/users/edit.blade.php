@extends('layouts.backend')
@section('styles')
    <style type="text/css">
        .text-style1{
            text-transform: uppercase;
        }
        .text-style2{
            text-transform: lowercase;
        }
    </style>
@endsection
@section('content')
@include('partials.header')
    <h2 class="text-center"> Edit User</h2>
    <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
    <br />
    <br />
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    {!! Form::model($user, [
    'method' => 'PATCH',
    'url' => ['/admin/users', $user->id],
    'class' => 'form-horizontal'
    ]) !!}
    @include ('admin.users.form', ['submitButtonText' => 'Update'])
    {!! Form::close() !!}
@include('partials.footer')
@endsection
@section('scripts')
<script>
    function getdistricts() {
        $('.loader').show();
        var stateId = $('#state').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('register.getDistricts') }}",
            method: 'post',
            data: {
                state_id: stateId
            },
            success: function (result) {
                $('.loader').css('display', 'none');
                $('#district').empty();
                $('#district').append('<option value=""><-- Select district --></option>');
                $.each(result.districts, function (index, value) {
                    $('#district').append($('<option>', {
                        value: index,
                        text: value
                    }));
                });
            },
            error: function (xhr) {
                $('.loader').css('display', 'none');
            }
        });
    }

    function getSponsorDetails() {
        $('.loader').show();
        var sponsorId = $('#sponsorId').val();
        $('#sponsorName').val('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('register.getSponsorDetails') }}",
            method: 'post',
            data: {
                sponsorId: sponsorId
            },
            success: function (result) {
                $('.loader').css('display', 'none');
                $('#sponsorName').val(result.sponsorName);
                $('#sponsorName').attr('readonly', 'readonly');
            },
            error: function (xhr) {
                $('.loader').css('display', 'none');
                alert('Invalid Sponsor');
            }
        });

    }
</script>
@endsection
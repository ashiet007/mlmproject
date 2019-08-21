var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";

// Registration Js
$('body').on('click','.nextBtn',function () {
    if($('#registerform').valid()) {
        var formInstance = $('#registerform');
        var formData = formInstance.serializeArray();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: baseUrl+"verify-form-details",
            method: 'post',
            data: formData,
            success: function (result) {
                if(result.status == 'ok')
                {
                    $('.register-form').addClass('d-none');
                    $('.previewSponsorId').html($('#sponsorId').val());
                    $('.previewSponsorName').html($('#sponsorName').val());
                    $('.previewName').html($('#name').val());
                    $('.previewUserName').html($('#user_name').val());
                    $('.previewMobNumber').html($('#mobile').val());
                    $('.previewState').html($('#state option:selected').html());
                    $('.previewDistrict').html($('#district option:selected').html());
                    $('.previewEmail').html($('#email').val());
                    $('.previewBankName').html($('#bank_name option:selected').html());
                    $('.previewAccType').html($('#account-type option:selected').html());
                    $('.previewAccNumber').html($('#account-number').val());
                    $('.previewBranch').html($('#branch').val());
                    $('.previewIfscCode').html($('#ifsc-code').val());
                    $('.previewPaytmNumber').html($('#paytm').val());
                    $('.previewGpayNumber').html($('#gpay').val());
                    $('.previewBitcoin').html($('#bitcoin').val());
                    $('.preview-form').removeClass('d-none');
                }
                else if (result.status == 'error')
                {
                    swal({
                        title: "Error!",
                        text: result.message,
                        icon: "error",
                    });
                }
                else
                {
                    swal({
                        title: "Error!",
                        text: "Something went wrong",
                        icon: "error",
                    });
                }
            },
            error: function (xhr) {
                swal({
                    title: "Error!",
                    text: "Something went wrong",
                    icon: "error",
                });
            }
        });
    }
});
$('body').on('click','.preBtn',function () {
    $('.register-form').removeClass('d-none');
    $('.preview-form').addClass('d-none');
})
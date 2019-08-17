// Registration Js
$('body').on('click','.nextBtn',function () {
    if($('#registerform').valid()) {
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
});
$('body').on('click','.preBtn',function () {
    $('.register-form').removeClass('d-none');
    $('.preview-form').addClass('d-none');
})
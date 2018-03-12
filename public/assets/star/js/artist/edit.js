$(document).ready(function ($) {

    $.fn.validate.replaceGeneral($.fn.validate.data.artist_name, 255, $.fn.validate.error.artist_name);

    $.fn.validate.replaceCommas($.fn.validate.data.guarantee_concert, 11, $.fn.validate.error.guarantee_concert);
    $.fn.validate.replaceCommas($.fn.validate.data.guarantee_metropolitan, 11, $.fn.validate.error.guarantee_metropolitan);
    $.fn.validate.replaceCommas($.fn.validate.data.guarantee_central, 11, $.fn.validate.error.guarantee_central);
    $.fn.validate.replaceCommas($.fn.validate.data.guarantee_south, 11, $.fn.validate.error.guarantee_south);

    $.fn.validate.replaceGeneral($.fn.validate.data.manager_name, 255, $.fn.validate.error.manager_name);
    $.fn.validate.replaceCellphone($.fn.validate.data.manager_phone, 11, $.fn.validate.error.manager_phone);

    $.fn.validate.replaceGeneral($.fn.validate.data.company_name, 255, $.fn.validate.error.company_name);
    $.fn.validate.replaceGeneral($.fn.validate.data.company_email, 255, $.fn.validate.error.company_email);

    $.fn.validate.selectedOption($.fn.validate.data.group_type_number, $.fn.validate.error.group_type_number);
    $.fn.validate.selectedOption($.fn.validate.data.group_type_sex, $.fn.validate.error.group_type_sex);
    $.fn.validate.selectedOption($.fn.validate.data.group_type_song_genres, $.fn.validate.error.group_type_song_genres);

    $.fn.validate.replaceGeneral($.fn.validate.data.comment, 255, $.fn.validate.error.comment);

})

$(document).on('click', 'button#confirm', function (e) {
    $('#button#confirm').attr('disabled', true);
    e.preventDefault();
    if ($.fn.validate.validation() === true) {
        var data = new FormData();
        data.append("picture_url", $('#picture_url')[0].files[0]);
        data.append("artist_name", $('#artist_name').val());
        data.append("guarantee_concert", $('#guarantee_concert').val());
        data.append("guarantee_metropolitan", $('#guarantee_metropolitan').val());
        data.append("guarantee_central", $('#guarantee_central').val());
        data.append("guarantee_south", $('#guarantee_south').val());
        data.append("manager_name", $('#manager_name').val());
        data.append("manager_phone", $('#manager_phone').val());
        data.append("company_name", $('#company_name').val());
        data.append("company_email", $('#company_email').val());
        data.append("group_type_number", $('#group_type_number').val());
        data.append("group_type_sex", $('#group_type_sex').val());
        data.append("group_type_song_genres", $('#group_type_song_genres').val());
        data.append("comment", $('#comment').val());
        data.append("_method", "put");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: $('#url-artist-update').val(),
            type: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function () {
                alert('수정 되었습니다.');
                window.location = '/star';
            },
            error: function () {
                $('#button#confirm').attr('disabled', false);
            }
        });
    }
});
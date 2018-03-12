$(document).ready(function ($) {

    $.fn.validate.replaceGeneral($('#artist_name'), 255, $('#error-artist_name'));

    $.fn.validate.replaceCommas($.fn.artist.data.guarantee_concert, 11, $.fn.artist.error.guarantee_concert);
    $.fn.validate.replaceCommas($.fn.artist.data.guarantee_metropolitan, 11, $.fn.artist.error.guarantee_metropolitan);
    $.fn.validate.replaceCommas($.fn.artist.data.guarantee_central, 11, $.fn.artist.error.guarantee_central);
    $.fn.validate.replaceCommas($.fn.artist.data.guarantee_south, 11, $.fn.artist.error.guarantee_south);

    $.fn.validate.replaceGeneral($.fn.artist.data.manager_name, 255, $.fn.artist.error.manager_name);
    $.fn.validate.replaceCellphone($.fn.artist.data.manager_phone, 11, $.fn.artist.error.manager_phone);

    $.fn.validate.replaceGeneral($.fn.artist.data.company_name, 255, $.fn.artist.error.company_name);
    $.fn.validate.replaceGeneral($.fn.artist.data.company_email, 255, $.fn.artist.error.company_email);

    $.fn.validate.selectedOption($.fn.artist.data.group_type_number, $.fn.artist.error.group_type_number);
    $.fn.validate.selectedOption($.fn.artist.data.group_type_sex, $.fn.artist.error.group_type_sex);
    $.fn.validate.selectedOption($.fn.artist.data.group_type_song_genres, $.fn.artist.error.group_type_song_genres);

    $.fn.validate.replaceGeneral($.fn.artist.data.comment, 255, $.fn.artist.error.comment);

})

$(document).on('click', 'button#confirm', function (e) {
    $('#button#confirm').attr('disabled', true);
    e.preventDefault();
    if ($.fn.artist.validation() === true) {
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: $('#url-artist-store').val(),
            type: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function () {
                alert('등록 되었습니다.');
                window.location = "/star"
            }, error: function () {
                $('#button#confirm').attr('disabled', false);
            }
        })
    }
})


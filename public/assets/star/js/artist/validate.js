(function ($) {
    $.fn.artist = {
        data: {
            picture_url: $('#picture_url'),
            artist_name: $('#artist_name'),
            guarantee_concert: $('#guarantee_concert'),
            guarantee_metropolitan: $('#guarantee_metropolitan'),
            guarantee_central: $('#guarantee_central'),
            guarantee_south: $('#guarantee_south'),
            manager_name: $('#manager_name'),
            manager_phone: $('#manager_phone'),
            company_name: $('#company_name'),
            company_email: $('#company_email'),
            group_type_number: $('#group_type_number'),
            group_type_sex: $('#group_type_sex'),
            group_type_song_genres: $('#group_type_song_genres'),
            comment: $('#comment')
        },
        error: {
            picture_url: $('#error-picture_url'),
            artist_name: $('#error-artist_name'),
            guarantee_concert: $('#error-guarantee_concert'),
            guarantee_metropolitan: $('#error-guarantee_metropolitan'),
            guarantee_central: $('#error-guarantee_central'),
            guarantee_south: $('#error-guarantee_south'),
            manager_name: $('#error-manager_name'),
            manager_phone: $('#error-manager_phone'),
            company_name: $('#error-company_name'),
            company_email: $('#error-company_email'),
            group_type_number: $('#error-group_type_number'),
            group_type_sex: $('#error-group_type_sex'),
            group_type_song_genres: $('#error-group_type_song_genres'),
            comment: $('#error-comment')
        },
        validation: function () {
            if ($.fn.validate.generalValidation(true, false, $.fn.artist.data.artist_name, $.fn.validate.rex.require_name, $.fn.artist.error.artist_name) === false
            ) {
                return false;
            }
            if ($.fn.validate.generalValidation(false, false, $.fn.artist.data.guarantee_concert, $.fn.validate.rex.price, $.fn.artist.error.guarantee_concert) === false) {
                return false;
            }
            if ($.fn.validate.generalValidation(false, false, $.fn.artist.data.guarantee_metropolitan, $.fn.validate.rex.price, $.fn.artist.error.guarantee_metropolitan) === false) {
                return false;
            }
            if ($.fn.validate.generalValidation(false, false, $.fn.artist.data.guarantee_central, $.fn.validate.rex.price, $.fn.artist.error.guarantee_central) === false) {
                return false;
            }
            if ($.fn.validate.generalValidation(false, false, $.fn.artist.data.guarantee_south, $.fn.validate.rex.price, $.fn.artist.error.guarantee_south) === false) {
                return false;
            }
            if ($.fn.validate.generalValidation(false, false, $.fn.artist.data.manager_name, $.fn.validate.rex.name, $.fn.artist.error.manager_name) === false) {
                return false;
            }
            if ($.fn.validate.generalValidation(false, false, $.fn.artist.data.manager_phone, $.fn.validate.rex.phone, $.fn.artist.error.manager_phone) === false) {
                return false;
            }
            if ($.fn.validate.generalValidation(false, false, $.fn.artist.data.company_name, $.fn.validate.rex.name, $.fn.artist.error.manager_phone) === false) {
                return false;
            }
            if ($.fn.validate.generalValidation(false, false, $.fn.artist.data.company_email, $.fn.validate.rex.email, $.fn.artist.error.company_email) === false) {
                return false;
            }
            if ($.fn.validate.generalValidation(false, false, $.fn.artist.data.comment, $.fn.validate.rex.comment, $.fn.artist.error.comment) === false) {
                return false;
            }
            if ($.fn.validate.selectValidation($.fn.artist.data.group_type_number, $.fn.artist.error.group_type_number) === false) {
                return false;
            }
            if ($.fn.validate.selectValidation($.fn.artist.data.group_type_sex, $.fn.artist.error.group_type_sex) === false) {
                return false;
            }
            if ($.fn.validate.selectValidation($.fn.artist.data.group_type_song_genres, $.fn.artist.error.group_type_song_genres) === false) {
                return false;
            }
            return true;
        }
    }
})(jQuery)

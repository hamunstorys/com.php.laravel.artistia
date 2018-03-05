(function ($) {
    $.fn.validate = {
        replaceCommas: function (att, length) {
            att.bind('keyup keypress', function () {
                $.fn.validate.limitCharacters(att, length, /,/g);
                att.val(att.val().replace(/[^0-9\.]+/g, '').replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,'));

            });
        },
        replaceCellphone: function (att, length) {
            att.bind('keyup keypress', function () {
                $.fn.validate.limitCharacters(att, length, /-/g);
                att.val(att.val().replace(/[^0-9\.]+/g, '').replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/, "$1-$2-$3"));
            });
        },
        replaceName: function (att, length) {
            att.bind('keyup keypress', function () {
                $.fn.validate.limitCharacters(att, length, null);
            });
        },
        replaceEmail: function (att, length) {
            att.bind('keyup keypress', function () {
                $.fn.validate.limitCharacters(att, length, null);
            });
        },
        replaceComment: function (att, length) {
            att.bind('keyup keypress', function () {
                $.fn.validate.limitCharacters(att, length, null);
            });
        },
        removeCommas: function (str) {
            return parseInt(str.replace(/,/g, ""));
        },
        removeDashes: function (str) {
            return parseInt(str.replace(/-/g, ""));
        },
        limitCharacters: function (att, length, rex) {
            $length = att.val().length;
            if (rex == null) {
                if ($length > length) {
                    att.val(att.val().substr(0, length));
                }
            } else {
                $limit = length + (att.val().match(rex) || []).length;
                if ($length > $limit) {
                    att.val(att.val().substr(0, $limit));
                }
            }
        },
        requiredValidateName: function (att, rex, error) {
            if (rex.test(att.val()) != true) {
                att.val("");
                error.show("fast");
                setTimeout(function () {
                    error.hide("slow");
                }, 3000);
            }
        },
        requiredValidateSelect: function (att, error) {
            if (att.val() == 0) {
                error.toggle("fast");
                setTimeout(function () {
                    error.toggle("slow");
                }, 3000);
            }

        },
        optionalValidateName: function (att, rex, error) {
            if (att.val().length !== 0 && rex.test(att.val()) != true) {
                att.val("");
                error.show("fast");
                setTimeout(function () {
                    error.hide("slow");
                }, 3000);
            }
        },
        optionalValidateNumber: function (att, rex, error) {
            if (!isNaN(att.val()) && rex.test(att.val()) != true) {
                att.val("");
                error.show("fast");
                setTimeout(function () {
                    error.hide("slow");
                }, 3000);
            }
        },
        setData: function (array) {
            return $.fn.validate.data = array;
        },
        submit: function (data) {

            url = $('#url').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function () {
                    alert('등록 되었습니다.');
                    window.location = '/star';
                }
            });
        }
    }
})(jQuery);

$(document).ready(function ($) {

    $.fn.validate.data = {
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
        group_type_genres: $('#group_type_song_genres'),
        comment: $('#comment')
    }

    $.fn.validate.replaceName($.fn.validate.data.artist_name, 255);
    $.fn.validate.replaceCommas($.fn.validate.data.guarantee_concert, 11);
    $.fn.validate.replaceCommas($.fn.validate.data.guarantee_metropolitan, 11);
    $.fn.validate.replaceCommas($.fn.validate.data.guarantee_central, 11);
    $.fn.validate.replaceCommas($.fn.validate.data.guarantee_south, 11);
    $.fn.validate.replaceName($.fn.validate.data.manager_name, 255);
    $.fn.validate.replaceCellphone($.fn.validate.data.manager_phone, 11);
    $.fn.validate.replaceName($.fn.validate.data.company_name, 255);
    $.fn.validate.replaceEmail($.fn.validate.data.company_email, 255);
    $.fn.validate.replaceComment($.fn.validate.data.company_email, 255);

    $.fn.validation = function () {

        var rex_require_name = /^[\s\S]{1,255}$/;
        var rex_name = /^[\s\S]{0,255}$/;
        var rex_price = /^[0-9]{0,11}$/;
        var rex_email = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var rex_url = /^(https?:\/\/)?([a-z\d\.-]+)\.([a-z\.]{2,6})([\/\w\.-]*)*\/?$/;
        var rex_phone = /(\d{3})(\d{4})(\d{4})/;
        var rex_comment = /^[\s\S]{1,255}$/;

        $.fn.validate.requiredValidateName($.fn.validate.data.artist_name, rex_require_name, $('#error-artist_name'));

        $.fn.validate.optionalValidateNumber($.fn.validate.data.guarantee_concert, rex_price, $('#error-guarantee_concert'));
        $.fn.validate.optionalValidateNumber($.fn.validate.data.guarantee_metropolitan, rex_price, $('#error-guarantee_metropolitan'));
        $.fn.validate.optionalValidateNumber($.fn.validate.data.guarantee_central, rex_price, $('#error-guarantee_central'));
        $.fn.validate.optionalValidateNumber($.fn.validate.data.guarantee_south, rex_price, $('#error-guarantee_south'));

        $.fn.validate.optionalValidateName($.fn.validate.data.manager_name, rex_name, $('#error-manager_name'));

        if ($.fn.validate.data.manager_phone.val().length !== 0 && rex_phone.test($.fn.validate.data.manager_phone.val()) != true) {
            $.fn.validate.data.manager_phone.val("");
            $("#error-manager_phone").show("fast");
            setTimeout(function () {
                $("#error-manager_phone").hide("slow");
            }, 3000);
        }

        $.fn.validate.optionalValidateName($.fn.validate.data.company_name, rex_name, $('#error-company_name'));

        if ($.fn.validate.data.company_email.val().length !== 0 && rex_email.test($.fn.validate.data.company_email.val()) != true) {
            $.fn.validate.data.company_email.val("");
            $("#error-company_email").show("fast");
            setTimeout(function () {
                $("#error-company_email").hide("slow");
            }, 3000);
        }

        if ($.fn.validate.data.comment.val().length !== 0 && rex_comment.test($.fn.validate.data.comment.val()) != true) {
            $.fn.validate.data.comment.val("");
            $("#error-comment").show("fast");
            setTimeout(function () {
                $("#error-comment").hide("slow");
            }, 3000);
        }
        $.fn.validate.requiredValidateSelect($.fn.validate.data.group_type_number, $('#error-group_type_number'));
        $.fn.validate.requiredValidateSelect($.fn.validate.data.group_type_sex, $('#error-group_type_sex'));
        $.fn.validate.requiredValidateSelect($.fn.validate.data.group_type_genres, $('#error-group_type_genres'));

        /* 배열로 넘길 지, 객체로 넘길 지 고민*/
        $.fn.validate.submit($.fn.validate.data);
    }
})



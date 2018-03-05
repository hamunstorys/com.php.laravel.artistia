(function ($) {
    $.fn.replaceCommas = function (att, length) {
        att.bind('keyup keypress', function () {
            $.fn.limitCharacters(att, length, /,/g);
            att.val(att.val().replace(/[^0-9\.]+/g, '').replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,'));

        });
    };
    $.fn.replaceCellphone = function (att, length) {
        att.bind('keyup keypress', function () {
            $.fn.limitCharacters(att, length, /-/g);
            att.val(att.val().replace(/[^0-9\.]+/g, '').replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/, "$1-$2-$3"));
        });
    };
    $.fn.replaceName = function (att, length) {
        att.bind('keyup keypress', function () {
            $.fn.limitCharacters(att, length, null);
        });
    };

    $.fn.replaceEmail = function (att, length) {
        att.bind('keyup keypress', function () {
            $.fn.limitCharacters(att, length, null);
        });
    }

    $.fn.replaceComment = function (att, length) {
        att.bind('keyup keypress', function () {
            $.fn.limitCharacters(att, length, null);
        });
    };

    $.fn.removeCommas = function (str) {
        return parseInt(str.replace(/,/g, ""));
    };

    $.fn.removeDashes = function (str) {
        return parseInt(str.replace(/-/g, ""));
    };

    $.fn.limitCharacters = function (att, length, rex) {

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
    }

    $.fn.requiredValidation = function () {

    }

    $.fn.Validation = function () {
        
    }
})(jQuery);
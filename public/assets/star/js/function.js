(function ($) {
        $.fn.removeComma = function (str) {
            return parseInt(str.replace(/,/g, ""));
        };
        $.fn.addCommas = function (att) {
            att.bind('keyup keypress', function () {
                var old = $(this).val();
                parseInt($(this).val(old.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")));
            });
        };
    }
)(jQuery);
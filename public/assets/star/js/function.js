(function ($) {
        $.fn.removeString = function (str) {
            return parseInt(str.replace(/,/g, ""));
        };
        $.fn.addCommas = function (att) {
            att.bind('keyup keypress', function () {
                var old = $(this).val();
                parseInt($(this).val(old.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")));
            });
        };
        $.fn.replaceManagerPhone = function (att, length) {
            $length = length;
            att.bind('keyup keypress', function () {
                att.val().replace(/[^0-9\.]+/g, "");
                att.val(att.val().toString().replace(/,/g, "").replace(/(\d{3})(\d{4})(\d{4})/, '$1-$2-$3'));
                var textLength = att.val().length;
                att.text(textLength);
                if (textLength > $length) {
                    att.val(att.val().substr(0, $length));
                }

            });
        };
    }
)(jQuery);
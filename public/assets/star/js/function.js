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
        $.fn.replaceString = function (att, length) {
            $length = length;
            att.bind('keyup keypress', function () {
                var old = att.val().replace(/,/g, "");
                if (old.length > $length) {
                    old = att.val().replace(/,/g, "").substring(0, $length + 2).replace(/(\d{3})(\d{4})(\d{4})/, '$1-$2-$3');
                }
                $(this).val(old.toString().replace(/,/g, "").replace(/(\d{3})(\d{4})(\d{4})/, '$1-$2-$3'));

            });
        };
    }
)(jQuery);
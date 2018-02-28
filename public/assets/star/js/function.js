/*input numberformat function*/
(function ($) {
    $.fn.removeText = function (_v) {
        //console.log("removeText: 숫자 제거 합니다.");
        if (typeof(_v) === "undefined") {
            $(this).each(function () {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        }
        else {
            return _v.replace(/[^0-9]/g, '');
        }
    };
    $.fn.numberFormat = function (_v) {
        this.proc = function (_v) {
            var tmp = '',
                number = '',
                cutlen = 3,
                comma = ','
            i = 0,
                len = _v.length,
                mod = (len % cutlen),
                k = cutlen - mod;

            for (i; i < len; i++) {
                number = number + _v.charAt(i);
                if (i < len - 1) {
                    k++;
                    if ((k % cutlen) == 0) {
                        number = number + comma;
                        k = 0;
                    }
                }
            }
            return number;
        };

        var proc = this.proc;
        if (typeof(_v) === "undefined") {
            $(this).each(function () {
                this.value = proc($(this).removeText(this.value));
            });
        }
        else {
            return proc(_v);
        }
    };
    $.fn.filter = function (p) {
        $(this).each(function (i) {
            $(this).attr({'style': 'text-align:left'});

            this.value = $(this).removeText(this.value);
            this.value = $(this).numberFormat(this.value);

            $(this).bind('keypress keyup', function (e) {
                this.value = $(this).removeText(this.value);
                this.value = $(this).numberFormat(this.value);
            });
        });
    };

})(jQuery);

/*dropdown-mypage dropdown feature*/
$(window).on('load', function () {
    if ($('#dropdown-mypage').css("display") != "none") {
        $('#dropdown-mypage').hide();
    } else {
        return false;
    }

    $('#dropdown-mypage-show').click(function (e) {
        e.stopPropagation();
        $('#dropdown-mypage').slideToggle();
    });

    $(document).click(function () {
        if ($('#dropdown-mypage').css("display") != "none") {
            $('#dropdown-mypage').slideUp();
        } else {
            return false;
        }
    })

});
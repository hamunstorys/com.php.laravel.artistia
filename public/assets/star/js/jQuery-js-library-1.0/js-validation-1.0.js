(function ($) {
        $.fn.validate = {
            rex: {
                require_name: /^[\s\S]{1,255}$/,
                name: /^[\s\S]{0,255}$/,
                price: /^\d+(,\d+)*,{0,11}$/,
                email: /^((([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,})){0,255})$/,
                url: /^(https?:\/\/)?([a-z\d\.-]+)\.([a-z\.]{2,6})([\/\w\.-]*)*\/?$/,
                phone: /((\d{3})(\d{1,4})(\d{1,4})){0,11}/,
                comment: /^[\s\S]{0,255}$/,
            },
            replaceCommas: function (att, length, error) {
                att.focusout(function () {
                    $.fn.validate.setLimitCharacters(att, length, /,/g);
                    att.val(att.val().replace(/[^0-9]+/g, '').replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,').replace(/^0/, ''));
                });
                att.bind('keyup keypress keydown', function () {
                    if (error !== null && error.css("display") != "none") {
                        error.hide("slow");
                    }
                });
            },
            replaceCellphone: function (att, length, error) {
                att.focusout(function () {
                    $.fn.validate.setLimitCharacters(att, length, /-/g);
                    att.val(att.val().replace(/[^0-9]+/g, '').replace(/(\d{3})(\d{1,4})(\d{1,4})/, "$1-$2-$3"));
                });
                att.bind('keyup keypress keydown', function () {
                    if (error !== null && error.css("display") != "none") {
                        error.hide("slow");
                    }
                });
            },
            replaceGeneral: function (att, length, error) {
                att.focusout(function () {
                    $.fn.validate.setLimitCharacters(att, length, null);
                });
                att.bind('keyup keypress keydown', function () {
                    if (error !== null && error.css("display") != "none") {
                        error.hide("slow");
                    }
                })
            },
            selectedOption: function (att, error) {
                att.bind('click', function () {
                    if (error != null & att.val() != 0) {
                        error.hide("slow");
                    }
                });
            },
            removeCommas: function (str) {
                return parseInt(str.replace(/,/g, ""));
            },
            removeDashes: function (str) {
                return parseInt(str.replace(/-/g, ""));
            },
            setLimitCharacters: function (att, length, rex) {
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

            generalValidation: function (required, flush, att, rex, error) {
                if (typeof "boolean" === required || required === true) {
                    if (rex.test(att.val()) != true) {
                        if (typeof "boolean" === flush || flush === true) {
                            att.val("");
                        }
                        error.show("fast");
                        return false;
                    }
                } else {
                    if (att.val().length !== 0 && rex.test(att.val()) != true) {
                        if (typeof "boolean" === flush || flush === true) {
                            att.val("");
                        }
                        error.show("fast");
                        return false;
                    }
                }
            },
            selectValidation: function (att, error) {
                if (att.val() == 0) {
                    error.show("fast");
                    return false;
                }
            },
            validation: function ($callback) {
                if (typeof "function" === $callback) {
                    if ($callback() === true) {
                        return true;
                    }
                }
            },
        }
    }
)(jQuery);
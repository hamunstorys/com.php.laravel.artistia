(function ($) {
        $.fn.validate = {
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
                att.bind('keyup keypress keydown focusout', function () {
                    if (error.css("display") != "none") {
                        error.hide("slow");
                    }
                    att.each(function () {
                        $.fn.validate.setLimitCharacters(att, length, /,/g);
                        att.val(att.val().replace(/^([1-9])0-9\.]+/g, '').replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,'));
                    })
                });
            },
            replaceCellphone: function (att, length, error) {
                att.bind('keyup keypress keydown focusout', function () {
                    if (error.css("display") != "none") {
                        error.hide("slow");
                    }
                    att.each(function () {
                        $.fn.validate.setLimitCharacters(att, length, /-/g);
                        att.val(att.val().replace(/[^0-9\.]+/g, '').replace(/(\d{3})(\d{1,4})(\d{1,4})/, "$1-$2-$3"));
                    })

                });
            },
            replaceGeneral: function (att, length, error) {
                att.bind('keyup keypress keydown focusout', function () {
                    if (error.css("display") != "none") {
                        error.hide("slow");
                    }
                    att.each(function () {
                        $.fn.validate.setLimitCharacters(att, length, null);
                    })

                });
            },
            selectedOption: function (att, error) {
                att.bind('select', function () {
                    if (att.val() != 0) {
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
            validation: function () {
                if ($.fn.validate.generalValidation(true, false, $.fn.validate.data.artist_name, $.fn.validate.rex.require_name, $.fn.validate.error.artist_name) === false
                ) {
                    return false;
                }
                if ($.fn.validate.generalValidation(false, false, $.fn.validate.data.guarantee_concert, $.fn.validate.rex.price, $.fn.validate.error.guarantee_concert) === false) {
                    return false;
                }
                if ($.fn.validate.generalValidation(false, false, $.fn.validate.data.guarantee_metropolitan, $.fn.validate.rex.price, $.fn.validate.error.guarantee_metropolitan) === false) {
                    return false;
                }
                if ($.fn.validate.generalValidation(false, false, $.fn.validate.data.guarantee_central, $.fn.validate.rex.price, $.fn.validate.error.guarantee_central) === false) {
                    return false;
                }
                if ($.fn.validate.generalValidation(false, false, $.fn.validate.data.guarantee_south, $.fn.validate.rex.price, $.fn.validate.error.guarantee_south) === false) {
                    return false;
                }
                if ($.fn.validate.generalValidation(false, false, $.fn.validate.data.manager_name, $.fn.validate.rex.name, $.fn.validate.error.manager_name) === false) {
                    return false;
                }
                if ($.fn.validate.generalValidation(false, false, $.fn.validate.data.manager_phone, $.fn.validate.rex.phone, $.fn.validate.error.manager_phone) === false) {
                    return false;
                }
                if ($.fn.validate.generalValidation(false, false, $.fn.validate.data.company_name, $.fn.validate.rex.name, $.fn.validate.error.manager_phone) === false) {
                    return false;
                }
                if ($.fn.validate.generalValidation(false, false, $.fn.validate.data.company_email, $.fn.validate.rex.email, $.fn.validate.error.company_email) === false) {
                    return false;
                }
                if ($.fn.validate.generalValidation(false, false, $.fn.validate.data.comment, $.fn.validate.rex.comment, $.fn.validate.error.comment) === false) {
                    return false;
                }
                if ($.fn.validate.selectValidation($.fn.validate.data.group_type_number, $.fn.validate.error.group_type_number) === false) {
                    return false;
                }
                if ($.fn.validate.selectValidation($.fn.validate.data.group_type_sex, $.fn.validate.error.group_type_sex) === false) {
                    return false;
                }
                if ($.fn.validate.selectValidation($.fn.validate.data.group_type_song_genres, $.fn.validate.error.group_type_song_genres) === false) {
                    return false;
                }
                return true;
            },
        }
    }
)(jQuery);
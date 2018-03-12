(function ($) {
    $.fn.session = {
        create: function () {
            url = $('#url-session-create').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: {
                    email: $('input[name="email"]').val(),
                    password: $('input[name="password"]').val(),
                },
                success: function () {
                    window.location = '/star'
                },
                error: function (jqXHR) {
                    var response = $.parseJSON(jqXHR.responseText);
                    if (response.message) {
                        alert(response.message);
                    }
                }
            });
        }
    }
})(jQuery);
$(window).on('load', function () {
    if ($('#dropdown-mypage').css("display") != "none") {
        $('#dropdown-mypage').hide();
    }

    $('#dropdown-mypage-show').click(function (e) {
        e.stopPropagation();
        $('#dropdown-mypage').slideToggle();
    });

    $(document).click(function () {
        if ($('#dropdown-mypage').css("display") != "none") {
            $('#dropdown-mypage').slideUp();
        }
    })
});
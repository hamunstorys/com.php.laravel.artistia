$(document).ready(function () {
    if ($('#dropdown-mypage').css("display") != "none") {
        $('#dropdown-mypage').slideUp();
    }

    $('#dropdown-mypage-show').click(function () {
        if ($('#dropdown-mypage').css("display") != "none") {
            $('#dropdown-mypage').slideUp();
        } else {
            $('#dropdown-mypage').slideDown();
        }
    });
})
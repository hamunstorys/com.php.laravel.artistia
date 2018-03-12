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

    $('button#btn_search').click(function (e) {
        e.preventDefault();
        if (!$('#query').val() &&
            $('#search_group_type_number').val() == 0 &&
            $('#search_group_type_sex').val() == 0 &&
            $('#search_group_type_song_genre').val() == 0 &&
            !parseInt($('#search_guarantee_min').val()) &&
            !parseInt($('#search_guarantee_max').val())
        ) {
            alert('검색어 혹은 검색 필터 조건을 유효하게 입력해주십시오.');
        }
        else {
            $("#target").submit();
        }
    });
    $('button#btn_reset_search').click(function (e) {
        e.preventDefault();
        $('#query').val(null);
        $('#search_group_type_number').val(0);
        $('#search_group_type_sex').val(0);
        $('#search_group_type_song_genre').val(0);
        $('#search_guarantee_min').val(null);
        $('#search_guarantee_max').val(null);
    })

    $.fn.validate.replaceCommas($('#search_guarantee_min'), 11, null);
    $.fn.validate.replaceCommas($('#search_guarantee_max'), 11, null);
})
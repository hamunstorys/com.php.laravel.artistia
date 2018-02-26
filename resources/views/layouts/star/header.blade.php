<header>
    <div class="top_wrap">
        <div class="top logo">
            <a href="{{route('star.index')}}"><img src="{{asset('assets/star/img/logo.svg')}}"></a>
            <span>SJ COMPANY</span>
        </div>
        <div class="top account">
            <script type="text/javascript">
                $(document).ready(function () {
                    $('.dropdown-menu').click(function (event) {
                        event.stopPropagation();
                        $(".dropdown").slideToggle("fast");
                    });
                    $(".dropdown").on("click", function (event) {
                        event.stopPropagation();
                    });
                });

                $(document).on("dropdown-menu", function () {
                    $(".dropdown").hide();
                });

            </script>
            <i class="fas fa-user-circle icon mypage dropdown-menu"></i>
            <a href="{{route('star.session.destroy')}}"><i class="fas fa-sign-out-alt icon logout"></i></a>
            <div class="mypage_drop dropdown">
                <ul>
                    <li>마이페이지</li>
                    <a href="" {{route('star.artist.create')}}">
                    <li>아티스트 등록하기</li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
</header>
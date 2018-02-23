<header>
    <div class="top">
        <div class="logo"><a href="{{route('star.index')}}"><img
                        src="{{asset('assets/star/img/logo.svg')}}"></a><span>SJ COMPANY</span> 아티스트 데이터베이스
        </div>
        <div class="logout">
            <form action="{{route('star.artist.create')}}">
                {{csrf_field()}}
                <button type="submit">등록</button>
            </form>
            <button>로그아웃</button>
        </div>
        <div class="clearfix"></div>
    </div>
</header>
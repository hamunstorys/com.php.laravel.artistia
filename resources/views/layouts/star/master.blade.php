@include('layouts.star.head')
<body>
@include('layouts.star.header')
<div class="container">
    <form action="{{route('star.search')}}" method="get">
        {{csrf_field()}}
        <div class="search_header">
            <div class="search_wrap">
                <?php if (Session::has('query')) {
                    echo '<input class="form-search" name="query" placeholder="검색어를 입력해 주세요" autocomplete="off" value="' . Session::get('query') . '">';
                } else {
                    echo '<input class="form-search" name="query" placeholder="검색어를 입력해 주세요" autocomplete="off">';
                }?>
                <button class="btn_search" type="submit"></button>
            </div>
            <div class="search_option_wrap">
                <div class="search_option">
                    <button class="btn_all">전체목록<span class="all_num">1,234</span></button>
                    <label>유형</label>
                    <select name="group_type_single">
                        <option selected="selected" value="0">전체</option>
                        <option value="1">솔로</option>
                        <option value="2">그룹</option>
                    </select>s
                    <select name="group_type_sex">
                        <option selected="selected" value="0">전체</option>
                            <option value="1">혼성</option>
                            <option value="2">남성</option>
                            <option value="3">여성</option>
                    </select>
                    <label>장르</label>
                    <select name="group_type_song_genre">
                        <option selected="selected" value="">전체</option>
                        <option value="">발라드</option>
                        <option value="">댄스</option>
                        <option value="">락</option>
                        <option value="">트로트</option>
                        <option value="">인디음악</option>
                        <option value="">힙합/랩</option>
                        <option value="">재즈</option>
                        <option value="">일렉</option>
                        <option value="">뮤지컬</option>
                        <option value="">클래식</option>
                        <option value="">퓨전음악</option>
                        <option value="">인스트루먼트</option>
                    </select>
                    <label>금액</label>
                    <input type="text"><span class="dash">~</span><input type="text">
                    <button class="btn_price">검색</button>
                </div>
            </div>
        </div>
    </form>
</div>
@yield('content')
@include('layouts.star.alert')
@include('layouts.star.footer')
@yield('scripts')
</body>
</html>
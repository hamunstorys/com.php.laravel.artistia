@include('layouts.star.head')
<body>
@include('layouts.star.header')
<div class="container">
    <div class="search_header">
        <Form action="{{route('star.search')}}" method="post">
            <div class="search_wrap">
                {{csrf_field()}}
                @if(isset($query))
                    <?php echo '<input class="form-search" name="query" id="query" placeholder="검색어를 입력해 주세요" autocomplete="off" value="' . $query . '">';?>
                @else
                    <?php echo '<input class="form-search" name="query" id="query" placeholder="검색어를 입력해 주세요" autocomplete="off">' ?>

                @endif
                <button type="submit" class="btn_search" id="btn_search"></button>
            </div>
            <div class="search_option_wrap">
                <div class="search_option">
                    <button class="btn_all">전체목록<span class="all_num">1,234</span></button>
                    <label>유형</label>
                    <select name="group_type_number">
                        <option selected="selected" value="0">전체</option>
                        <option value="1">솔로</option>
                        <option value="2">그룹</option>
                    </select>
                    <select name="group_type_sex">
                        <option selected="selected" value="0">전체</option>
                        @foreach($sexes = \Session::get('search_requirement.sexes') as $sex)
                            <?php echo '<option value="' . $sex->id . '">' . $sex->value . '</option>'; ?>
                        @endforeach
                    </select>
                    <label>장르</label>
                    <select name="group_type_song_genre">
                        <option selected="selected" value="0">전체</option>
                        @foreach($song_genres = \Session::get('search_requirement.song_genres') as $song_genre)
                            <?php echo '<option value="' . $song_genre->id . '">' . $song_genre->value . '</option>'; ?>
                        @endforeach
                    </select>
                    <label>금액</label>
                    <input type="text"><span class="dash">~</span><input type="text">
                    <button type="submit" class="btn_price">검색</button>
                </div>
            </div>
        </Form>
    </div>
</div>
@yield('content')
<script src="{{asset('assets/star/js/function.js')}}" }></script>
@yield('scripts')
@include('layouts.star.footer')
</body>
</html>
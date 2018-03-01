@include('layouts.star.head')
<body>
@include('layouts.star.header')
<div class="container">
    <div class="search_header">
        <div class="search_wrap">
            <input type="hidden" name="csrf-token" content="{{csrf_token()}}"/>
            <?php if (Session::has('query')) {
                echo '<input class="form-search" name="query" id="query" placeholder="검색어를 입력해 주세요" autocomplete="off"' . Session::get('query') . '">';
            } else {
                echo '<input class="form-search" name="query" id="query" placeholder="검색어를 입력해 주세요" autocomplete="off">';
            }?>
            <button class="btn_search" id="btn_search"></button>
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
                    @foreach($sexes = Session::get('search_requirement.sexes') as $sex)
                        <?php echo '<option value="' . $sex->id . '">' . $sex->value . '</option>'; ?>
                    @endforeach
                </select>
                <label>장르</label>
                <select name="group_type_song_genre">
                    <option selected="selected" value="0">전체</option>
                    @foreach($song_generes = Session::get('search_requirement.song_generes') as $song_genere)
                        <?php echo '<option value="' . $song_genere->id . '">' . $song_genere->value . '</option>'; ?>
                    @endforeach
                </select>
                <label>금액</label>
                <input type="text"><span class="dash">~</span><input type="text">
                <button class="btn_price">검색</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#btn_search').click(function () {
        url = '/star/search';
        data = {
            query: $('.query').val(),
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            data: data,
            type: 'POST',
            success: function () {
                window.location = '/star/search/results';
            },
        });
    })
</script>
@yield('content')
@yield('scripts')
@include('layouts.star.footer')
</body>
</html>
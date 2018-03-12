@include('layouts.star.head')
<body>
@include('layouts.star.header')
<div class="container">
    <div class="search_header">
        <Form action="{{route('star.search')}}" method="post" id="target">
            <div class="search_wrap">
                {{csrf_field()}}
                @if(isset($query))
                    <?php echo '<input class="form-search" name="query" id="query" placeholder="검색어를 입력해 주세요" autocomplete="off" value="' . $query . '">';?>
                @else
                    <?php echo '<input class="form-search" name="query" id="query" placeholder="검색어를 입력해 주세요" autocomplete="off">' ?>
                @endif
                <button class="btn_search" id="btn_search"></button>
            </div>
            <div class="search_option_wrap">
                <div class="search_option">
                    <label>유형</label>
                    <select id="search_group_type_number" name="search_group_type_number">
                        @if(isset($search_group_type_numbers))
                            @foreach($search_group_type_numbers as $value)
                                <?php echo $value ?>
                            @endforeach
                        @else
                            <option selected="selected" value="0">전체</option>
                            <option value="1">솔로</option>
                            <option value="2">그룹</option>
                        @endif
                    </select>
                    <select id="search_group_type_sex" name="search_group_type_sex">
                        @if(isset($search_group_type_sexes))
                            @foreach($search_group_type_sexes as $value)
                                <?php echo $value ?>
                            @endforeach
                        @else
                            <option selected="selected" value="0">전체</option>
                            @foreach($sexes = \Session::get('artist.category.sexes') as $sex)
                                <?php echo '<option value="' . $sex->id . '">' . $sex->value . '</option>'; ?>
                            @endforeach
                        @endif
                    </select>
                    <label>장르</label>
                    <select id="search_group_type_song_genre" name="search_group_type_song_genre">
                        @if(isset($search_group_type_song_genres))
                            @foreach($search_group_type_song_genres as $value)
                                <?php echo $value ?>
                            @endforeach
                        @else
                            <option selected="selected" value="0">전체</option>
                            @foreach($song_genres = \Session::get('artist.category.song_genres') as $song_genre)
                                <?php echo '<option value="' . $song_genre->id . '">' . $song_genre->value . '</option>'; ?>
                            @endforeach
                        @endif
                    </select>
                    <label>금액</label>
                    @if(isset($search_guarantee_min))
                        <input id="search_guarantee_min" name="search_guarantee_min"
                               value="{{$search_guarantee_min}}">
                    @else
                        <input id="search_guarantee_min" name="search_guarantee_min"
                               value="{{old('guarantee_min')}}">
                    @endif
                    <span class="dash">~</span>
                    @if(isset($search_guarantee_max))
                        <input id="search_guarantee_max" name="search_guarantee_max"
                               value="{{$search_guarantee_max}}">
                    @else
                        <input id="search_guarantee_max" name="search_guarantee_max"
                               value="{{old('guarantee_max')}}">
                    @endif
                </div>

            </div>
        </Form>
        <a href="{{route('star.search.showAll')}}">
            <button>전체목록<span
                        class="all_num">{{\App\Models\Star\Star_Artist::count()}}</span></button>
        </a>
        <button class="btn_reset_search" id="btn_reset_search">검색 초기화</button>
    </div>
</div>
</div>
@yield('content')
<script src="{{asset('assets/star/js/validation-artist.js')}}" type="text/javascript"></script>
{{--<script src="{{asset('assets/star/js/ajax-artist.js')}}"></script>--}}
<script>
    $(document).ready(function ($) {

        $.fn.validate.replaceCommas($('#search_guarantee_min'), 11, null);
        $.fn.validate.replaceCommas($('#search_guarantee_max'), 11, null);

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

    })
</script>
@yield('scripts')
@include('layouts.star.footer')
</body>
</html>
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
                    {{--<a href="{{route('star.search.show')}}">--}}
                    {{--<button class="btn_all">전체목록<span--}}
                    {{--class="all_num">{{\App\Models\Star\Star_Artist::count()}}</span></button>--}}
                    {{--</a>--}}
                    <label>유형</label>
                    <select name="group_type_number">
                        @if(isset($group_type_number))
                            @foreach($group_type_number as $value)
                                <?php echo $value ?>
                            @endforeach
                        @else
                            <option selected="selected" value="0">전체</option>
                            <option value="1">솔로</option>
                            <option value="2">그룹</option>
                        @endif
                    </select>
                    <select name="group_type_sex">
                        @if(isset($group_type_sex))
                            @foreach($group_type_sex as $value)
                                <?php echo $value ?>
                            @endforeach
                        @else
                            <option selected="selected" value="0">전체</option>
                            @foreach($sexes = \Session::get('search_requirement.sexes') as $sex)
                                <?php echo '<option value="' . $sex->id . '">' . $sex->value . '</option>'; ?>
                            @endforeach
                        @endif
                    </select>
                    <label>장르</label>
                    <select name="group_type_song_genre">
                        @if(isset($group_type_song_genre))
                            @foreach($group_type_song_genre as $value)
                                <?php echo $value ?>
                            @endforeach
                        @else
                            <option selected="selected" value="0">전체</option>
                            @foreach($song_genres = \Session::get('search_requirement.song_genres') as $song_genre)
                                <?php echo '<option value="' . $song_genre->id . '">' . $song_genre->value . '</option>'; ?>
                            @endforeach
                        @endif
                    </select>
                    <label>금액</label>
                    @if(isset($guarantee_min))
                        <input type="number" name="guarantee_min" value="{{$guarantee_min}}">
                    @else
                        <input type="number" name="guarantee_min" value="{{old('guarantee_min')}}">
                    @endif
                    <span class="dash">~</span>
                    @if(isset($guarantee_max))
                        <input type="number" name="guarantee_max"
                               value="{{$guarantee_max}}">
                    @else
                        <input type="number" name="guarantee_max" value="{{old('guarantee_max')}}">
                    @endif
                    <button type="submit" class="btn_price">검색</button>
                </div>
            </div>
        </Form>
    </div>
</div>
@yield('content')
@yield('scripts')
@include('layouts.star.footer')
</body>
</html>
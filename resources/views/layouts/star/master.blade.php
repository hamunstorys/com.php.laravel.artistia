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
        </div>
    </form>
</div>
@yield('content')
@include('layouts.star.alert')
@include('layouts.star.footer')
@yield('scripts')
</body>
</html>
@include('layouts.star.head');
<body>
@include('layouts.star.header')
<div class="container">
    <form action="{{route('star.search')}}" method="POST">
        {{csrf_field()}}
        <div class="search_header">
            <div class="search_wrap">
                <input class="form-search" name="query" placeholder="검색어를 입력해 주세요">
                <button class="btn_search" type="submit"></button>
            </div>
        </div>
    </form>
</div>
@yield('content')
@include('layouts.star.footer')
</body>
</html>
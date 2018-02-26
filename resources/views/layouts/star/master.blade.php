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
					<select>
						<option selected="selected">전체</option>
						<option>솔로</option>
						<option>그룹</option>
					</select>
					<select>
						<option selected="selected">전체</option>
						<option>혼성</option>
						<option>남성</option>
						<option>여성</option>
					</select>
					<label>장르</label>
					<select>
						<option selected="selected">전체</option>
						<option>발라드</option>
						<option>댄스</option>
						<option>락</option>
						<option>트로트</option>
						<option>인디음악</option>
						<option>힙합/랩</option>
						<option>재즈</option>
						<option>일렉</option>
						<option>뮤지컬</option>
						<option>클래식</option>
						<option>퓨전음악</option>
						<option>인스트루먼트</option>
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
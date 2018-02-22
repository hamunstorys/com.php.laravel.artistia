@extends('layouts.star.master')
@section('content')
    <div class="result_wrap">
        <form action="{{route('star.artist.store')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="photo">
                <input type="file" name="picture_url">
            </div>
            <div class="info">
                <div class="item name {{ $errors->has('artist_name')?'has-error':'' }}">
                    <input name="artist_name" type="text" placeholder="가수를 입력해주세요" value="{{old('artist_name')}}">
                    {!! $errors->first('artist_name', ':message') !!}
                </div>
                <div class="item pay">
                    <label>개런티</label>
                    <span>
						<ul>
							<li>
                                <label>콘서트</label>
                            <input class="price" name="guarantee_concert"
                                   placeholder="금액을 입력해주세요" value="{{old('guarantee_concert')}}"
                                   onkeydown='return checkInsertNumber(event)' onkeyup='removeCharacter(event)'></li>
							<li>
                                <label>서울/경기</label>
                                <input class="price" id="guarantee_metropolitan" name="guarantee_metropolitan"
                                       placeholder="금액을 입력해주세요" value="{{old('guarantee_metropolitan')}}"
                                       onkeydown='return checkInsertNumber(event)' onkeyup='removeCharacter(event)'>
                            </li>
							<li>
                                <label>중부</label>
                                <input class="price" name="guarantee_central"
                                       placeholder="금액을 입력해주세요" value="{{old('guarantee_central')}}"
                                       onkeydown='return checkInsertNumber(event)' onkeyup='removeCharacter(event)'>
                            </li>
							<li>
                                <label>남부</label>
                                <input class="price" name="guarantee_south"
                                       placeholder="금액을 입력해주세요" value="{{old('guarantee_south')}}"
                                       onkeydown='return checkInsertNumber(event)' onkeyup='removeCharacter(event)'>
                            </li>
						</ul>
					</span>
                </div>
                <div class="item manager">
                    <label>담당자</label>
                    <input class="option" name="manager_name"
                           placeholder="담당자 이름" value="{{old('manager_name')}}">
                    <input class="option" name="manager_phone"
                           placeholder="담당자 연락처" value="{{old('manager_phone')}}">
                </div>
                <div class="item company">
                    <label>소속사</label>
                    <input class="option" name="company_name"
                           placeholder="소속사" value="{{old('company_name')}}">
                    <input class="option" name="company_email"
                           placeholder="소속사 이메일" value="{{old('company_email')}}">
                </div>
                <div class="item memo">
                    <label>메모</label>
                    <textarea class="memo" rows="3" name="comment"
                              placeholder="참고사항을 입력하세요">{{old('comment')}}</textarea>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="btn_wrap">
                <button class="btn_add" name="submit" type="submit">등록하기</button>
            </div>
        </form>
        <form action="{{route('star.search')}}" method="get">
            {{csrf_field()}}
            <div class="btn_wrap">
                <button class="btn_add" type="submit">취소하기</button>
            </div>
        </form>
    </div><!-- result_wrap -->
@section('scripts')
    <script>
        function checkInsertNumber(event) {
            event = event || window.event;
            var keyID = (event.which) ? event.which : event.keyCode;
            if ((keyID >= 48 && keyID <= 57) || (keyID >= 96 && keyID <= 105) || keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39)
                return;
            else
                return false;
        }

        function removeCharacter(event) {
            event = event || window.event;
            var keyID = (event.which) ? event.which : event.keyCode;
            if (keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39)
                return;
            else
                event.target.value = event.target.value.replace(/[^0-9]/g, "");
        }
    </script>
@endsection
@endsection
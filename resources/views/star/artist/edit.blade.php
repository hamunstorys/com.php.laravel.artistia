@extends('layouts.star.master')
@section('content')
    <div class="result_wrap">
        <form action="{{route('star.artist.update',$artist->id)}}" method="POST" autocomplete="off"
              enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="query" value="{{$query}}">
            <div class="photo" style="background: url('{{$artist->picture_url}}')">
               <input type="file" name="picture_url" value="{{$artist->picture_url}}">
            </div>
            <div class="info">
                <div class="item name {{ $errors->has('artist_name')?'has-error':'' }}">
                    <input name="artist_name" type="text" placeholder="가수를 입력해주세요"
                           value="{{$artist->artist_name}}">
                    {!! $errors->first('artist_name', ':message') !!}
                </div>
                <div class="item pay">
                    <label>개런티</label>
                    <span>
						<ul>
							<li>
                                <label>콘서트</label>
                                <input class="price" name="guarantee_concert"
                                       placeholder="금액을 입력해주세요"
                                       value="{{$artist->guarantee_concert}}"
                                       onkeydown='return checkInsertNumber(event)' onkeyup='removeCharacter(event)'>
                            </li>
							<li>
                                <label>서울/경기</label>
                                <input class="price" name="guarantee_metropolitan"
                                       placeholder="금액을 입력해주세요"
                                       value="{{$artist->guarantee_metropolitan}}"
                                       onkeydown='return checkInsertNumber(event)' onkeyup='removeCharacter(event)'>
                            </li>
							<li>
                                <label>중부</label>
                                <input class="price" name="guarantee_central"
                                       placeholder="금액을 입력해주세요"
                                       value="{{$artist->guarantee_central}}"
                                       onkeydown='return checkInsertNumber(event)' onkeyup='removeCharacter(event)'>
                            </li>
							<li>
                                <label>남부</label>
                                <input class="price" name="guarantee_south"
                                       placeholder="금액을 입력해주세요"
                                       value="{{$artist->guarantee_south}}"
                                       onkeydown='return checkInsertNumber(event)' onkeyup='removeCharacter(event)'>
                            </li>
						</ul>
					</span>
                </div>
                <div class="item manager">
                    <label>담당자</label>
                    <input class="option" name="manager_name"
                           placeholder="담당자 이름"
                           value="{{$artist->manager_name}}">
                    <input class="option" name="manager_phone"
                           placeholder="담당자 연락처"
                           value="{{$artist->manager_phone}}">
                </div>
                <div class="item company">
                    <label>소속사</label>
                    <input class="option" name="company_name"
                           placeholder="소속사"
                           value="{{$artist->company_name}}">
                    <input class="option" name="company_email"
                           placeholder="소속사 이메일"
                           value="{{$artist->company_email}}">
                </div>
                <div class="item memo">
                    <label>메모</label>
                    <textarea class="memo" rows="3" name="comment"
                              placeholder="참고사항을 입력하세요">{{$artist->comment}}</textarea>
                </div>
                <div class="item">
                    <label>등록일</label>
                    <span>{{$artist->created_at}}</span>
                </div>

                <div class="item">
                    <label>최종 수정일</label>
                    <span>{{$artist->updated_at}}</span>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="btn_wrap">
                <button class="btn_add" name="submit" type="submit">수정하기</button>
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
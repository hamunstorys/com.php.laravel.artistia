@extends('layouts.star.master')
@section('content')
    <div class="result_wrap">
        <input type="hidden" name="csrf-token" content="{{csrf_token()}}"/>
        <input type="hidden" id="url" value="{{route('star.artist.store')}}">
        <div class="poster"
             {{ $errors->has('picture_url')?'has-error':'' }} style="background-image: url('{{old('picture_url')}}')">
            <i class="far fa-file-image"></i>
            <h4>대표 이미지 업로드</h4>
            <p>파일 형식은 jpg 또는 png로,<br>사이즈는 가로 620px, 세로 465px 이상으로 올려주세요.</p>
            <input type="file" id="picture_url" name="picture_url">
            {!! $errors->first('picture_url', ':message') !!}
        </div>
        <div class="info">
            <div class="item name {{ $errors->has('artist_name')?'has-error':'' }}">
                <input id="artist_name" name="artist_name" type="text" placeholder="이름을 입력해주세요"
                       value="{{old('artist_name')}}">
                {!! $errors->first('artist_name', ':message') !!}
            </div>

            <div class="item pay">
                <label>개런티</label>
                <span>
						<ul>
							<li>
                                <label>콘서트</label>
                                <input class="price" id="guarantee_concert" name="guarantee_concert"
                                       placeholder="금액을 입력해주세요"
                                       value="{{old('guarantee_concert')}}">
                            </li>
							<li>
                                <label>서울/경기</label>
                                <input class="price" id="guarantee_metropolitan" name="guarantee_metropolitan"
                                       placeholder="금액을 입력해주세요"
                                       value="{{old('guarantee_metropolitan')}}">
                            </li>
							<li>
                                <label>중부</label>
                                <input class="price" id="guarantee_central" name="guarantee_central"
                                       placeholder="금액을 입력해주세요"
                                       value="{{old('guarantee_central')}}">
                            </li>
							<li>
                                <label>남부</label>
                                <input class="price" name="guarantee_south"
                                       placeholder="금액을 입력해주세요"
                                       value="{{old('guarantee_south')}}">
                            </li>
						</ul>
					</span>
            </div>
            <div class="item manager">
	                <span>
                    <label>담당자</label>
                    <input class="option" id="manager_name" name="manager_name"
                           placeholder="담당자 이름"
                           value="{{old('manager_name')}}">
                    <input class="option" id="manager_phone" name="manager_phone"
                           placeholder="담당자 연락처"
                           value="{{old('manager_phone')}}">
	                </span>
            </div>
            <div class="item company">
	                <span>
                    <label>소속사</label>
                    <input class="option" id="company_name" name="company_name"
                           placeholder="소속사"
                           value="{{old('company_name')}}">
                    <input class="option" id="company_email" name="company_email"
                           placeholder="소속사 이메일"
                           value="{{old('company_email')}}">
	                </span>
            </div>
            <div class="item memo">
                <label>참고내용</label>
                <textarea class="memo" rows="3" id="comment" name="comment"
                          placeholder="참고사항을 입력하세요">{{old('comment')}}</textarea>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="btn_wrap">
            <button id="confirm">확인</button>
            <button id="cancle" onclick="window.history.go(-1)">취소하기</button>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        jQuery(function () {
            $('.price').filter();
        });
        $('button#confirm').click(function () {
            url = $('#url').val();
            data = {
                picture_url: $('#picture_url').val(),
                artist_name: $('#artist_name').val(),
                guarantee_concert: $('#guarantee_concert').val(),
                guarantee_metropolitan: $('#guarantee_metropolitan').val(),
                guarantee_central: $('#guarantee_central').val(),
                manager_name: $('#manager_name').val(),
                manager_phone: $('#manager_phone').val(),
                company_name: $('#company_name').val(),
                company_email: $('#company_email').val(),
                comment: $('#comment').val()
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
                    alert('등록 되었습니다.');
                    window.location = '/star';
                },
                error: function (data) {
                    alert('등록 실패');
                }
            });
        })
    </script>
@endsection
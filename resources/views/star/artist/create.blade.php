@extends('layouts.star.master')
@section('content')
    <div class="result_wrap">
        <form action="{{route('star.artist.store')}}" method="POST" autocomplete="off"
              enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="poster"
                 {{ $errors->has('picture_url')?'has-error':'' }} style="background-image: url('{{old('picture_url')}}')">
                <i class="far fa-file-image"></i>
                <h4>대표 이미지 업로드</h4>
                <p>파일 형식은 jpg 또는 png로,<br>사이즈는 가로 620px, 세로 465px 이상으로 올려주세요.</p>
                <input type="file" name="picture_url">
                {!! $errors->first('picture_url', ':message') !!}
            </div>
            <div class="info">
                <div class="item name {{ $errors->has('artist_name')?'has-error':'' }}">
                    <input name="artist_name" type="text" placeholder="이름을 입력해주세요"
                           value="{{old('artist_name')}}">
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
                                       value="{{old('guarantee_concert')}} {{ $errors->has('guarantee_concert')?'has-error':'' }}">
                                {!! $errors->first('guarantee_concert', ':message') !!}
                            </li>
							<li>
                                <label>서울/경기</label>
                                <input class="price" name="guarantee_metropolitan"
                                       placeholder="금액을 입력해주세요"
                                       value="{{old('guarantee_metropolitan')}}">
                            </li>
							<li>
                                <label>중부</label>
                                <input class="price" name="guarantee_central"
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
                    <input class="option" name="manager_name"
                           placeholder="담당자 이름"
                           value="{{old('manager_name')}}">
                    <input class="option" name="manager_phone"
                           placeholder="담당자 연락처"
                           value="{{old('manager_phone')}}">
	                </span>
                </div>
                <div class="item company">
	                <span>
                    <label>소속사</label>
                    <input class="option" name="company_name"
                           placeholder="소속사"
                           value="{{old('company_name')}}">
                    <input class="option" name="company_email"
                           placeholder="소속사 이메일"
                           value="{{old('company_email')}}">
	                </span>
                </div>
                <div class="item memo">
                    <label>참고내용</label>
                    <textarea class="memo" rows="3" name="comment"
                              placeholder="참고사항을 입력하세요">{{old('comment')}}</textarea>
                </div>
                <div class="item">
                    <label>등록일</label>
                    <span>{{old('created_at')}}</span>
                </div>
                <div class="item">
                    <label>최종 수정일</label>
                    <span>{{old('updated_at')}}</span>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="btn_wrap">
                <button name="submit" type="submit">확인</button>
                <a href="{{route('star.search.results')}}">
                    <button name="submit">취소하기</button>
                </a>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/star/js/function.js')}}"></script>
    <script type="text/javascript">
        jQuery(function () {
            $('.price').filter();
        });
    </script>
@endsection
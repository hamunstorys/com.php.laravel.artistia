@extends('layouts.star.master')
@section('content')
    <div class="result_wrap">
        <form action="{{route('star.artist.update',$artist->id)}}" method="POST" autocomplete="off"
              enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="photo"
                 style="background-image: url('{{$artist->picture_url}}')" {{ $errors->has('picture_url')?'has-error':'' }}>
                <input type="file" name="picture_url">
                {!! $errors->first('picture_url', ':message') !!}
            </div>
            <div class="info">
                <div class="item name {{ $errors->has('artist_name')?'has-error':'' }}">
                    <input name="artist_name" type="text" placeholder="이름을 입력해주세요"
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
                                       value="{{$artist->guarantee_concert}}">
                            </li>
							<li>
                                <label>서울/경기</label>
                                <input class="price" name="guarantee_metropolitan"
                                       placeholder="금액을 입력해주세요"
                                       value="{{$artist->guarantee_metropolitan}}">
                            </li>
							<li>
                                <label>중부</label>
                                <input class="price" name="guarantee_central"
                                       placeholder="금액을 입력해주세요"
                                       value="{{$artist->guarantee_central}}">
                            </li>
							<li>
                                <label>남부</label>
                                <input class="price" name="guarantee_south"
                                       placeholder="금액을 입력해주세요"
                                       value="{{$artist->guarantee_south}}">
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
                    <label>참고내용</label>
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
                <button name="submit" type="submit">확인</button>
                <button><a href="{{route('star.search.results')}}">취소하기</a></button>
            </div>
        </form>
    </div>
@section('scripts')
    <script src="{{asset('assets/star/js/function.js')}}"></script>
    <script type="text/javascript">
        jQuery(function () {
            $('input.price').onlyNumber();
        });
    </script>
@endsection
@endsection
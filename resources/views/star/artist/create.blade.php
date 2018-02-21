@extends('layouts.star.master')
@section('content')
    <div class="result_wrap">
        <form action="{{route('star.artist.store')}}" method="POST">
            {{csrf_field()}}
            <div class="photo"></div>
            <div class="info">
                <div class="item name {{ $errors->has('artist_name')?'has-error':'' }}">
                    <input name="artist_name" type="text" placeholder="가수를 입력해주세요">
                    {!! $errors->first('artist_name', ':message') !!}
                </div>
                <div class="item pay">
                    <label>개런티</label>
                    <span>
						<ul>
							<li>
                                <label>콘서트</label>
                                <input class="price" name="guarantee_concert"
                                       placeholder="금액을 입력해주세요" {{ $errors->has('guarantee_concert')?'has-error':'' }}>
                                {!! $errors->first('guarantee_concert', ':message') !!}
                            </li>
							<li>
                                <label>서울/경기</label>
                                <input class="price" name="guarantee_metropolitan"
                                       placeholder="금액을 입력해주세요" {{ $errors->has('guarantee_metropolitan')?'has-error':'' }}>
                                {!! $errors->first('guarantee_metropolitan', ':message') !!}
                            </li>
							<li>
                                <label>중부</label>
                                <input class="price" name="guarantee_central"
                                       placeholder="금액을 입력해주세요" {{ $errors->has('guarantee_central')?'has-error':'' }}>
                                {!! $errors->first('guarantee_central', ':message') !!}
                            </li>
							<li>
                                <label>남부</label>
                                <input class="price" name="guarantee_south"
                                       placeholder="금액을 입력해주세요" {{ $errors->has('guarantee_south')?'has-error':'' }}>
                                {!! $errors->first('guarantee_south', ':message') !!}
                            </li>
						</ul>
					</span>
                </div>
                <div class="item manager">
                    <label>담당자</label>
                    <input class="option" name="manager_name"
                           placeholder="담당자 이름" {{ $errors->has('manager_name')?'has-error':'' }}>
                    {!! $errors->first('manager_name', ':message') !!}
                    <input class="option" name="manager_phone"
                           placeholder="담당자 연락처" {{ $errors->has('manager_phone')?'has-error':'' }}>
                    {!! $errors->first('manager_phone', ':message') !!}
                </div>
                <div class="item company">
                    <label>소속사</label>
                    <input class="option" name="company_name"
                           placeholder="소속사" {{ $errors->has('company_name')?'has-error':'' }}>
                    {!! $errors->first('company_name', ':message') !!}
                    <input class="option" name="company_email"
                           placeholder="소속사 이메일" {{ $errors->has('company_email')?'has-error':'' }}>
                    {!! $errors->first('company_email', ':message') !!}
                </div>
                <div class="item memo">
                    <label>메모</label>
                    <textarea class="memo" rows="3" name="comment"
                              placeholder="참고사항을 입력하세요" {{ $errors->has('comment')?'has-error':'' }}></textarea>
                    {!! $errors->first('comment', '<span class="form-error">:message</span>') !!}
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="btn_wrap">
                <button class="btn_add" name="submit" type="submit">등록하기</button>
            </div>
        </form>
    </div><!-- result_wrap -->
@endsection
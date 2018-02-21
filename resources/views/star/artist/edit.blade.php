@extends('layouts.star.master')
@section('content')
    <div class="result_wrap">
        <form action="{{route('star.artist.update',$artist->id)}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="photo" style="background: url('{{$artist->picture_url}}')"></div>
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
                                       value="{{$artist->guarantee_concert}}" {{ $errors->has('guarantee_concert')?'has-error':'' }}>
                                {!! $errors->first('guarantee_concert', ':message') !!}
                            </li>
							<li>
                                <label>서울/경기</label>
                                <input class="price" name="guarantee_metropolitan"
                                       placeholder="금액을 입력해주세요"
                                       value="{{$artist->guarantee_metropolitan}}" {{ $errors->has('guarantee_metropolitan')?'has-error':'' }}>
                                {!! $errors->first('guarantee_metropolitan', ':message') !!}
                            </li>
							<li>
                                <label>중부</label>
                                <input class="price" name="guarantee_central"
                                       placeholder="금액을 입력해주세요"
                                       value="{{$artist->guarantee_central}}" {{ $errors->has('guarantee_central')?'has-error':'' }}>
                                {!! $errors->first('guarantee_central', ':message') !!}
                            </li>
							<li>
                                <label>남부</label>
                                <input class="price" name="guarantee_south"
                                       placeholder="금액을 입력해주세요"
                                       value="{{$artist->guarantee_south}}" {{ $errors->has('guarantee_south')?'has-error':'' }}>
                                {!! $errors->first('guarantee_south', ':message') !!}
                            </li>
						</ul>
					</span>
                </div>
                <div class="item manager">
                    <label>담당자</label>
                    <input class="option" name="manager_name"
                           placeholder="담당자 이름"
                           value="{{$artist->manager_name}}" {{ $errors->has('manager_name')?'has-error':'' }}>
                    {!! $errors->first('manager_name', ':message') !!}
                    <input class="option" name="manager_phone"
                           placeholder="담당자 연락처"
                           value="{{$artist->manager_phone}}" {{ $errors->has('manager_phone')?'has-error':'' }}>
                    {!! $errors->first('manager_phone', ':message') !!}
                </div>
                <div class="item company">
                    <label>소속사</label>
                    <input class="option" name="company_name"
                           placeholder="소속사" value="{{$artist->company_name}}" {{ $errors->has('company_name')?'has-error':'' }}>
                    {!! $errors->first('company_name', ':message') !!}
                    <input class="option" name="company_email"
                           placeholder="소속사 이메일" value="{{$artist->company_email}}"{{ $errors->has('company_email')?'has-error':'' }}>
                    {!! $errors->first('company_email', ':message') !!}
                </div>
                <div class="item memo">
                    <label>메모</label>
                    <textarea class="memo" rows="3" name="comment"
                              placeholder="참고사항을 입력하세요" {{ $errors->has('comment')?'has-error':'' }}>{{$artist->comment}}</textarea>
                    {!! $errors->first('comment', '<span class="form-error">:message</span>') !!}
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
        <form action="{{route('star.artist.destroy',$artist->id)}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="delete">
            <div class="btn_wrap">
                <button class="btn_add" type="submit">삭제하기</button>
            </div>
        </form>
    </div><!-- result_wrap -->
@endsection
@extends('layouts.star.master')
@section('content')
    <div class="contents">
        @if(isset($data) || isset($total_data))
            <?php echo '결과 값이 전체 ' . $total_data . '개 중에서 ' . $data->count() . '개 만큼 검색 되었습니다.'; ?>
            @foreach($data as $artist)
                <div class="result_wrap">
                        <div class="photo"
                             style="background: url('{{$artist->picture_url}}')"></div>
                        <div class="info">
                            <div class="item name">{{$artist->artist_name}}</div>
                            <div class="item pay">
                                <label>개런티</label>
                                <span>
                        <ul>
                            <li><label>콘서트</label>{{$artist->guarantee_concert}}</li>
                            <li><label>서울/경기</label>{{$artist->guarantee_metropolitan}}</li>
                            <li><label>중부</label>{{$artist->guarantee_central}}</li>
                            <li><label>남부</label>{{$artist->guarantee_south}}</li>
                        </ul>
                    </span>
                            </div>
                            <div class="item manager">
                                <label>담당자</label>
                                <span>{{$artist->manager_name}}</span>
                            </div>
                            <div class="item company">
                                <label>소속사</label>
                                <span>{{$artist->company_name}}</span>
                            </div>
                            <div class="item memo">
                                <label>메모</label>
                                <span>{{$artist->comment}}</span>
                            </div>
                            <div class="item memo">
                                <label>등록일</label>
                                <span>{{$artist->created_at}}</span>
                            </div>
                            <div class="item memo">
                                <label>최종수조일</label>
                                <span>{{$artist->updated_at}}</span>
                            </div>
                            <Form action="{{route('star.artist.edit',$artist->id)}}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="query" value="{{$query}}">
                                <button>수정</button>
                            </Form>
                            <div>
                                <form action="{{route('star.artist.destroy',$artist->id)}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit">삭제하기</button>
                                </form>
                            </div>
                        </div>
                    <div class="clearfix"></div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
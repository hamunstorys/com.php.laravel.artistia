@extends('layouts.star.master')
@section('content')
    <div class="contents">
        @if(isset($data) || isset($total_data))
            <?php echo '<div class="search_result_title"><span class="total">"' . Session::get('query') . '"</span>에 대해 <span>' . $data->count() . '</span>건이 검색되었습니다."</div>'; ?>
            @foreach($data as $artist)
                <div class="result_wrap">
                    <div class="photo"
                         style="background-image: url('{{$artist->picture_url}}')"></div>
                    <div class="info">
                        <div class="item name">
                            {{$artist->artist_name}}
                            <div class="item_del">
                                <form action="{{route('star.artist.destroy',$artist->id)}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" class="icon_del"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="item pay">
                            <label>개런티</label>
                            <span>
			                        <ul>
			                            <li><label>콘서트</label><span><?php if ($artist->guarantee_concert == null) {
                                                    echo '0';
                                                } else {
                                                    echo $artist->guarantee_concert;
                                                }
                                                ?>
			                            </span></li>
			                            <li><label>행사(서울/경기)</label><span><?php if ($artist->guarantee_metropolitan == null) {
                                                    echo '0';
                                                } else {
                                                    echo $artist->guarantee_metropolitan;
                                                }
                                                ?>
                                            </span></li>
			                            <li><label>행사(중부)</label><span><?php if ($artist->guarantee_central == null) {
                                                    echo '0';
                                                } else {
                                                    echo $artist->guarantee_central;
                                                }
                                                ?></span></li>
			                            <li><label>행사(남부)</label><span><?php if ($artist->guarantee_south == null) {
                                                    echo '0';
                                                } else {
                                                    echo $artist->guarantee_south;
                                                }
                                                ?></span></li>
			                        </ul>
			                    </span>
                        </div>
                        <div class="item manager">
                            <label>담당자</label>
                            <span>{{$artist->manager_name}}</span><span
                                    class="contact">{{$artist->manager_phone}}</span>
                        </div>
                        <div class="item company">
                            <label>소속사</label>
                            <span>{{$artist->company_name}}</span><span
                                    class="contact">{{$artist->company_email}}</span>
                        </div>
                        <div class="item memo">
                            <label>참고내용</label>
                            <span>{{$artist->comment}}</span>
                        </div>
                        <div class="item memo">
                            <label>최초등록일</label>
                            <span>{{$artist->created_at}}</span>
                        </div>
                        <div class="item memo">
                            <label>최종수정일</label>
                            <span>{{$artist->updated_at}}</span>
                        </div>
                        <div class="btn_wrap">
                            <Form action="{{route('star.artist.edit',$artist->id)}}" method="get">
                                {{csrf_field()}}
                                <button>수정하기</button>
                            </Form>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
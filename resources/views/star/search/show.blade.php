@extends('layouts.star.master')
@section('content')
    <div class="contents">
        <?php
        if (isset($message)) {
            echo $message;
        }?>
        @if(isset($data))
            @foreach($data as $artist)
                <div class="result_wrap">
                    <div class="photo"
                         style="background-image: url('{{$artist->picture_url}}')"></div>
                    <div class="info">
                        <div class="item name">
                            {{$artist->artist_name}}
                            <div class="item_del">
                                <form action="{{route('star.artist.destroy',$artist->artist_id)}}" method="post">
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
                                        <li><label>콘서트</label><span>{{number_format($artist->guarantee_concert)}}</span></li>
			                            <li><label>행사(서울/경기)</label><span>{{number_format($artist->guarantee_metropolitan)}}</span></li>
			                            <li><label>행사(중부)</label><span>{{number_format($artist->guarantee_central)}}</span></li>
			                            <li><label>행사(남부)</label><span>{{number_format($artist->guarantee_south)}}</span></li>
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
                            <label>그룹 유형(인원)</label>
                            @if($artist->group_type_number == 1)
                                <span>솔로</span>
                            @else
                                <span>그룹</span>
                            @endif
                        </div>
                        <div class="item memo">
                            <label>그룹 유형(성별)</label>
                            <span>{{\App\Models\Star\Star_Artist_Sex::where('id',"=",$artist->group_type_sex)->first()->value}}</span>
                        </div>
                        <div class="item memo">
                            <label>그룹 유형(장르)</label>
                            @foreach(\App\Models\Star\Star_Artist::find($artist->artist_id)->song_genres()->get() as $song_genre)
                                <span>{{$song_genre->value}}</span>
                            @endforeach
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
                            <a href="{{route('star.artist.edit',$artist->artist_id)}}">
                                <button>수정하기</button>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
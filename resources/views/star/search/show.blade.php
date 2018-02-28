@extends('layouts.star.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">>
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
                                <input type="hidden" id="url-{{$artist->id}}"
                                       value="{{route('star.artist.destroy',$artist->id)}}">
                                <input type="hidden" id="_method-{{$artist->id}}" value="delete">
                                <button class="icon_del"
                                        onclick="ajax($('#url-{{$artist->id}}').val(),$('#_method-{{$artist->id}}').val())">
                                    <i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                        <div class="item pay">
                            <label>개런티</label>
                            <span>
			                        <ul>
                                        <li><label>콘서트</label><span><?php echo $helper->NumberNullCheck($artist->guarantee_concert) ?></span></li>
			                            <li><label>행사(서울/경기)</label><span><?php echo $helper->NumberNullCheck($artist->guarantee_metropolitan) ?></span></li>
			                            <li><label>행사(중부)</label><span><?php echo $helper->NumberNullCheck($artist->guarantee_central) ?></span></li>
			                            <li><label>행사(남부)</label><span><?php echo $helper->NumberNullCheck($artist->guarantee_south) ?></span></li>
			                        </ul>
			                    </span>
                        </div>
                        <div class="item manager">
                            <label>담당자</label>
                            <span>{{$artist->manager_name}}</span><span
                                    class="contact">{{$artist->manager_phone}}</span>
                        </div>
                        <div class="item company">
                            <label>소속사</label>W
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
                            <a href="{{route('star.artist.edit',$artist->id)}}">
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
@section('scripts')
    <script type="text/javascript">
        jQuery(function () {
            $('.price').filter();
        });
        function ajax(url, method) {
            if (confirm("삭제하시겠습니까?") == true) {
                data = {
                    _method: method
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    data: data,
                    type: 'POST',
                    success: function () {
                        alert('삭제 되었습니다.');
                        window.history.go(-1);
                    },
                    error: function ($error) {
                        alert('삭제에 실패하였습니다.');
                    }
                });
            }
        }
    </script>
@endsection
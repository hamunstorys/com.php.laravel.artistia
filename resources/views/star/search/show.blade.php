@extends('layouts.star.master')
@section('content')
    <div class="contents">
        @if(isset($data) || isset($total_data))
            <?php echo '<div class="search_result_title"><span class="total">"' . Session::get('query') . '"</span>에 대해 <span>' . $data->count() . '</span>건이 검색되었습니다."</div>'; ?>
            @foreach($data as $artist)
                <div class="result_wrap">
                    <input type="hidden" name="csrf-token" content="{{csrf_token()}}"/>
                    <input type="hidden" id="id" value="{{$artist->id}}"/>
                    <div class="photo"
                         style="background-image: url('{{$artist->picture_url}}')"></div>
                    <div class="info">
                        <div class="item name">
                            {{$artist->artist_name}}
                            <div class="item_del">
                                <input type="hidden" id="url" value="{{route('star.artist.destroy',$artist->id)}}">
                                <input type="hidden" id="_method" name="_method" value="delete">
                                <button id="delete" class="icon_del" value="{{$artist->id}}"><i class="fas fa-trash-alt"></i></button>
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
    <script src="{{asset('assets/star/js/function.js')}}"></script>
    <script type="text/javascript">
        jQuery(function () {
            $('.price').filter();
        });
        
        $('button#delete').click(function () {
            if (confirm("삭제하시겠습니까?") == true) {

                url = $('#url').val();
                data = {
                    _method: $('#_method').val(),
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
                        alert('삭제 되었습니다.');
                        window.location = back();
                    },
                    error: function ($error) {
                        alert('삭제에 실패하였습니다.');
                    }
                });
            }
        })
    </script>
@endsection
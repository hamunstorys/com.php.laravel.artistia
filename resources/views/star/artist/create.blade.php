@extends('layouts.star.master')
@section('content')
    <div class="result_wrap">
        {{--<Form action="{{route('star.artist.store')}}" method="post">--}}
        {{--{{csrf_field()}}--}}
        <input type="hidden" name="csrf-token" content="{{csrf_token()}}"/>
        <input type="hidden" id="url" value="{{route('star.artist.store')}}">
        <div class="poster"
             {{ $errors->has('picture_url')?'has-error':'' }} style="background-image: url('{{old('picture_url')}}')">
            <i class="far fa-file-image"></i>
            <h4>대표 이미지 업로드</h4>
            <p>파일 형식은 jpg 또는 png로,<br>사이즈는 가로 620px, 세로 465px 이상으로 올려주세요.</p>
            <input type="file" id="picture_url" name="picture_url">
        </div>
        <div class="info">
            <div class="item name {{ $errors->has('artist_name')?'has-error':'' }}">
                <input id="artist_name" name="artist_name" type="text" placeholder="이름을 입력해주세요"
                       value="{{old('artist_name')}}">
                <div class="tooltip" id="error-artist_name" style="display: none">1자 이상 16자 이하 필수 입력 항목입니다.</div>
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
                                  <div class="tooltip" id="error-guarantee_concert" style="display: none">1자 이상 11자 이하 숫자만 입력 가능합니다.</div>
                            </li>
							<li>
                                <label>서울/경기</label>
                                <input class="price" id="guarantee_metropolitan" name="guarantee_metropolitan"
                                       placeholder="금액을 입력해주세요"
                                       value="{{old('guarantee_metropolitan')}}">
                                    <div class="tooltip" id="error-guarantee_metropolitan" style="display: none">1자 이상 11자 이하 숫자만 입력 가능합니다.</div>
                            </li>
							<li>
                                <label>중부</label>
                                <input class="price" id="guarantee_central" name="guarantee_central"
                                       placeholder="금액을 입력해주세요"
                                       value="{{old('guarantee_central')}}">
                                  <div class="tooltip" id="error-guarantee_central" style="display: none">1자 이상 11자 이하 숫자만 입력 가능합니다.</div>
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
            <div class="item group_type">
                <label>유형 선택</label>
                <select name="group_type_number" id="group_type_number">
                    <option selected="selected">인원 수</option>
                    <option value="1">솔로</option>
                    <option value="2">그룹</option>
                </select>
                <select name="group_type_sex" id="group_type_sex">
                    <option selected="selected">성별</option>
                    @foreach($sexes = Session::get('search_requirement.sexes') as $sex)
                        <?php echo '<option value="' . $sex->id . '">' . $sex->value . '</option>'; ?>
                    @endforeach
                </select>
            </div>
            <div class="item group_type">
                <label>장르 선택</label>
                <select name="group_type_song_genres" id="group_type_song_genres">
                    <option selected="selected">장르</option>
                    @foreach($song_genres = Session::get('search_requirement.song_genres') as $song_genre)
                        <?php echo '<option value="' . $song_genre->id . '">' . $song_genre->value . '</option>'; ?>
                    @endforeach
                </select>
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
        {{--</Form>--}}
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        // $('button#confirm').click(function () {
        //     url = $('#url').val();
        //     data = {
        //         picture_url: $('#picture_url').val(),
        //         artist_name: $('#artist_name').val(),
        //         guarantee_concert: $('#guarantee_concert').val(),
        //         guarantee_metropolitan: $('#guarantee_metropolitan').val(),
        //         guarantee_central: $('#guarantee_central').val(),
        //         manager_name: $('#manager_name').val(),
        //         manager_phone: $('#manager_phone').val(),
        //         company_name: $('#company_name').val(),
        //         company_email: $('#company_email').val(),
        //         group_type_number: $('#group_type_number').val(),
        //         group_type_sex: $('#group_type_sex').val(),
        //         group_type_song_genre: $('#group_type_song_genre').val(),
        //         comment: $('#comment').val(),
        //     };
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         url: url,
        //         data: data,
        //         type: 'POST',
        //         success: function () {
        //             alert('등록 되었습니다.');
        //             window.location = '/star';
        //         },
        //         error: function (data) {
        //             alert('등록 실패');
        //         }
        //     });
        // })
        $(document).ready(function ($) {
            var rex_name = /^[\s\S]{1,16}$/;
            var rex_price = /^[0-9]{0,11}$/;
            var re_email = /^([\w\.-]+)@([a-z\d\.-]+)\.([a-z\.]{2,6})$/;
            var re_url = /^(https?:\/\/)?([a-z\d\.-]+)\.([a-z\.]{2,6})([\/\w\.-]*)*\/?$/;
            var re_tel = /^[0-9]{8,11}$/;

            var
                artist_name = $('#artist_name'),
                guarantee_concert = $('#guarantee_concert'),
                guarantee_metropolitan = $('#guarantee_metropolitan'),
                guarantee_central = $('#guarantee_central');
            

            $.fn.addCommas(guarantee_concert);
            $.fn.addCommas(guarantee_metropolitan);
            $.fn.addCommas(guarantee_central);

            $('button#confirm').click(function () {

                    $guarantee_concert = $.fn.removeComma(guarantee_concert.val());
                    $guarantee_metropolitan = $.fn.removeComma(guarantee_metropolitan.val());
                    $guarantee_central = $.fn.removeComma(guarantee_central.val());

                    if (rex_name.test(artist_name.val()) != true) {
                        $("#error-artist_name").show();
                    } else if (!isNaN($guarantee_concert) && rex_price.test($guarantee_concert) != true) {
                        guarantee_concert.val("");
                        $("#error-guarantee_concert").show();
                    } else if (!isNaN($guarantee_metropolitan) && rex_price.test($guarantee_metropolitan) != true) {
                        guarantee_metropolitan.val("");
                        $("#error-guarantee_metropolitan").show();
                    } else if (!isNaN($guarantee_central) && rex_price.test($guarantee_central) != true) {
                        guarantee_central.val("");
                        $("#error-guarantee_central").show();
                    }
                }
            );

            artist_name.keyup(function () {
                $("#error-artist_name").hide();
            });
            guarantee_concert.keyup(function () {
                $("#error-guarantee_concert").hide();
            });
            guarantee_metropolitan.keyup(function () {
                $("#error-guarantee_metropolitan").hide();
            });
        });
    </script>
@endsection
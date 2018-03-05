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
                <div class="tooltip" id="error-artist_name" style="display: none">1자 이상 필수 입력 항목입니다. 한글(모음,자음 제외),
                    영어,
                    숫자만 가능합니다.
                </div>
            </div>
            <div class="tooltip" id="error-artist_name" style="display: none">1자 이상 필수 입력 항목입니다. 한글(모음,자음 제외),
                영어,
                숫자만 가능합니다.
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
                                <input class="price" id="guarantee_south" name="guarantee_south"
                                       placeholder="금액을 입력해주세요"
                                       value="{{old('guarantee_south')}}">
                                  <div class="tooltip" id="error-guarantee_south" style="display: none">1자 이상 11자 이하 숫자만 입력 가능합니다.</div>
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
                         <div class="tooltip" id="error-manager_name" style="display: none">1자 이상 입력 항목입니다.</div>
                    <input class="option" id="manager_phone" name="manager_phone"
                           placeholder="담당자 연락처"
                           value="{{old('manager_phone')}}">
                        <div class="tooltip" id="error-manager_phone"
                             style="display: none">11자 입력 항목입니다.</div>
	                </span>
            </div>
            <div class="item company">
	                <span>
                    <label>소속사</label>
                    <input class="option" id="company_name" name="company_name"
                           placeholder="소속사"
                           value="{{old('company_name')}}">
                         <div class="tooltip" id="error-company_name"
                              style="display: none">1자 이상 입력 항목입니다.</div>
                    <input class="option" id="company_email" name="company_email"
                           placeholder="소속사 이메일"
                           value="{{old('company_email')}}">
                         <div class="tooltip" id="error-company_email"
                              style="display: none">유효한 이메일 형식이 아닙니다.</div>
	                </span>
            </div>
            <div class="item group_type">
                <label>유형 선택</label>
                <select name="group_type_number" id="group_type_number">
                    <option selected="selected" value="0">인원 수</option>
                    <option value="1">솔로</option>
                    <option value="2">그룹</option>
                </select>
                <div class="tooltip" id="error-group_type_number"
                     style="display: none">필수 입력 사항입니다.
                </div>
                <select name="group_type_sex" id="group_type_sex">
                    <option selected="selected" value="0">성별</option>
                    @foreach($sexes = Session::get('search_requirement.sexes') as $sex)
                        <?php echo '<option value="' . $sex->id . '">' . $sex->value . '</option>'; ?>
                    @endforeach
                </select>
                <div class="tooltip" id="error-group_type_sex"
                     style="display: none">필수 입력 사항입니다.
                </div>
            </div>
            <div class="item group_type">
                <label>장르 선택</label>
                <select name="group_type_song_genres" id="group_type_song_genres">
                    <option selected="selected" value="0">장르</option>
                    @foreach($song_genres = Session::get('search_requirement.song_genres') as $song_genre)
                        <?php echo '<option value="' . $song_genre->id . '">' . $song_genre->value . '</option>'; ?>
                    @endforeach
                </select>
                <div class="tooltip" id="error-group_type_genres"
                     style="display: none">필수 입력 사항입니다.
                </div>
            </div>
            <div class="item memo">
                <label>참고내용</label>
                <textarea class="memo" rows="3" id="comment" name="comment"
                          placeholder="참고사항을 입력하세요">{{old('comment')}}</textarea>
                <div class="tooltip" id="error-comment"
                     style="display: none">255자까지 입력 가능합니다.
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="btn_wrap">
            <button id="confirm" onclick="$.fn.validateArtist()">확인</button>
            <button id="cancle" onclick="window.history.go(-1)">취소하기</button>
        </div>
        {{--</Form>--}}
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">

        $(document).ready(function ($) {
            var
                artist_name = $('#artist_name'),
                guarantee_concert = $('#guarantee_concert'),
                guarantee_metropolitan = $('#guarantee_metropolitan'),
                guarantee_central = $('#guarantee_central'),
                guarantee_south = $('#guarantee_south'),
                manager_name = $('#manager_name'),
                manager_phone = $('#manager_phone'),
                company_name = $('#company_name'),
                company_email = $('#company_email'),
                group_type_number = $('#group_type_number'),
                group_type_sex = $('#group_type_sex'),
                group_type_genres = $('#group_type_song_genres'),
                comment = $('#comment');

            $.fn.replaceName(artist_name, 255);
            $.fn.replaceCommas(guarantee_concert, 11);
            $.fn.replaceCommas(guarantee_metropolitan, 11);
            $.fn.replaceCommas(guarantee_central, 11);
            $.fn.replaceCommas(guarantee_south, 11);
            $.fn.replaceName(manager_name, 255);
            $.fn.replaceCellphone(manager_phone, 11);
            $.fn.replaceName(company_name, 255);
            $.fn.replaceEmail(company_email, 255),
                $.fn.replaceComment(company_email, 255);
        })

        $.fn.ajax = function () {

            var
                artist_name = $('#artist_name'),
                guarantee_concert = $('#guarantee_concert'),
                guarantee_metropolitan = $('#guarantee_metropolitan'),
                guarantee_central = $('#guarantee_central'),
                guarantee_south = $('#guarantee_south'),
                manager_name = $('#manager_name'),
                manager_phone = $('#manager_phone'),
                company_name = $('#company_name'),
                company_email = $('#company_email'),
                group_type_number = $('#group_type_number'),
                group_type_sex = $('#group_type_sex'),
                group_type_genres = $('#group_type_song_genres'),
                comment = $('#comment');

            url = $('#url').val();
            data = {
                picture_url: $('#picture_url').val(),
                artist_name: artist_name.val(),
                guarantee_concert: guarantee_concert.val(),
                guarantee_metropolitan: guarantee_metropolitan.val(),
                guarantee_central: guarantee_central.val(),
                guarantee_south: guarantee_south.val(),
                manager_name: manager_name.val(),
                manager_phone: manager_phone.val(),
                company_name: company_name.val(),
                company_email: company_email.val(),
                group_type_number: group_type_number.val(),
                group_type_sex: group_type_sex.val(),
                group_type_song_genre: group_type_genres.val(),
                comment: comment.val()
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
                    alert('등록 되었습니다.');
                    window.location = '/star';
                },
            });
        }

        $.fn.validateArtist = function () {

            var
                artist_name = $('#artist_name'),
                guarantee_concert = $('#guarantee_concert'),
                guarantee_metropolitan = $('#guarantee_metropolitan'),
                guarantee_central = $('#guarantee_central'),
                guarantee_south = $('#guarantee_south'),
                manager_name = $('#manager_name'),
                manager_phone = $('#manager_phone'),
                company_name = $('#company_name'),
                company_email = $('#company_email'),
                group_type_number = $('#group_type_number'),
                group_type_sex = $('#group_type_sex'),
                group_type_genres = $('#group_type_song_genres'),
                comment = $('#comment');


            var rex_require_name = /^[\s\S]{1,255}$/;
            var rex_name = /^[\s\S]{0,255}$/;
            var rex_price = /^[0-9]{0,11}$/;
            var rex_email = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            var rex_url = /^(https?:\/\/)?([a-z\d\.-]+)\.([a-z\.]{2,6})([\/\w\.-]*)*\/?$/;
            var rex_phone = /(\d{3})(\d{4})(\d{4})/;
            var rex_comment = /^[\s\S]{1,255}$/;

            $.fn.requiredValidateName(artist_name, rex_require_name, $('#error-artist_name'));

            $.fn.optionalValidateNumber(guarantee_concert, rex_price, $('#error-guarantee_concert'));
            $.fn.optionalValidateNumber(guarantee_metropolitan, rex_price, $('#error-guarantee_metropolitan'));
            $.fn.optionalValidateNumber(guarantee_central, rex_price, $('#error-guarantee_central'));
            $.fn.optionalValidateNumber(guarantee_south, rex_price, $('#error-guarantee_south'));

            $.fn.optionalValidateName(manager_name, rex_name, $('#error-manager_name'));

            if (manager_phone.val().length !== 0 && rex_phone.test(manager_phone.val()) != true) {
                manager_phone.val("");
                $("#error-manager_phone").show("fast");
                setTimeout(function () {
                    $("#error-manager_phone").hide("slow");
                }, 3000);
            }

            $.fn.optionalValidateName(company_name, rex_name, $('#error-company_name'));

            if (company_email.val().length !== 0 && rex_email.test(company_email.val()) != true) {
                company_email.val("");
                $("#error-company_email").show("fast");
                setTimeout(function () {
                    $("#error-company_email").hide("slow");
                }, 3000);
            }

            if (comment.val().length !== 0 && rex_comment.test(comment.val()) != true) {
                comment.val("");
                $("#error-comment").show("fast");
                setTimeout(function () {
                    $("#error-comment").hide("slow");
                }, 3000);
            }
            $.fn.requiredSelectValidate(group_type_number, $('#error-group_type_number'));
            $.fn.requiredSelectValidate(group_type_sex, $('#error-group_type_sex'));
            $.fn.requiredSelectValidate(group_type_genres, $('#error-group_type_genres'));

            $.fn.ajax();
        }
    </script>
@endsection
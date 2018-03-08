<?php ini_set("display_errors", 1) ?>
@extends('layouts.star.master')
@section('content')
    <div class="result_wrap">
        <div class="poster">
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
                <div class="tooltip" id="error-group_type_song_genres"
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
            <button id="confirm">확인</button>
            <button id="cancle" onclick="window.history.go(-1)">취소하기</button>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/star/js/validation-artist.js')}}" type="text/javascript"></script>
    {{--<script src="{{asset('assets/star/js/ajax-artist.js')}}"></script>--}}
    <script>
        $(document).ready(function ($) {

            $.fn.validate.replaceGeneral($.fn.validate.data.artist_name, 255, $.fn.validate.error.artist_name);

            $.fn.validate.replaceCommas($.fn.validate.data.guarantee_concert, 11, $.fn.validate.error.guarantee_concert);
            $.fn.validate.replaceCommas($.fn.validate.data.guarantee_metropolitan, 11, $.fn.validate.error.guarantee_metropolitan);
            $.fn.validate.replaceCommas($.fn.validate.data.guarantee_central, 11, $.fn.validate.error.guarantee_central);
            $.fn.validate.replaceCommas($.fn.validate.data.guarantee_south, 11, $.fn.validate.error.guarantee_south);

            $.fn.validate.replaceGeneral($.fn.validate.data.manager_name, 255, $.fn.validate.error.manager_name);
            $.fn.validate.replaceCellphone($.fn.validate.data.manager_phone, 11, $.fn.validate.error.manager_phone);

            $.fn.validate.replaceGeneral($.fn.validate.data.company_name, 255, $.fn.validate.error.company_name);
            $.fn.validate.replaceGeneral($.fn.validate.data.company_email, 255, $.fn.validate.error.company_email);

            $.fn.validate.selectedOption($.fn.validate.data.group_type_number, $.fn.validate.error.group_type_number);
            $.fn.validate.selectedOption($.fn.validate.data.group_type_sex, $.fn.validate.error.group_type_sex);
            $.fn.validate.selectedOption($.fn.validate.data.group_type_song_genres, $.fn.validate.error.group_type_song_genres);

            $.fn.validate.replaceGeneral($.fn.validate.data.comment, 255, $.fn.validate.error.comment);

        })

        $(document).on('click', 'button#confirm', function (e) {
            e.preventDefault();
            if ($.fn.validate.validation() === true) {
                var data = new FormData();
                data.append("picture_url", $('#picture_url')[0].files[0]);
                data.append("artist_name", $('#artist_name').val());
                data.append("guarantee_concert", $('#guarantee_concert').val());
                data.append("guarantee_metropolitan", $('#guarantee_metropolitan').val());
                data.append("guarantee_central", $('#guarantee_central').val());
                data.append("guarantee_south", $('#guarantee_south').val());
                data.append("manager_name", $('#manager_name').val());
                data.append("manager_phone", $('#manager_phone').val());
                data.append("company_name", $('#company_name').val());
                data.append("company_email", $('#company_email').val());
                data.append("group_type_number", $('#group_type_number').val());
                data.append("group_type_sex", $('#group_type_sex').val());
                data.append("group_type_song_genres", $('#group_type_song_genres').val());
                data.append("comment", $('#comment').val());

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route('star.artist.store')}}',
                    type: 'POST',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function () {
                        alert('등록 되었습니다.');
                        window.location = "/star"
                    }
                });
            }
        });
    </script>
@endsection
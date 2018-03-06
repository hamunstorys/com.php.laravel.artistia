@include('layouts.star.head')
<body>
<div class="login_container">
    <div class="login_wrap">
    <!-- img src="{{asset('assets/star/img/logo.svg')}}"-->
        <div class="logo"><i class="material-icons star">star_rate</i><span>스타피디아</span>starpedia</div>
        <div class="login_box">
            <h1>LOGIN</h1>
            <Form action="javascript:$.fn.session.create()">
                <input type="hidden" name="csrf-token" content="{{csrf_token()}}"/>
                <input type="hidden" id="url" value="{{route('star.session.store')}}">
                <input type="text" name="email" placeholder="이메일을 입력해주세요" value="{{old('email')}}">
                <input type="password" name="password" placeholder="비밀번호를 입력해주세요" value="{{old('password')}}">
                <input type="checkbox" id="check"/><label for="check">아이디 저장</label>
                <button id="login" label="로그인하기" class="btn_login">로그인</button>
            </Form>
            <div class="divider">회원이 아니세요?</div>
            <button id="join" label="가입신청" class="btn_join">가입신청하기</button>
        </div>
        <div class="copyright">
            © 2018 SJCOMPANY.
        </div>
    </div>
</div>
</body>
</html>
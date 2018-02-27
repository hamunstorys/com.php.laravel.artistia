@include('layouts.star.head')
<body>
<div class="login_container">
    <div class="login_wrap">
        <img src="{{asset('assets/star/img/logo.svg')}}">
        <FORM action="{{route('star.session.store')}}" method="post">
            {{csrf_field()}}
            <div class="login_box">
                <h1>LOGIN</h1>
                <input type="text" name="email" placeholder="이메일을 입력해주세요" value="{{old('email')}}">
                <input type="password" name="password" placeholder="비밀번호를 입력해주세요" value="{{old('password')}}">
                <button type="submit" label="로그인하기">로그인</button>
            </div>
        </FORM>
        <div class="copyright">
            © 2018 SJCOMPANY Inc.
        </div>
    </div>
</div>
@include('layouts.star.alert')
</body>
</html>
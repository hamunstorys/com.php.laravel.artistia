@include('layouts.star.head')
<body>
<div class="login_container">
    <div class="login_wrap">
        <img src="{{'assets/img/star/sj_logo.svg'}}">
        <FORM action="{{'star.index'}}">
            <div class="login_box">
                <h1>LOGIN</h1>
                <input type="text" name="email" placeholder="이메일을 입력해주세요">
                <input type="password" name="password" placeholder="비밀번호를 입력해주세요">
                <button type="submit" name="submit" label="로그인하기">로그인</button>
            </div>
        </FORM>
        <div class="copyright">
            © 2018 SJCOMPANY Inc.
        </div>
    </div>
</div>
</body>
</html>
@include('layouts.star.head')
<body>

<div class="login_container">
    <div class="login_wrap">
        <img src="{{asset('assets/star/img/logo.svg')}}">
        <div class="login_box">
            <h1>LOGIN</h1>
            <input type="hidden" name="csrf-token" content="{{csrf_token()}}"/>
            <input type="text" name="email" placeholder="이메일을 입력해주세요" value="{{old('email')}}">
            <input type="password" name="password" placeholder="비밀번호를 입력해주세요" value="{{old('password')}}">
            <button id="login" label="로그인하기">로그인</button>
        </div>
        </FORM>
        <div class="copyright">
            © 2018 SJCOMPANY Inc.
        </div>
    </div>
</div>
<script type="text/javascript">
    $('button#login').click(function () {
        url = '{{secure_url(route('star.session.store', [], false))}}';
        data = {
            picture_url: $('input[name="email"]').val(),
            artist_name: $('input[name="password"]').val(),
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
                window.location = '/star';
            },
            id: function () {
                alert('아이디가 틀렸습니다.');
            },
            password: function () {
                alert('비밀번호가 틀렸습니다.');
            }
        });
    })
</script>
</body>
</html>
@include('layouts.star.head')
<body>

<div class="login_container">
    <div class="login_wrap">
        <img src="{{asset('assets/star/img/logo.svg')}}">
        <div class="login_box">
            <h1>LOGIN</h1>
            <form action="javascript:$.fn.login()">
                <input type="hidden" name="csrf-token" content="{{csrf_token()}}"/>
                <input type="text" name="email" placeholder="이메일을 입력해주세요" value="{{old('email')}}">
                <input type="password" name="password" placeholder="비밀번호를 입력해주세요" value="{{old('password')}}">
                <button id="login" label="로그인하기">로그인</button>
            </form>
        </div>
        <div class="copyright">
            © 2018 SJCOMPANY Inc.
        </div>
    </div>
</div>
<script type="text/javascript">
    $.fn.login = function () {
        url = '{{route('star.session.store')}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: {
                email: $('input[name="email"]').val(),
                password: $('input[name="password"]').val(),
            },
            success: function () {
                window.location = '/star'
            },
            error: function (jqXHR) {
                var response = $.parseJSON(jqXHR.responseText);
                if (response.message) {
                    alert(response.message);
                }
            }
        });
    }
</script>
</body>
</html>
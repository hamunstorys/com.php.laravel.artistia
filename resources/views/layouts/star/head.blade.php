<!DOCTYPE html>
<html lang="{{$app->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/stage4.icon" href="img/favicon.ico">
    <title>SJ COMPANY STAR</title>
    <link href="{{asset('assets/star/css/style.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('assets/star/js/jquery-3.3.1.min.js')}}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript">
        $(window).load(function () {
            $('.slidingDiv').hide();
            $('.show_hide').click(function (e) {
                e.stopPropagation();
                $('.slidingDiv').slideToggle();
            });
            $('.slidingDiv').click(function (e) {
                e.stopPropagation();
            });

            $(document).click(function () {
                $('.slidingDiv').slideUp();
            });
        });
    </script>
</head>
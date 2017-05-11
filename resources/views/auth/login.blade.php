<!DOCTYPE html>
<html>
<head>
    <title>Авторизация</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ url('/assets/fonts/opensans/opensans.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ url('/build/Style.css') }}">
</head>
<body>
<!-- BEGIN login page -->
<div class="login-page">

    <div class="login-page__wrap">

        <!-- BEGIN login top -->
        <div class="login-top">
            <div class="login-top__rainbow-wrap">
                <div class="login-top__rainbow"></div>
            </div>
            <img src="{{ url('/assets/img/login/login-logo.svg') }}" class="login-top__logo">
        </div>
        <!-- END login top -->

        <!-- BEGIN login header -->
        <div class="login-header">

            <!-- BEGIN login text -->
            <h3 class="login-title">
                Система <br>
                Управления Знаниями
            </h3>
            <p class="login-text">
                В настоящий момент авторизация доступна<br> только через социальные сети.
            </p>
            <!-- END login text -->

            <!-- BEGIN login socials -->
            <a href="{{ url('/redirect/facebook') }}" class="login-social login-social_facebook">
                        <span class="login-social__icon icon-social-facebook">
                        </span>
            </a>
            <a href="{{ url('/redirect/google') }}" class="login-social login-social_google">
                        <span class="login-social__icon icon-social-google">
                        </span>
            </a>
            <a href="{{ url('/redirect/yandex') }}" class="login-social login-social_yandex">
                        <span class="login-social__icon icon-social-yandex">
                        </span>
            </a>
            <a href="{{ url('/redirect/vk') }}" class="login-social login-social_vk">
                        <span class="login-social__icon icon-social-vk">
                        </span>
            </a>
            <!-- END login socials -->

        </div>
        <!-- END login header -->
    </div>


    <!-- BEGIN login footer -->
    <div class="login-footer"></div>
    <!-- END login footer -->

</div>
<!-- END login page -->

</body>
</html>

<!DOCTYPE html>
<html lang="ja">
<head>

    @include("layouts._meta")

    @yield("title")

    <link rel="stylesheet" href="/css/lib/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/earlyaccess/sawarabigothic.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/common.css">

    <script src="/js/utils/CookieShop.class.js"></script>

    @yield('stylesheet')

    <script>
        window.Laravel = <?php echo json_encode([ 'csrfToken' => csrf_token(), ]); ?>
    </script>
</head>
<body>

    @if(isset($_COOKIE["WAVE_TOKEN"]))
    <header id="header">
        <div class="logo">
            <a href="/"><img src="/image/wave_logo.svg" alt="logo"></a>
        </div>
        <div class="search">
            <div class="img">
                <img src="/image/search-icon.svg" alt="search icon">
            </div>
            <input type="text" placeholder="イベントを検索" class="search-event-input">
        </div>
        <ul class="menu-list">
            <li class="event-list"><a href="/event/">イベント一覧</a></li>
            <li class="help"><a href="/help/">ヘルプ</a></li>
            <li class="icon">
                <div class="icon-image">
                    @if(isset($_COOKIE["WAVE_ICON"]))
                    <img src='{{$_COOKIE["WAVE_ICON"]}}' alt="icon">
                    @else
                    <img src="/image/user/defaulticon.png" alt="icon">
                    @endif
                </div>
                <p href='/@<?php echo $_COOKIE["WAVE_NICKNAME"]; ?>'>{{$_COOKIE["WAVE_NICKNAME"]}}</p>
                <i class="fa fa-caret-down" aria-hidden="true"></i>
                <ul class="menu _hidden">
                    <li class="menu-item"><a href='/@<?php echo $_COOKIE["WAVE_NICKNAME"]; ?>'>プロフィール</a></li>
                    <li class="menu-item"><a href="/logout" class="menu-logout">ログアウト</a></li>
                </ul>
            </li>
            <li class="notif">
                <img src="/image/user/alarm.svg" alt="notification icon">
            </li>
        </ul>
    </header>
    @else
    <header id="header">
        <div class="logo">
            <a href="/"><img src="/image/wave_logo.svg" alt="logo"></a>
        </div>
        <div class="search">
            <div class="img">
                <img src="/image/search-icon.svg" alt="search icon">
            </div>
            <input type="text" placeholder="イベントを検索" class="search-event-input">
        </div>
        <ul class="menu-list">
            <li><a href="/event/">イベント一覧</a></li>
            <li><a href="/help/">ヘルプ</a></li>
            <li><a href="/login">ログイン / 新規登録</a></li>
        </ul>
    </header>
    @endif

    <main id="main">
        @yield("content")
    </main>

    <footer id="footer">
        <small>&copy; 2017 MOREINVEST All Right Reserved.</small>
    </footer>

<script src="/js/lib/jquery.min.js"></script>
<script src="/js/lib/TweenMax.min.js"></script>
<script src="/js/lib/vue.min.js"></script>
<script src="/js/common.js"></script>
@yield('javascript')
</body>
</html>
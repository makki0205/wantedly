<!DOCTYPE html>
<html lang="ja">
<head>

    @include("layouts._meta")

    @yield("title")

    <link rel="stylesheet" href="/css/lib/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/earlyaccess/sawarabigothic.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/sp-common.css">

    <script src="/js/utils/CookieShop.class.js"></script>

    @yield('stylesheet')

    <script>
        window.Laravel = <?php echo json_encode([ 'csrfToken' => csrf_token(), ]); ?>
    </script>
</head>
<body>

    <header id="header">
        <div class="menu-button">
            <div class="img">
                <img src="/image/wave_logo.svg" alt="logo">
            </div>
            <i class="fa fa-angle-down menu-state" aria-hidden="true"></i>
        </div>
    </header>

    @if(isset($_COOKIE["WAVE_TOKEN"]))
    <ul class="menu-list">
        <li class="menu-item"><a href="/">ホーム</a></li>
        <li class="menu-border"></li>
        <li class="menu-item"><a href="/event/">イベント一覧</a></li>
        <li class="menu-item"><a href='/@<?php echo $_COOKIE["WAVE_NICKNAME"]; ?>'>プロフィール</a></li>
        <li class="menu-border"></li>
        <li class="menu-item"><a href="/help">ヘルプ</a></li>
        <li class="menu-item"><a href="/logout" class="menu-logout">ログアウト</a></li>
    </ul>
    @else
    <ul class="menu-list">
        <li class="menu-item"><a href="/">ホーム</a></li>
        <li class="menu-border"></li>
        <li class="menu-item"><a href="/event/">イベント一覧</a></li>
        <li class="menu-item"><a href="/register">新規登録</a></li>
        <li class="menu-item"><a href="/login">ログイン</a></li>
        <li class="menu-border"></li>
        <li class="menu-item"><a href="/help">ヘルプ</a></li>
    </ul>
    @endif

    <main id="main">
        @yield("content")
    </main>

    <footer id="footer">
        <small>&copy; 2017 MOREINVEST All Rights Reserved.</small>
    </footer>

<script src="/js/lib/jquery.min.js"></script>
<script src="/js/lib/TweenMax.min.js"></script>
<script src="/js/lib/vue.min.js"></script>
<script src="/js/sp-common.js"></script>
@yield("javascript")
</body>
</html>
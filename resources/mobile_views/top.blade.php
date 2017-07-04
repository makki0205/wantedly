@extends("layouts.app")

@section("title")
<title>トップ | WAVE</title>
@endsection

@section("stylesheet")
<link rel="stylesheet" href="/css/lib/flickity.min.css">
<link rel="stylesheet" href="/css/sp-top.css">
@endsection

@section("content")
<div class="main-container">
    <div class="main-view">
        <img src="/image/top-main-view.png" alt="">

        <div class="main-view-message">
            <h1 class="sawarabi-font">
                やりたいことを、<br>
                WAVEでみつけよう。
            </h1>
        </div>

    </div>
    

    <div class="event-gallery">
        <h2>
            学生のための「学ぶ」イベントを。
        </h2>
        <div class="gallery">
            <ul class="gallery-ul">
                <li><a href="#"><img src="/image/events/event-01.png" alt=""></a></li>
                <li><a href="#"><img src="/image/events/event-02.png" alt=""></a></li>
                <li><a href="#"><img src="/image/events/event-03.png" alt=""></a></li>
                <li><a href="#"><img src="/image/events/event-04.png" alt=""></a></li>
                <li><a href="#"><img src="/image/events/event-05.png" alt=""></a></li>
            </ul>
        </div>
    </div>


    <div class="enjoy-the-event">
        <h2>
            効率よくイベントを楽しもう。
        </h2>
        <ul>
            <li>
                <img src="/image/enquete.svg" alt="アンケート画像">
                <h3>アンケート入力</h3>
                <p class="sawarabi-font">
                    WAVEでは事前にアンケートを<br>
                    取ることでイベント毎の<br>
                    面倒くさいアンケートがなくなります。
                </p>
            </li>
            <li>
                <img src="/image/chat.svg" alt="チャット画像">
                <h3>イベントごとのチャット機能</h3>
                <p class="sawarabi-font">
                    イベント会場の人と<br>
                    チャット内でいつでも議論ができます。
                </p>
                <p class="sawarabi-font">
                    他の参加者には見られたくない質問も<br>
                    主催者だけに送ることもできます。
                </p>
            </li>
        </ul>
    </div>

</div>
@section("javascript")
<script src="/js/lib/flickity.pkgd.min.js"></script>
<script>
    $('.gallery-ul').flickity({
        wrapAround: true,
        autoPlay: true,
        prevNextButtons: false
    });
</script>
@endsection
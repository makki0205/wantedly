@extends("layouts.app")

@section("title")
<title>トップ | WAVE</title>
@endsection

@section("stylesheet")
<link rel="stylesheet" href="/css/lib/flickity.min.css">
<link rel="stylesheet" href="/css/top.css">
@endsection

@section("content")
<div class="main-container">
  <div class="main-view">
    <div class="main-view-message">
      <h1>
        やりたいことを、<br>
        WAVEでみつけよう。
      </h1>
    </div>

    <div class="login-form _hidden">
      <p class="title">ログイン / 新規登録</p>

      <div class="form-content">
        <form action="https://wave-event.net/api/login" method="POST" id="form">
          <div class="mail-address">
            <label for="mail-address">メールアドレス</label>
            <input type="email" name="mail-address" id="mail-address" tabindex="1">
          </div>
          <div class="password">
            <label for="password">パスワード</label>
            <a href="/reset">パスワードをお忘れですか？</a>
            <input type="password" name="password" id="password" tabindex="2">
          </div>
          <div class="login-button">
            <input type="submit" value="ログイン" tabindex="3" class="input-login-button">
          </div>
        </form>
        <p>または</p>
        <div class="sign-up-button">
          <a class="sign-up" tabindex="4" href="/register/">メールアドレスで登録する</a>
        </div>
        <div class="loading-wrapper">
          <div class="loading-animation">
            <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
          </div>
        </div>
      </div>
    </div>

  </div>


<div class="event-gallery">
  <h2>学生が主催する、学生のための「学ぶ」イベントを。</h2>
  <p>
    WAVEでは、学生が主催者となり参加者の目線でイベントを行います。
  </p>
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
  <h2>効率よくイベントを楽しもう。</h2>
  <ul>
    <li>
      <img src="/image/enquete.svg" alt="アンケート画像">
      <h3>アンケート入力</h3>
      <p>
        WAVEでは事前にアンケートを<br>
        取ることでイベント毎の<br>
        面倒くさいアンケートがなくなります。
      </p>
    </li>
    <li>
      <img src="/image/chat.svg" alt="チャット画像">
      <h3>イベントごとのチャット機能</h3>
      <p>
        イベント会場の人と<br>
        チャット内でいつでも議論ができます。
      </p>
      <p>
        他の参加者には見られたくない質問も<br>
        主催者だけに送ることもできます。
      </p>
    </li>
  </ul>
</div>

<footer id="footer">
    <small>&copy; MOREINVEST All Right Reserved.</small>
</footer>
@endsection

@section("javascript")
<script src="/js/lib/flickity.pkgd.min.js"></script>
<script src="/js/top.js"></script>
@endsection
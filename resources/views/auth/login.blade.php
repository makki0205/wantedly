@extends("layouts.app")

@section("title")
<title>ログイン | WAVE</title>
@endsection

@section("stylesheet")
<link rel="stylesheet" href="/css/login/login.css">
<script>
if(cookieShop.buy().WAVE_TOKEN) window.location.href = "/@"+cookieShop.buy().WAVE_NICKNAME
</script>
@endsection

@section('content')

<div class="main-container">

  <div class="left-content">
    <div class="view-message">
      <h1>
        やりたいことを、<br>
        <img src="/image/login/logo/wave_logo.png" alt="WAVE" class="logo-image">
        <span>でみつけよう。</span>
      </h1>
    </div>
  </div>

  <div class="right-content">
    <div class="login-form">
      <div class="form-content">
        <form action="{{ url('/api/login') }}" method="POST" id="form">
          <div class="mail-address">
            <input type="email" name="mail-address" id="mail-address" tabindex="1" placeholder="メールアドレス">
          </div>
          <div class="password">
            <input type="password" name="password" id="password" tabindex="2" placeholder="パスワード">
          </div>
          <div class="reset-password">
            <a href="{{ url('/reset') }}">パスワードをお忘れですか？</a>
          </div>
          <div class="button-container">
            <div class="sign-up-button">
              <a class="sign-up" tabindex="4" href="/register/">新規登録</a>
            </div>
            <div class="login-button">
              <input type="submit" value="ログイン" tabindex="3" class="input-login-button">
            </div>
          </div>
        </form>        
      </div>
    </div>
  </div>

</div>
<div class="main-container-cover"></div>
@endsection

@section("javascript")
<script src="/js/auth/login.js"></script>
@endsection


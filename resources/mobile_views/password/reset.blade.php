@extends("layouts.app")

@section("title")
<title>パスワードリセット | WAVE</title>
@endsection

@section("stylesheet")
<link rel="stylesheet" href="/css/password/sp-reset-password.css">
@endsection

@section("content")
<div class="main-container">
    
    <div class="send-email">
      <h1 class="title">パスワードのリセット</h1>
      <p class="send-email-content">
        入力されたメールアドレスに、<br>
        パスワードリセット用の<br>
        メールを送信いたします。<br>
        実際に受信できるメールアドレスを<br>
        入力してください。
      </p>
      <p class="attention">
        ※24時間以内にリセットされない場合、<br>
        パスワードリセット用メールに記載のURLは無効となります。
      </p>

      <div class="form-content" id="form">
        <form action="/api/reset/password" method="post">
          <div class="mail-address">
            <label for="mail-address">メールアドレス</label>
            <input type="text" name="email" id="mail-address">
          </div>

          
          <input id="send-button" class="send-button" type="submit" value="メールを送信する">
        </form>
      </div>
    </div>

    <div class="send-complete">
      <h1 class="title">パスワードリセット用メールの送信完了</h1>
      <p class="send-complete-content">
        パスワードリセット用メールの<br>
        送信が完了しました。<br>
        メールに記載されたURLより<br>
        手続きを完了してください。
      </p>
      <p class="attention">
        ※24時間以内にリセットされない場合、<br>
        パスワードリセット用メールに記載のURLは<br>
        無効となります。
      </p>
    </div>

</div>

<div class="spinner-cover">
  <div class="spinner">
    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
  </div>
</div>
@endsection

@section("javascript")
<script src="/js/reset/sp-reset-password.js"></script>
@endsection
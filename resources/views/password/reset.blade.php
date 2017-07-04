@extends("layouts.app")

@section("title")
<title>パスワードリセット | WAVE</title>
@endsection

@section("stylesheet")
<link rel="stylesheet" href="/css/password/reset-password.css">
@endsection

@section("content")
<div class="main-container">
    
    <div class="send-email">
      <h1 class="title">パスワードのリセット</h1>
      <p class="send-email-content">
        入力されたメールアドレスに、パスワードリセット用のメールを送信いたします。<br>
        実際に受信できるメールアドレスを入力してください。
      </p>
      <p class="attention">
        ※24時間以内にリセットされない場合、パスワードリセット用メールに記載のURLは無効となります。
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

</div>
@endsection

@section("javascript")
<script>
  
  (function($){

    $('#form').submit(function(event) {
      event.preventDefault();
      var email = $("#mail-address").val();
      $(".mail-address-error-message").remove();

      //サーバーに送信するかしないかのフラグ
          var sendServer = true;

      if(email == ""){
            makeAfterDiv('mail-address');
            appendList('mail-address','メールアドレスが空白です。');
            sendServer = false;
        }
          else {
            if(!email.match(/^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/)){
                makeAfterDiv('mail-address');
                appendList('mail-address','メールアドレスの形式ではありません。');
              sendServer = false;
            }
        }

      if(sendServer){
        $.ajax({
            url: "/api/reset/password",
            type: "post",
            data: {
              "email": email
            }
        })
        .done(function(response, textStatus, jqXHR){
          //メール送信に成功したら送信ボタンを無効化する
          $("#send-button").get(0).type = 'button';
          window.location.href = '/reset/complete';
        })
        .fail(function(jqXHR, textStatus, errorThrown){

          var errors = jqXHR.responseJSON.errors;

          if (errors) {
            makeAfterDiv('mail-address');
            for (errType in errors){
              if(errType.length > 0){
                errors[errType].map(function(err_item){
                  appendList('mail-address',err_item);
                })
              }
            }
          }
          
        })
      }
    });

    function makeAfterDiv(selector){
          $('.'+selector).after('<div class="'+selector+'-error-message"></div>');
      }

      function appendList(selector,value){
          $('.'+selector+'-error-message').append('<li>'+value+'</li>');
      }

  })(jQuery)

    
</script>
@endsection
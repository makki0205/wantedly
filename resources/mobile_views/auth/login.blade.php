@extends("layouts.app")

@section("title")
<title>ログイン | WAVE</title>
@endsection

@section("stylesheet")
<link rel="stylesheet" href="/css/login/sp-login.css">
@endsection

@section('content')

<div class="main-container">

  <div class="login-form">
    <div class="form-content">
      <form action="{{ url('/api/login') }}" method="POST" id="form">
        <div class="mail-address">
          <input type="email" name="mail-address" id="mail-address" tabindex="1" placeholder="メールアドレス">
        </div>
        <div class="reset-password">
          <a href="{{ url('/reset') }}">パスワードをお忘れですか？</a>
        </div>
        <div class="password">
          <input type="password" name="password" id="password" tabindex="2" placeholder="パスワード">
        </div>
        <div class="login-button">
          <input type="submit" value="ログイン" tabindex="3" class="input-login-button">
        </div>
      </form>
      <p>または</p>
      <div class="sign-up-button">
        <a class="sign-up" tabindex="4" href="/register/">新規登録の方はこちら</a>
      </div>
    </div>
  </div>

  <div class="main-container-cover"></div>
</div>

@endsection


@section("javascript")
<script>
  (function($){

    var images = [
      'polygon-1.jpg',
      'polygon-2.jpg',
      'polygon-3.jpg',
      'polygon-5.jpg',
      'polygon-6.jpg',
      'polygon-7.jpg',
      'polygon-8.jpg',
      'polygon-9.jpg',
      'polygon-11.jpg',
      'polygon-12.jpg'
    ];
    var randImg = images[Math.floor(Math.random() * images.length)];
    $('.main-container-cover').css('background-image', 'url(/image/login/cover-img/'+randImg+')');

    //ログイン処理を書く
    $('#form').submit(function(event) {
      event.preventDefault();
      $(".mail-address-error-message").remove();
      $(".password-error-message").remove();

      var email = $('#mail-address').val();
      var password = $('#password').val();

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
      
      if(password == ""){
        makeAfterDiv('password');
        appendList('password','パスワードが空白です。');
        sendServer = false;
      }
      


      if(sendServer){
        $.ajax({
            url: "/api/login",
            type: "post",
            data: {
              "email": email,
              "password": password
            }
        })
        .done(function(response, textStatus, jqXHR){
          var userData = {
          token: response.token,
          nickname: response.nickname,
          icon: null
        }

        cookieShop.sell(userData)

        var userId = response.nickname;
        window.location.href = '/@'+userId;
        })
        .fail(function(jqXHR, textStatus, errorThrown){

          var errors = jqXHR.responseJSON.errors;
          var message = jqXHR.responseJSON.message;

          if (errors) {
            makeAfterDiv('mail-address');
            makeAfterDiv('password');
            for (errType in errors){
              if(errType.length > 0){
                errors[errType].map(function(err_item){
                  switch(errType){
                    case 'email':
                      appendList('mail-address',err_item);
                      break;
                    case 'message':
                      appendList('mail-address',err_item);
                      break;
                    case 'password':
                      appendList('password',err_item);
                      break;
                  }
                });
              }
            }
          }

          if (message) {
            makeAfterDiv('mail-address');
            appendList('mail-address',message);
          }
          
        });
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


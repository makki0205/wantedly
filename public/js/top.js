(function($){

  var iconPath = "https://s3-us-west-2.amazonaws.com/wave-dev2/media/small_icon/"

  if(!cookieShop.buy().WAVE_TOKEN){
    $(".login-form").fadeIn(1000)
  }

  (function init(){
    var height = $(".form-content").outerHeight()
    $(".loading-wrapper").css("height",height)
  })()

  $('.gallery-ul').flickity({
    wrapAround: true,
    autoPlay: true,
    prevNextButtons: false
  });

  $('.login-button .input-login-button').on('click', function(){
    $(this).addClass("click");
  });
  $('.sign-up-button .sign-up').on('click', function(){
    $(this).addClass("click");
  });

  //ログイン処理を書く
  $('#form').submit(function(event) {
    event.preventDefault();

    $(".loading-wrapper").fadeIn()

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
      $(".loading-wrapper").fadeOut();
    }
    else {
      if(!email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)){
        makeAfterDiv('mail-address');
        appendList('mail-address','メールアドレスの形式ではありません。');
        sendServer = false;
        $(".loading-wrapper").fadeOut();
      }
    }
    
    if(password == ""){
      makeAfterDiv('password');
      appendList('password','パスワードが空白です。');
      sendServer = false;
      $(".loading-wrapper").fadeOut();
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
        if(response.code === 201){
          var userData = {
            nickname: response.nickname,
            token: response.token,
            icon: iconPath + response.icon
          }

          cookieShop.sell(userData)

          var nickname = response.nickname;
          window.location.href = '/@'+nickname;
        }
      })
      .fail(function(jqXHR, textStatus, errorThrown){
        $(".loading-wrapper").fadeOut();

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
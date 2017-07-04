(function($){

  var iconPath = "https://s3-us-west-2.amazonaws.com/wave-dev2/media/small_icon/"

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
  $('#form').submit(loginRequest);


  /**
   *  loginRequest
   *  ログインのリクエストをする
   *
   *  @params { object } event
   */
  function loginRequest(event){
    event.preventDefault();
    $(".mail-address-error-message").remove();
    $(".password-error-message").remove();

    var email = $('#mail-address').val();
    var password = $('#password').val();

    //サーバーに送信するかしないかのフラグ
    var canSendServer = true;

    if(email == ""){
      makeAfterDiv('mail-address');
      appendList('mail-address','メールアドレスが空白です。');
      canSendServer = false;
    }else {
      if(!email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)){
        makeAfterDiv('mail-address');
        appendList('mail-address','メールアドレスの形式ではありません。');
        canSendServer = false;
      }
    }

    if(password == ""){
      makeAfterDiv('password');
      appendList('password','パスワードが空白です。');
      canSendServer = false;
    }

    if(canSendServer){
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
            icon: iconPath+response.icon
          }

          cookieShop.sell(userData)

          var nickname = response.nickname;
          window.location.href = '/@'+nickname;
        }
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
  }

  function makeAfterDiv(selector){
    $('.'+selector).after('<div class="'+selector+'-error-message"></div>');
  }

  function appendList(selector,value){
    $('.'+selector+'-error-message').append('<li>'+value+'</li>');
  }

  })(jQuery)
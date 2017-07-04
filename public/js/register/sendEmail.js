(function($){

    $('#form').submit(function(event) {
        event.preventDefault();
        var email = $("#mail-address").val();
        $(".mail-address-error-message").remove();
        $('.spinner-cover').show();

        //サーバーに送信するかしないかのフラグ
        var sendServer = true;

        if(email == ""){
            $('.spinner-cover').hide();
            makeAfterDiv('mail-address');
            appendList('mail-address','メールアドレスが空白です。');
            sendServer = false;
        }
        else {
            if(!email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)){
                $('.spinner-cover').hide();
                makeAfterDiv('mail-address');
                appendList('mail-address','メールアドレスの形式ではありません。');
                sendServer = false;
            }
        }

        if(sendServer){
            $.ajax({
                url: "/api/prov",
                type: "post",
                data: {
                    "email": email
                }
            })
            .done(function(response, textStatus, jqXHR){
                //メール送信に成功したら送信ボタンを無効化する
                $("#send-button").get(0).type = 'button';
                $('.send-email').hide();
                $('.spinner-cover').hide();
                $('.js-mail-address').text(email);
                $('.send-complete').show();

            })
            .fail(function(jqXHR, textStatus, errorThrown){
                $('.spinner-cover').hide();

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
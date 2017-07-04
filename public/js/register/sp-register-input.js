(function($){
	var urlParamHash = location.pathname.replace("/register/","");
	var url = '/api/register/'+urlParamHash;

	$('#form').submit(function(event) {
		event.preventDefault();
		$(".user-name-error-message").remove();
		$(".user-id-error-message").remove();
		$(".password-error-message").remove();

		var display_name = $("#display-name").val();
		var nickname = $("#user-id").val();
		var password = $("#password").val();

		//サーバーに送信するかしないかのフラグ
		var sendServer = true;

		if(display_name == ""){
			makeAfterDiv('user-name');
			appendList('user-name','プロフィール名が空白です。');
			sendServer = false;
		}
		if(nickname == ""){
			makeAfterDiv('user-id');
			appendList('user-id','ユーザーIDが空白です。');
			sendServer = false;
		} 
		if(password == ""){
			makeAfterDiv('password');
			appendList('password','パスワードが空白です。');
			sendServer = false;
		}

		if(sendServer){
			$.ajax({
				url: url,
				type: "post",
				data: {
					"display_name": display_name,
					"nickname": nickname,
					"password": password
				}
			})
			.done(function(response, textStatus, jqXHR){
				window.location.href = '/login';
			})
			.fail(function(jqXHR, textStatus, errorThrown){

				var errors = jqXHR.responseJSON.errors;

				if (errors){
					$('.user-name').after('<div class="user-name-error-message"></div>');
					$('.user-id').after('<div class="user-id-error-message"></div>');
					$('.password').after('<div class="password-error-message"></div>');
					for (errType in errors){
						if(errType.length > 0){
							errors[errType].map(function(err_item){

								switch(errType){
									case 'display_name':
										$('.user-name-error-message').append('<li>'+err_item+'</li>');
										break;

									case 'nickname':
										$('.user-id-error-message').append('<li>'+err_item+'</li>');
										break;
								
									case 'password':
										$('.password-error-message').append('<li>'+err_item+'</li>');
										break;
									}
								});
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
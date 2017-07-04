@extends('layouts.app')


@section('stylesheet')
<link rel="stylesheet" href="/css/register/sp-registerInput.css">
@endsection

@section('content')

<div class="main-container">

	<div class="register-form">
		
		<h1 class="title">パスワードの変更</h1>
		<div class="form-content">
			<form action="/api/reset/password/" method="POST" id="form">
				<div class="password input">
					<label for="password">新しいパスワード</label>
					<input type="password" name="password" id="password">
				</div>
				
				<button type="submit" class="send-button">パスワードを変更する</button>
			</form>
		</div>

	</div>

</div>

@endsection


@section('javascript')
<script>
	(function($){
		var urlParamHash = location.pathname.replace("/reset/password/","");
		var url = '/api/reset/password/'+urlParamHash;

		$('#form').submit(function(event) {
			event.preventDefault();
			$(".password-error-message").remove();

			var password = $("#password").val();

			//サーバーに送信するかしないかのフラグ
      		var sendServer = true;

	      	if(password == ""){
		        makeAfterDiv('password');
		        appendList('password','パスワードが空白です。');
	        	sendServer = false;
	      	}

      		if(sendServer){
				$.ajax({
				    url: url,
				    type: "POST",
				    data: {
				    	"password": password
				    }
				})
				.done(function(response, textStatus, jqXHR){
					window.location.href = '/';
				})
				.fail(function(jqXHR, textStatus, errorThrown){

					var errors = jqXHR.responseJSON.errors;

					if (errors){
						makeAfterDiv('password');
						for (errType in errors){
							if(errType.length > 0){
								errors[errType].map(function(err_item){
									appendList('password',err_item);
									
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
</script>
@endsection
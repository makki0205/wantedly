(function($){

	$("#header .icon").on("click",function(){
		if($(".menu").hasClass("active")){
			$(".menu").hide().removeClass("active")
		}else{
			$(".menu").show().addClass("active")
		}
	});

	$(".menu-logout").on("click",logout)

	function logout(){
		cookieShop.disposal()
		window.location.href = "/"
		return false
	}

})(jQuery);
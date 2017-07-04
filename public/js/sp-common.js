(function($){

	// event listener
	$(".menu-button").on("touchend",onClickMenuButton)

	// event functions
	function onClickMenuButton(){
		if($(this).hasClass("opened")){
			TweenMax.to(".menu-list",0.5,{top: "-100vh",ease: Circ.easeInOut})
			TweenMax.to(".menu-state",0.5,{rotation: 0,ease: Circ.easeInOut})
			$(this).removeClass("opened");
		}else{
			TweenMax.to(".menu-list",0.5,{top: "7vh",ease: Circ.easeInOut})
			TweenMax.to(".menu-state",0.5,{rotation: 180,ease: Circ.easeInOut})
			$(this).addClass("opened");
		}
	}

	$(".menu-logout").on("touchend",logout)

	function logout(){
		cookieShop.disposal()
		window.location.href = "/"
		return false
	}


})(jQuery)
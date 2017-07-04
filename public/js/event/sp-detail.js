(function($){

	var vm = initVue()
	initFirebase()
	firebaseRead()
	fetchEventDetail()

	// chat messageを送る
	$(".send-button button").on("touchend",sendChatMessage)

	// chatのviewを開く
	$(".chat-join").on("touchend",showChatView)

	// chatのviewを閉じる
	$(".close-button").on("touchend",closeChatView)

	/**
	 *	showChatView
	 *	チャット画面をだす
	 */
	function showChatView(){
		TweenMax.to(".chat-box",0.8,{top: "7vh",ease: Expo.easeInOut})
	}

	/**
	 *	closeChatView
	 *	チャット画面をだす
	 */
	function closeChatView(){
		TweenMax.to(".chat-box",0.8,{top: "100vh",ease: Expo.easeInOut})
	}

	/**
	 *	sendChatMessage
	 *	チャットを送信する
	 */
	function sendChatMessage(){
		var user_name = "konojunya"
		var text = $(".send-input input").val()
		$(".send-input input").val("")
		$(".send-input input").focus()
		text = text.trim()
		if(text != ""){
			firebasePost(user_name,text)
		}
	}

	/**
	 *	firebasePost
	 *	firebaseにポストする
	 */
	function firebasePost(user_name,post_text){
		var newPostKey = firebase.database().ref().child("message").push().key;

		var postData = {
			text: post_text,
			user_name: user_name,
			timestamp: Date.now()
		}

		var update = {}
		update["/message/"+newPostKey] = postData
		firebase.database().ref().update(update)
	}

	/*
	 *	firebaseRead
	 *	firebaseからデータを取得する
	 */
	function firebaseRead(){
		var chatRef = firebase.database().ref('message/');
		chatRef.on('child_added', function(data) {
			var viewData = {
				user_name: data.val().user_name,
				text: data.val().text
			}
			eventDetailUtil.saveChatData(viewData)
			chatViewRender()
		});
	}

	/**
	 *	chatViewRender
	 *	chatの画面を更新する
	 */
	function chatViewRender(){
		console.log($(".message").scrollTop())
		setTimeout(function(){
			$(".message").scrollTop($('.message').get(0).scrollHeight)
		},0)
		Vue.nextTick(function(){
			vm.chatData = eventDetailUtil.getChatData()
		})
	}

	/**
	 *	fetchEventDetail
	 *	イベント詳細を取得
	 */
	function fetchEventDetail(){
		var event_id = 1

		$.ajax({
			url: "/api/events/"+event_id,
			type: "GET"
		})
		.done(function(data){
			doStartAnimation()
			setEventDetailData(data.event)
		})

	}

	/**
	 *	initVue
	 *	Vue.jsの初期化
	 *
	 *	@return { object } vm
	 */
	function initVue(){
		var vm = new Vue({
			el: "#main",
			data: {
				eventDetail: eventDetailUtil.getEventDetailData(),
				chatData: []
			}
		})

		return vm
	}

	function initFirebase(){
		var config = {
	    apiKey: "AIzaSyDz7G_PZC3FT-rIRZGP2vwI6hJnHFZfabI",
	    authDomain: "wave-chat.firebaseapp.com",
	    databaseURL: "https://wave-chat.firebaseio.com",
	    storageBucket: "wave-chat.appspot.com",
	    messagingSenderId: "689418637783"
	  };
	  firebase.initializeApp(config);
	}

	/**
	 *	setEventDetailData
	 *	Ajaxで取得してきたデータをもとにViewへ適応する
	 *
	 *	@params	{ object } detail
	 */
	function setEventDetailData(detail){
 		Vue.nextTick(function(){
			vm.eventDetail = detail
		})
	}

	/**
	 *	doStartAnimation
	 *	スタートのアニメーションを実行
	 */
	function doStartAnimation(){
		TweenMax.to(".loading .img",0.5,{scale: 3,ease: Back.easeInOut})
		TweenMax.to(".loading",0.7,{autoAlpha: 0,ease: Expo.easeInOut})
		setTimeout(function(){
			$(".loading").remove()
		},1000)
	}

})(jQuery)
(function($){

	var vm = initVue()
	fetchUserDetail()

	var iconPath = "https://s3-us-west-2.amazonaws.com/wave-dev2/media/small_icon/"
	var coverPath = "https://s3-us-west-2.amazonaws.com/wave-dev2/media/cover/"

	var MODE = "view"

	// モードを編集モードにする
	$(".edit-button").on("touchend",changeMode)

	// 変更を保存する
	$(".save-button").on("touchend",saveSetting)

	// iconをアップロードする
	$(".icon-img").on("touchend",uploadIcon)

	// coverをアップロードする
	$(".file-cover-input").on("touchend",uploadCoverImage)


	/**
	 *	uploadIcon
	 *	アイコンをアップロード
	 */
	function uploadIcon(){
		var file_element = document.querySelector(".file-icon-input")
		if(MODE == "edit"){
			file_element.onchange = function(){
				if(file_element.value){
					$(".image-upload-process").fadeIn()
					var formData = new FormData()
					formData.append("image",file_element.files[0])
					formData.append("user_id",userDetailUtil.getUserId())
					$.ajax({
						url: "/api/users/icon?token="+cookieShop.buy().WAVE_TOKEN,
						type: "POST",
						dataType: "json",
						data: formData,
						processData: false,
						contentType: false
					})
					.done(function(res){
						var userData = userDetailUtil.getUserDetailData()
						var icon_path = iconPath+res.path
						userData.icon = icon_path
						$(".icon-img img").attr("src",icon_path+"?"+Math.floor(Math.random()*Date.now()))
						userDetailUtil.saveUserSetting(userData)
						setUserDetailData(userData)
					})
					.always(function(){
						$(".image-upload-process").fadeOut()
					})
				}
			}
		}
	}

	/**
	 *	uploadCoverImage
	 *	カバーをアップロード
	 */
	function uploadCoverImage(){
		var file_element = document.querySelector(".file-cover-input")
		if(MODE == "edit"){
			file_element.onchange = function(){
				if(file_element.value){
					$(".image-upload-process").fadeIn()
					var formData = new FormData()
					formData.append("image",file_element.files[0])
					formData.append("user_id",userDetailUtil.getUserId())
					$.ajax({
						url: "/api/users/cover_image?token="+cookieShop.buy().WAVE_TOKEN,
						type: "POST",
						dataType: "json",
						data: formData,
						processData: false,
						contentType: false
					})
					.done(function(res){
						var userData = userDetailUtil.getUserDetailData()
						var imagePath = coverPath+res.path
						$(".cover-img-container").css("background-image","url("+imagePath+"?"+Math.floor(Math.random()*Date.now())+")")
						userData.cover_image = imagePath
						userDetailUtil.saveUserSetting(userData)
						setUserDetailData(userData)
					})
					.always(function(){
						$(".image-upload-process").fadeOut()
					})
				}
			}
		}
	}

	/**
	 *	changeMode
	 *	モードを変える
	 */
	function changeMode(){
		MODE = "edit"
		$(".viewMode").hide()
		$(".editMode").removeClass("_hidden")
		// featchTopicAndAspiringIndustryList()
	}

	/**
	 *	saveSetting
	 *	設定を保存する
	 */
	function saveSetting(){
		MODE = "view"
		$(".viewMode").show()
		$(".editMode").addClass("_hidden")
		var userData = userDetailUtil.getUserDetailData()
		userData.display_name = $(".userInput-displayName").val()
		var region_id = $(".userInput-region").val()
		userData.address.id = region_id

		var regions = userDetailUtil.getRegionData()
		regions.map(function(item){
			if(item.id == region_id){
				userData.address.region = item.region
			}
		})

		userData.description = $(".userInput-description").val()
		userData.introduction = $(".userInput-introduction").val()

		userDetailUtil.saveUserSetting(userData)
		setUserDetailData(userData)
		saveUserDetailData()
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
				userDetail: userDetailUtil.getUserDetailData(),
				regions: []
			}
		})

		return vm
	}

	/**
	 *	setRegion
	 *	regionデータをもとにHTMLのoptionを生成
	 *
	 *	@params { object } user_region
	 */
	function setRegion(user_region){
		$.getJSON("/store/region.json",function(json){
			var userData = []
			json.map(function(item){
				if(item.id == user_region.id){
					item["selected"] = true
				}else{
					item["selected"] = false
				}
				userData.push(item)
			})

			userDetailUtil.setRegionData(userData)
			Vue.nextTick(function(){
				vm.regions = userData
			})
		})
	}

	/**
	 *	featchUserDetail
	 *	Ajaxでuser Detailを取得しに行く
	 */
	function fetchUserDetail(){

		var nickname = window.location.pathname.replace(/^\/@/,"")

		$.ajax({
			url: "/api/users/"+nickname+"/detail",
			type: "GET"
		})
		.done(function(data){
			doStartAnimation()
			
			data.user_detail.icon = iconPath+data.user_detail.icon
			data.user_detail.cover_image = coverPath+data.user_detail.cover_image

			setRegion(data.user_detail.address)
			userDetailUtil.saveUserId(data.user_id)
			userDetailUtil.saveUserSetting(data.user_detail)
			setUserDetailData(data.user_detail)
		})
	}

	/**
	 *	featchTopicAndAspiringIndustryList
	 *	関心と志望業界のリストを取得
	 */
	function featchTopicAndAspiringIndustryList(){
		$.ajax({
			url: "/api/topicandaspiringIndustry",
			type: "GET"
		})
		.done(function(data){
			console.log(data)
		})
	}

	/**
	 *	setUserDetailData
	 *	Ajaxで取得してきたデータをもとにViewへ適応する
	 *
	 *	@params	{ object } detail
	 */
	function setUserDetailData(detail){
		var sex = detail.sex == 0 ? "sex-man" : "sex-woman";
		$(".wave-score").addClass(sex)
 		Vue.nextTick(function(){
			vm.userDetail = detail
		})
	}

	/**
	 *	saveUserDetailData
	 *	変更されたユーザーディテールの状態を保存する
	 */
	function saveUserDetailData(){
		var userData = userDetailUtil.getUserDetailData()
		var reqData = {
			user_id: userDetailUtil.getUserId(),
			user_detail: userData
		}

		$.ajax({
			url: "/api/users/detail",
			type: "PUT",
			data: reqData
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
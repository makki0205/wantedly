(function($){

	var vm = initVue()
	fetchUserDetail()

	var iconPath = "https://s3-us-west-2.amazonaws.com/wave-dev2/media/small_icon/"
	var coverPath = "https://s3-us-west-2.amazonaws.com/wave-dev2/media/cover/"

	var MODE = "view"

	// モードを編集モードにする
	$(".edit-button").on("click",changeMode)

	// 変更を保存する
	$(".save-button").on("click",saveSetting)

	// iconをアップロードする
	$(".icon-select-filter").on("click",uploadIcon)

	// coverをアップロードする
	$(".cover-select-filter").on("click",uploadCoverImage)


	/**
	 *	uploadIcon
	 *	アイコンをアップロード
	 */
	function uploadIcon(){
		$(".file-icon-input").click()
		var file_element = document.querySelector(".file-icon-input")
		if(MODE == "edit"){
			file_element.onchange = function(){
				if(file_element.value){
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

						cookieShop.sell({
							icon: icon_path
						})

						userData.icon = icon_path
						userDetailUtil.saveUserSetting(userData)
						setUserDetailData(userData)
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
		$(".file-cover-input").click()
		var file_element = document.querySelector(".file-cover-input")
		if(MODE == "edit"){
			file_element.onchange = function(){
				if(file_element.value){
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
						userData.cover_image = coverPath+res.path
						userDetailUtil.saveUserSetting(userData)
						setUserDetailData(userData)
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
		featchTopicAndAspiringIndustryList()
	}

	/**
	 *	saveSetting
	 *	設定を保存する
	 */
	function saveSetting(){
		MODE = "view"
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

		window.location.reload()
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
				regions: [],
				aspiringIndustry: [],
				topic: []
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
	 *	fetchUserDetail
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

			// twitter と facebookを認証しているか
			if(data.user_detail.twitter == "") $(".sns .twitter").addClass("disconnect")
			if(data.user_detail.facebook == "") $(".sns .facebook").addClass("disconnect")

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
			setTopicAndAspiringIndustryList(data.aspiringIndustry,data.topic)
		})
	}

	/**
	 *	setTopicAndAspiringIndustryList
	 *	気になるモノと気になる業界の一覧をセット
	 *
	 *	@params { array } aspiringIndustryArray
	 *	@params { array } topicArray
	 */
	function setTopicAndAspiringIndustryList(aspiringIndustryArray,topicArray){
		Vue.nextTick(function(){
			vm.aspiringIndustry = aspiringIndustryArray
			vm.topic = topicArray
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
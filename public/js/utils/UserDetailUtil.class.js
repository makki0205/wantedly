function UserDetailUtil(){
	this._data = {
		address: {},
		aspiring_industries: [],
		award: [],
		career_history: [],
		cover_image: "",
		description: "",
		display_name: "",
		facebook: "",
		graduate: "",
		icon: "",
		introduction: "",
		nickname: "",
		number_build: "",
		number_participate: "",
		school_name: "",
		sex: "",
		topic: [],
		twitter: "",
		undergraduate: "",
		wave_point: ""
	}
	this._user_id = null

	this._regionData = []
}

/**
 *	getUserDetailData
 *	ユーザーディテールのフォーマットを返す
 */
UserDetailUtil.prototype.getUserDetailData = function(){
	return this._data
}

/**
 *	getUserId
 *	ユーザーのIDを返す
 */
UserDetailUtil.prototype.getUserId = function(){
	return this._user_id
}

/**
 *	getRegionData
 *	regionデータを返す
 */
UserDetailUtil.prototype.getRegionData = function(){
	return this._regionData
}

/**
 *	setRegionData
 *	regionの情報を保存する
 *
 *	@params { array } array
 */
UserDetailUtil.prototype.setRegionData = function(array){
	this._regionData = array
}

/**
 *	saveUserSetting
 *	ユーザーの変更点を保存する
 *
 *	@params { object } obj
 */
UserDetailUtil.prototype.saveUserSetting = function(obj){
	this._data = obj
}

/**
 *	saveUserId
 *	ユーザーのIDを保存する
 *
 *	@params { number } num
 */
UserDetailUtil.prototype.saveUserId = function(num){
	this._user_id = num
}

window.userDetailUtil = new UserDetailUtil()
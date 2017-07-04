function EventDetailUtil(){
	this._data = {
		catch_image: "",
		content: "",
		created_at: "",
		day: "",
		genre: "",
		id: "",
		place: "",
		tag: "",
		title: "",
		updated_at: ""
	}
	this._user_id = null

	this._chat = []
}

/**
 *	getChatData
 *	チャットのデータを返す
 */
EventDetailUtil.prototype.getChatData = function(){
	return this._chat
}

/**
 *	getEventDetailData
 *	イベントディテールのフォーマットを返す
 */
EventDetailUtil.prototype.getEventDetailData = function(){
	return this._data
}

/**
 *	getUserId
 *	ユーザーのIDを返す
 */
EventDetailUtil.prototype.getUserId = function(){
	return this._user_id
}

/**
 *	saveChatData
 *	chatのデータを保存する
 *
 *	@params { obj } obj
 */
EventDetailUtil.prototype.saveChatData = function(obj){
	if(obj.user_name == "konojunya"){
		this._chat.push({
			user_name: obj.user_name,
			text: obj.text,
			type: "me"
		})
	}else{
		this._chat.push({
			user_name: obj.user_name,
			text: obj.text,
			type: "you"
		})
	}
}

/**
 *	saveUserId
 *	ユーザーのIDを保存する
 *
 *	@params { number } num
 */
EventDetailUtil.prototype.saveUserId = function(num){
	this._user_id = num
}

window.eventDetailUtil = new EventDetailUtil()
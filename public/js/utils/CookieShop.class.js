function CookieShop(){
	this.cookie = []
	this.cookieNames = {
		token: "WAVE_TOKEN",
		nickname: "WAVE_NICKNAME",
		icon: "WAVE_ICON"
	}
}

/**
 *	_shelfPut
 *	棚入れ
 *
 *	お店のクッキーを棚入れする
 */
CookieShop.prototype._shelfPut = function(){
	this.cookie.map(function(cookie){
		document.cookie = cookie
	})
}

/**
 *	_stocktaking
 *	棚卸し
 *
 *	棚卸しをする
 *
 *	@return { string } cookie - クッキー
 */
CookieShop.prototype._stocktaking = function(){
	return document.cookie
}

/**
 *	_bake
 *	焼く
 *
 *	伝票をもとにクッキーの形に焼く
 *
 *	@params { object } slip - 伝票
 *	@return { array } cookie - クッキー
 */
CookieShop.prototype._bake = function(slip){
	var cookies = []

	for(var i in slip){
		if(slip[i] !== null && i !== "expiration_date"){
			cookies.push(this.cookieNames[i]+"="+encodeURIComponent(slip[i])+";max-age="+slip.expiration_date)
		}
	}

	return cookies
}

/**
 *	sell
 *	売却
 *
 *	店員に賞味期限を設定してもらうのと、生のクッキーを材料として渡して焼いてクッキーにする
 *
 *	@params { object } cookie_dough - クッキーの生地
 */
CookieShop.prototype.sell = function(cookie_dough){
	var
		clerk = {},
		expire = new Date();

	for(var i in cookie_dough){
		clerk[i] = cookie_dough[i]
	}
	clerk["expiration_date"] = expire.getTime() + 1000 * 3600 * 24 * 31 * 3

	this.cookie = this._bake(clerk)
	this._shelfPut()
}

/**
 *	buy
 *	購入
 *
 *	WAVEのもっているクッキーを全て購入する
 *
 *	@return { object } cookies - クッキー
 */
CookieShop.prototype.buy = function(){
	var cookies = new Object();

  var allcookies = this._stocktaking();
  if(allcookies != ''){
  	var cookie_array = allcookies.split(';');
    for(var i = 0; i < cookie_array.length; i++){
    	var cookie = cookie_array[i].split('=');
    	cookies[cookie[0].trim()] = decodeURIComponent(cookie[1]);
    }
  }
  return cookies
}

/**
 *	disposal
 *	廃棄
 *
 *	店員が過去の時間を指定して、クッキーを廃棄にする
 */
CookieShop.prototype.disposal = function(){
	var
		clerk = {},
		disposalFormat = this.cookieNames

	for(var i in disposalFormat){
		clerk[i] = disposalFormat[i]
	}
	clerk["expiration_date"] = -1

	this.cookie = this._bake(clerk)
	this._shelfPut()
}

window.cookieShop = new CookieShop()
<?php

use Illuminate\Http\Request;


//
// 非認証API
//

/**
 * [GET] /eventsData/:event_id/participants
 * idをもとに指定イベントの参加者一覧、主催者を含むデータを取得
 * @pram { int } event_id イベントID
 * @return { json } eventParticipantsList
 */
Route::get('/eventsData/{event_id}/participants', 'EventController@getParticipantsList');

/**
 * [GET] /events/:id/entries/:entry_id
 * 指定IDイベントの指定参加枠の参加者一覧を取得
 * @param { int } id イベントID
 * @param { int } entry_id 参加枠ID
 * @return { json } participants 参加者一覧
 */
Route::get('/events/{id}/entries/{entry_id}', 'EventController@getParticipants');

/**
 * [GET] /user/{user_id}/detail
 * ユーザ詳細情報の取得
 * @param {nickname} nickname ユーザのニックネームで取ってくる
 * @return { json } UserDetail ユーザ詳細情報
 */
Route::get('/users/{nickname}/detail', 'UserDetailController@getUserDetail');

/**
 * [post] /topicandaspiringIndustry
 * 関心トピックと志望業界を返す
 * @return { json }　関心トピックと志望業界
 */
Route::get('/topicandaspiringIndustry', 'UserDetailController@getTopicAndAspiringIndustry');

/**
 * [POST] /prov
 * 仮登録メール送信
 * @param { string } mail 仮登録メールアドレス
 * @return { json } status 成功か失敗か
 */
Route::post('/prov', 'Auth\ProvRegisterController@provMail');

/**
 * [POST] /register
 * 本登録API
 * @param { string } hash
 * @param { string } name
 * @param { string } password
 * @return { json } status
 */
Route::post('/register/{hash}', 'Auth\RegisterController@register');

/**
 * [POST] /login
 * ログインAPI
 * @param { string } email
 * @param { string } password
 * @return { json } status
 */
Route::post('/login', 'Auth\LoginController@login');

/**
 * [POST] /reset/password
 * メール送信API
 * @param { string } email
 * @return { json } status
 */
Route::post('/reset/password', 'Auth\ResetPasswordController@sendEmail');

/**
 * [POST] /reset/password/{token}
 * パスワードリセットAPI
 * @param { string } hash
 * @param { string } password
 * @return { json } status
 */
Route::post('/reset/password/{token}', 'Auth\ResetPasswordController@resetPassword');


//
// 要認証API
//

Route::group(['middleware' => 'jwt.auth'], function () {

    /**
     * [GET] /register/events
     * ログインユーザの参加登録しているイベントを取得する
     * @return { json } events イベント一覧
     */
    Route::get('/register/events', 'EventController@getRegisterEvents');
  
    /**
     * [GET] /organizer/events
     * ログインユーザの主催イベントを取得
     * @return { json } events イベント一覧
     */
    Route::get('/organizer/events', 'EventController@getOrganizerEvents');
  
    /**
     * [GET] /eventsData/:id
     * idを元に指定イベントのデータ全て取得
     * @param { int } event_id イベントID
     * @return { json } eventData イベントデータ全て
     */
    Route::get('/eventsData/{event_id}', 'EventController@getEventData');

    /**
     * [POST] /events/:id/entries/:entry_id
     * 指定IDイベントの指定参加枠に参加者を追加
     * @param { int } id イベントID
     * @param { int } entry_id 参加枠ID
     * @return { json } participant 参加者情報
     */
    Route::post('/events/{id}/entries/{entry_id}', 'EventController@storeParticipant');

    /**
     * [DELETE] /events/:id/entries/:entry_id/:participant_id
     * @param { int } id イベントID
     * @param { int } entry_id 参加枠ID
     * @param { int } participant_id 参加者ID
     * @return { json } status 成功か失敗か
     */
    Route::delete('/events/{id}/entries/{entry_id}/participants/{participant_id}', 'EventController@deleteParticipant');

    /**
     * [PUT] /user/detail
     * UserDetailの変更
     * @param {int} user_id ユーザのID
     * @param { json } UserDetail ユーザ詳細情報
     */
    Route::put('/users/detail', 'UserDetailController@putUserDetail');


    /**
     * [POST] /users/icon
     * iconの変更
     * @param {int} user_id ユーザのID
     * @param { file } アイコン画像
     */
    Route::post('/users/icon', 'UserDetailController@updateIcon');

    /**
     * [POST] /users/cover_image
     * cover_imageの変更
     * @param {int} user_id ユーザのID
     * @param { file } Cover画像
     */
    Route::post('/users/cover_image', 'UserDetailController@updateCoverImage');

});
//
//
///**
// * [GET] /events
// * Event一覧取得
// * @return { json } events イベント一覧
// */
//Route::get('/events', 'EventController@getEvents');
//
///**
// * [GET] /events/:id
// * idを元に個別イベント取得
// * @param { int } id イベントID
// * @return { json } event イベント情報
// */
//Route::get('/events/{id}', 'EventController@getEvent');
//
//
///**
// * [POST] /events
// * イベントを追加
// * @param { json } event イベント情報
// * @return { json } event イベント情報
// */
//Route::post('/events', 'EventController@storeEvent');
//
///**
// * [PATCH] /events/:id
// * 指定IDのイベントを変更
// * @param { json } event イベント情報
// * @return { json } event イベント情報
// */
//Route::patch('/events/{id}', 'EventController@updateEvent');
//
///**
// * [DELETE] /events/:id
// * イベントを追加
// * @return { json } status　成功か失敗か
// */
//Route::delete('/events/{id}', 'EventController@deleteEvent');
//
///**
// * [GET] /events/:id/organizers
// * 指定IDのイベントの主催者情報を取得
// * @param { int } id イベントID
// * @return { json } organizer 主催者一覧
// */
//Route::get('/events/{id}/organizers', 'EventController@getOrganizers');
//
///**
// * [GET] /events/:id/entries
// * 指定IDのイベントの参加枠一覧を取得
// * @param { int } id イベントID
// * @return { json } entries 参加枠一覧
// */
//Route::get('/events/{id}/entries', 'EventController@getEntries');
//
///**
// * [POST] /events/:id/entries
// * 指定IDのイベントに参加枠を追加
// * @param { int } id イベントID
// * @return { json } entries 参加枠一覧
// */
//Route::post('/events/{id}/entries', 'EventController@storeEntry');
//
///**
// * [PATCH] /events/:id/entries/:entry_id
// * 指定IDイベントの指定参加枠を変更
// * @param { int } id イベントID
// * @param { int } entry_id 参加枠ID
// * @return { json } entry 参加枠情報
// */
//Route::patch('/events/{id}/entries/{entry_id}', 'EventController@updateEntry');
//
///**
// * [DELETE] /events/:id/entries/:entry_id
// * 指定IDイベントの指定参加枠を削除
// * @param { int } id イベントID
// * @param { int } entry_id 参加枠ID
// * @return { json } status 成功か失敗か
// */
//Route::delete('/events/{id}/entries/{entry_id}', 'EventController@deleteEntry');
//
///**
// * [PATCH] /events/:id/entries/:entry_id/participants/:participant_id
// * @param { int } id イベントID
// * @param { int } entry_id 参加枠ID
// * @param { int } participant_id 参加者ID
// * @return { json } status 成功か失敗か
// */
//Route::patch('events/{id}/entries/{entry_id}/participants/{participant_id}', 'EventController@updateEvaluate');
//
//// ------- Genre -------------
//
///**
// * [GET] /genre
// * ジャンルを取得
// * @return { json } genre　ジャンルの一覧を返す
// */
//Route::get('/genre', 'GenreController@getGenres');
//
//// ------- Tag -------------
//
///**
// * [post] /tag
// * タグを取得
// * @param { string } Prefix 文字の先頭
// * @param { int } number　必要個数
// * @return { json } genre　タグの一覧を返す
// */
//Route::post('/tag', 'TagController@getTags');
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('top');
});

Route::get('/login', function (Request $request) {
    return view('auth/login');
});

Route::get('/@{nickname}',['middleware' => 'userDetailmiddleware', function () {
    return view('user/detail');
}]);


Route::get('/event/{event_id}', ['middleware' => 'eventDetail', function () {
    return view('event/detail');
}]);

Route::get("/help",function(){
    return view("help");
});


// register
Route::get('/register',function(){
    return view("register/sendEmail");
});

Route::get("/register/{hash}", ['middleware' => 'prevMailAccess', function () {
    return view("register/registerInput");
}]);

Route::get('/reset',function(){
    return view("password/reset");
});

Route::get('/reset/complete',function(){
    return view("password/sendComplete");
});

Route::get('/reset/password/{hash}',['middleware' => 'resetPsswordMailAccess',function(){
    return view("password/resetInput");
}]);


// social

//twitter
Route::get('/auth/login/twitter', 'Auth\SocialController@getTwitterAuth');
Route::get('/auth/login/callback/twitter', 'Auth\SocialController@getTwitterAuthCallback');

//facebook
Route::get('/auth/login/facebook', 'Auth\SocialController@getFacebookAuth');
Route::get('/auth/login/callback/facebook', 'Auth\SocialController@getFacebookAuthCallback');


//  pre-register

Route::get('/pre-register', function() {
    return view("pre-register/register");
});

Route::post('/pre-register/complete', function (Request $request){
    if ($request->has('email')) {
        \App\PreRegister::firstOrCreate(['email' => $request->input('email')]);
    }
    return view("pre-register/complete");
});
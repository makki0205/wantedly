<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers, \App\Http\Json\AuthJson;

    protected $redirectTo = '/user';
    // AuthService登録
    private $auth = null;
    public function __construct(\App\Service\AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $token = $this->auth->login($credentials);
        if ($token) {
            $user = $this->auth->getUser($token);
            $nickname = $user->detail()->value('nickname');
            $icon = $user->detail()->value('icon');
            return response()->json($this->successLogin($token, $nickname, $icon), 200);
        }
        $msg = '資格情報が一致しません。';
        return response()->json($this->failureLogin($msg), 400);
    }
}

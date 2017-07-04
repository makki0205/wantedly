<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, \App\Http\Json\AuthJson;

    protected $redirectTo = '/user';
    // AuthService登録
    private $auth = null;
    public function __construct(\App\Service\AuthService $auth)
    {
        $this->auth = $auth;
    }

    /**
     * [POST] /register
     * 本登録API
     * @param { string } hash
     * @param { string } name
     * @param { string } password
     * @return { json } status
     */
    public function register(RegisterRequest $request, $hash)
    {
        return $this->handleError(function () use ($request, $hash) {
            $credentials = $request->only(['nickname', 'password', 'display_name']);
            $credentials['email'] = $this->auth->getRegisterMail($hash);
            if (!$credentials['email']) {
                $msg = '不正なアクセスです。';
                // 登録失敗
                return response()->json($this->failureRegisterd($msg), 400);
            }

            $user = $this->create($credentials);
            $token = $this->auth->login(["email" => $user->email, "password" => $credentials['password'] ]);
            $nickname = $user->detail()->value('nickname');
            $icon = $user->detail()->value('icon');
            
            // 登録成功
            return response()->json($this->successLogin($token, $nickname, $icon), 200);
        });
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //user登録処理
        $user = $this->auth->registerUser($data['email'], $data['password']);

        //userdetail登録処理
        $nickname = $this->auth->registerUserDetail($user, $data['nickname'], $data['display_name']);

        //socaialtoken登録処理
        $this->auth->registerSocialToken($user);

        //仮登録メール情報削除
        $this->auth->deletePrevMail($data['email']);

        $this->guard()->login($user);

        return $user;
    }
}

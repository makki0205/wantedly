<?php
/**
 * Created by PhpStorm.
 * User: nappannda
 * Date: 2017/02/11
 * Time: 22:59
 */

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Socialite;
use App\Service\AuthService;

class SocialController extends Controller
{

    private $auth = null;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function getTwitterAuth()
    {
        if (!$this->auth->getLoginUser()) {
            return view('top');
        }
        return Socialite::driver('twitter')->redirect();
    }

    public function getTwitterAuthCallback() {
        $user = $this->auth->getLoginUser();
        if (!$user) {
            return view('top');
        }

        try {
            $tuser = Socialite::driver('twitter')->user();
        } catch (\Exception $e) {
            return redirect("/");
        }
        if ($tuser) {
            $user_detail = $user->detail;
            if ($user_detail->twitter === '') {
                $user_detail->twitter = 'https://twitter.com/'.$tuser->nickname;
                $user_detail->save();

                $social_token = $user->socialToken;
                $social_token->twitter_token = $tuser->token;
                $social_token->save();

                // 詳細ページにリダイレクト
                return view('user/detail');
            } else {
                // TODO 以前に登録されていることを通知?
                return view('user/detail');
            }
        } else {
            // facebook認証失敗　トップページに戻す
            return view('top');
        }
    }

    public function getFacebookAuth() {
        if (!$this->auth->getLoginUser()) {
            return view('top');
        }
        return Socialite::driver('facebook')->redirect();
    }

    public function getFacebookAuthCallback() {
        $user = $this->auth->getLoginUser();
        if (!$user) {
            return view('top');
        }

        try {
            $fuser = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            return redirect("/");
        }
        if ($fuser) {
            $user_detail = $user->detail;
            if ($user_detail->facebook === '') {
                $user_detail->facebook = $fuser->profileUrl;
                $user_detail->save();

                $social_token = $user->socialToken;
                $social_token->facebook_token = $fuser->token;
                $social_token->save();

                // 詳細ページにリダイレクト
                return view('user/detail');
            } else {
                // TODO 以前に登録されていることを通知?
                return view('user/detail');
            }
        } else {
            // facebook認証失敗　トップページに戻す
            return view('top');
        }
    }

}
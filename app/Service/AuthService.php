<?php
namespace App\Service;

use JWTAuth;
use Carbon\Carbon;
use App\ProvRegisterMail;
use App\User;
use App\UserDetail;
use App\SocialToken;
use App\PasswordReset;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthService
{
    use AuthenticatesUsers;

    public function getLoginUser()
    {
        return JWTAuth::parseToken()->Authenticate();
    }

    public function getUser($token)
    {
        return JWTAuth::toUser($token);
    }


    //登録変更用
    public function login($credentials)
    {
        if ($token = JWTAuth::attempt($credentials)) {
            return $token;
        }
        return false;
    }

    public function checkMail($target_mail)

    {
        $model = ProvRegisterMail::where('email', $target_mail)->first();
        if ($model) {
            //仮登録された時間が24時間以内か
            if (Carbon::now()->diffInHours($model->created_at) <= 24) {
                return false;
            }
            $model->delete();
            return true;
        }
        return true;
    }

    public function checkResetMail($target_mail)
    {
        $model = PasswordReset::where('email', $target_mail)->first();
        if ($model) {
            //仮登録された時間が24時間以内か
            if (Carbon::now()->diffInHours($model->created_at) <= 24) {
                return false;
            }
            $model->delete();
            return true;
        }
        return true;
    }

    public function createProvMail($mail, $hash)

    {
        $model = new ProvRegisterMail;
        $model->email = $mail;
        $model->hash = $hash;
        $model->save();

        return $model;
    }

    public function createResetMail($mail, $token)

    {
        $model = new PasswordReset;
        $model->email = $mail;
        $model->token = $token;
        $model->save();

        return $model;
    }

    public function checkPrevMailHash($hash)

    {
        $model = ProvRegisterMail::where('hash', $hash)->first();
        if ($model) {
            //仮登録された時間が24時間以内か
            if (Carbon::now()->diffInHours($model->created_at) <= 24) {
                return $model;
            }
            return false;
        }
        return false;
    }
    public function checkResetPasswordMailHash($hash)

    {
        $model = PasswordReset::where('token', $hash)->first();
        if($model) {
            if (Carbon::now()->diffInHours($model->created_at) <= 24) {
                return $model;
            }
        }
        return false;
    }
    public function getRegisterMail($hash)
    {
        $email = ProvRegisterMail::where('hash', $hash)->value('email');
        return $email;
    }

    public function registerUser($email, $password)
    {
        $user = new User;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();

        return $user;
    }

    public function registerUserDetail($user, $nickname, $display_name)
    {
        $user_detail = new UserDetail;

        $user_detail->user_id = $user->id;
        $user_detail->nickname = $nickname;
        $user_detail->display_name = $display_name;
        $user_detail->sex = 0;
        $user_detail->cover_image = "defaultcover.png";
        $user_detail->icon = "defaulticon.png";
        $user_detail->description = "";
        $user_detail->introduction = "";
        $user_detail->school_name = "";
        $user_detail->undergraduate = "";
        $user_detail->graduate = "";
        $user_detail->address = 1;
        $user_detail->facebook = "";
        $user_detail->twitter = "";
        $user_detail->topics_id = "";
        $user_detail->aspiring_industrie_id = "";
        $user_detail->number_participate = 0;
        $user_detail->number_build = 0;
        $user_detail->wave_point = 0;
        $user_detail->save();

        return $user_detail->nickname;
    }

    public function registerSocialToken($user)
    {
        $social_token = new SocialToken;
        $social_token->user_id = $user->id;
        $social_token->twitter_token = null;
        $social_token->facebook_token = null;
        $social_token->save();
    }

    public function deletePrevMail($email)
    {
        $model = ProvRegisterMail::where('email', $email)->first()->delete();
    }

    public function changePassword($token, $password)
    {
        $email = PasswordReset::where('token', $token)->value('email');
        $user = User::where('email', $email)->first();
        $user->password = bcrypt($password);
        return $user->save();


    }

    public function deleteResetPassword($token)
    {
        return PasswordReset::where('token', $token)->delete();
    }
}

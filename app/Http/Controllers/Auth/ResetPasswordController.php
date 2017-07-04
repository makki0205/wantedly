<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use \App\Http\Requests\Auth\ResetSendEmailRequest;
use \App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\Request;
use Mail;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    use \App\Http\Json\AuthJson;



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $auth = null;
    public function __construct(\App\Service\AuthService $auth)
    {
        $this->auth = $auth;
    }
    public function sendEmail(ResetSendEmailRequest $request)
    {
        $data['email'] = $request->input('email');
        if ($this->auth->checkResetMail($data['email'])) {
            $data['token'] = str_random(40);
            $data['domain'] = $_SERVER["SERVER_NAME"];
            $hoge = Mail::send(['text' => 'mail.resetMailTemp'], $data, function ($message) use ($data) {
                $message->from('no-reply@wave-event.net', 'wave');
                $message->to($data["email"])->subject('【WAVE】パスワードリセットのご案内');
            });
            $this->auth->createResetMail($data['email'], $data['token']);
            return response()->json($this->successSendMail(), 200);
        }
        return response()->json($this->failureSendMail(), 400);
    }
    public function resetPassword(ResetPasswordRequest $request, $token)
    {
        if(!$this->auth->changePassword($token, $request->input('password'))){
            return response()->json($this->failureSendMail(), 400);
        }
        $this->auth->deleteResetPassword($token);
        return response()->json($this->successSendMail(), 200);

    }

}

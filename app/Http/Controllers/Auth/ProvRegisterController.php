<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\ProvMailRequest;
use Mail;

class ProvRegisterController extends Controller
{
    use \App\Http\Json\AuthJson;
    // AuthService登録

    private $auth = null;
    public function __construct(\App\Service\AuthService $auth)
    {
        $this->auth = $auth;
    }

    /**
     * [POST] /prov
     * 仮登録メール送信API
     * @param { string } email 仮登録メールアドレス
     * @return { json } status 成功か失敗か
     */
    public function provMail(ProvMailRequest $request)
    {
        $data['email'] = $request->input('email');
        if ($this->auth->checkMail($data['email'])) {
            $data['hash'] = str_random(40);
            $data['domain'] = $_SERVER["SERVER_NAME"];
            Mail::send(['text' => 'mail.userMailTemp'], $data, function ($message) use ($data) {
                $message->from('no-reply@wave-event.net', 'wave');
                $message->to($data["email"])->subject('【WAVE】仮登録完了メール');
            });
            $this->auth->createProvMail($data['email'], $data['hash']);
            return response()->json($this->successSendMail(), 200);
        }
        return response()->json($this->failureSendMail(), 400);
    }
}

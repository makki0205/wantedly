<?php
namespace App\Http\Json;

trait AuthJson
{
    private function failureSendMail()
    {
        return [
            'code' => 400,
            'errors'=>[
                'email' => ['入力されたメールアドレスには24時間以内にメールを送信しています。']
            ]
        ];
    }

    private function successSendMail()
    {
        return [
            'code' => 200,
        ];
    }

    private function failureRegisterd($msg)
    {
        return [
            'code' => 400,
            'message' => $msg,
        ];
    }

    private function failureLogin($msg)
    {
        return [
            'code' => 400,
            'message' => $msg,
        ];
    }

    private function successLogin($token, $nickname, $icon)
    {
        return [
            'code' => 201,
            'token' => $token,
            'nickname' => $nickname,
            'icon' => $icon,
        ];
    }
}

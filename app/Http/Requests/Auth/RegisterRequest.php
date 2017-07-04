<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    use \App\Http\Json\ValidatorJson;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nickname' => 'required|regex_alpha_num|max:32|isset_nickname', //nicknameに重複していないか確認
            'display_name' => 'required|no_ctrl_chars|max:32',
            'password' => 'required|min:6',

        ];
    }

    public function messages()
    {
        return [
            'nickname.required' => 'ユーザIDが空白です。',
            'nickname.regex_alpha_num' => 'ユーザIDは半角英数字のみで入力してください。',
            'nickname.max' => 'ユーザIDは32文字以内で入力してください。',
            'nickname.isset_nickname' => 'すでに使用されているユーザIDです。',
            'password.required' => 'パスワードが空白です。',
            'password.min' => 'パスワードは6文字以上で入力してください。',
            'display_name.required' => 'プロフィール名が空白です',
            'display_name.no_ctrl_chars' => 'プロフィール名に使用できな文字が含まれています',
            'display_name.max' => 'プロフィール名が長すぎます',
        ];
    }

    public function response(array $errors)
    {
        $headers = [
            'Access-Control-Allow-Origin' =>' *',
        ];

        return response()->json($this->validateMessage($errors), 403, $headers);
    }
}

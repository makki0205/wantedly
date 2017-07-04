<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスが空白です。',
            'email.email' => 'メールアドレスの形式ではありません。',
            'password.required' => 'パスワードが空白です。',
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

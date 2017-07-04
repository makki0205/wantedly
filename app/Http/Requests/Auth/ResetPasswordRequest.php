<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            //
            'password' => 'required|min:6',
            'token' => 'required|exists:password_resets'

        ];
    }
    protected function validationData()
    {
        return array_merge($this->request->all(), [
            'token' => $this->route('token'),
        ]);
    }
    public function messages()
    {
        return [
            'password.required' => 'パスワードが空白です。',
            'password.min' => 'パスワードは6文字以上で入力してください。',
            'token.required' => 'tokenが入力されていません',
            'token.exists' => '不正なエラーです',
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

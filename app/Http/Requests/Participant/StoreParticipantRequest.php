<?php
namespace App\Http\Requests\Participant;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Created by PhpStorm.
 * User: nappannda
 * Date: 2017/02/14
 * Time: 0:32
 */
class StoreParticipantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user();
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
            'id' => "numeric | exists_event",
            'entry_id' => "numeric | exists_entry"
        ];
    }

    protected function validationData()
    {
        return array_merge($this->request->all(), [
            'id' => $this->route('id'),
            'entry_id' => $this->route('entry_id'),
        ]);
    }

    /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id.numeric' => 'A event_id is not numeric',
            'entry_id.numeric'  => 'A entry_id is not numeric',
            'id.exists_event' => 'Event is not exist',
            'entry_id.exists_entry' => 'Entry is not exist'
        ];
    }

    public function response(array $errors)
    {
        $headers = [
            'Access-Control-Allow-Origin' => ' *',
        ];

        return \Response::json($errors, 401, $headers);
    }
}
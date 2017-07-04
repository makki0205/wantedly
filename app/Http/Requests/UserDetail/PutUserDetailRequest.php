<?php

namespace App\Http\Requests\UserDetail;

use Illuminate\Foundation\Http\FormRequest;

class PutUserDetailRequest extends FormRequest
{
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
            "user_id"=>"required|numeric|exists_user_id",
            "user_detail.nickname"=>"required|regex_alpha_num|isset_nickname",
            "user_detail.display_name"=>"required | no_ctrl_chars",
            "user_detail.sex"=>"present | boolean",
            "user_detail.description"=>"present | string",
            "user_detail.introduction"=>"present | string ",
            "user_detail.school_name"=>"present | string",
            "user_detail.undergraduate"=>"present | string",
            "user_detail.graduate"=>"present | string",
            "user_detail.address.id"=>"present | numeric",
            "user_detail.career_history"=>"present | array",
                "user_detail.career_history.*.id"=>"present | numeric | career_history_id ",
                "user_detail.career_history.*.title"=>"present|string",
                "user_detail.career_history.*.Contents"=>"present|string",
                "user_detail.career_history.*.start_time"=>"present|string",

            "user_detail.aspiring_industries"=>"present | array",
                "user_detail.aspiring_industries.*.id"=>"present | numeric | aspiring_industry_id",

            "user_detail.award"=>"present | array",
                "user_detail.award.*.id"=>"present | numeric | award_id",
                "user_detail.award.*.award"=>"present | string",
                "user_detail.award.*.date"=>"present | string",

            "user_detail.topic"=>"present | array",
                "user_detail.topic.*.id"=>"present | numeric | topic_id"
        ];
    }

    public function response(array $errors){
        $headers = [
            'Access-Control-Allow-Origin' =>' *',
        ];

        return \Response::json($errors,404,$headers);
    }

}

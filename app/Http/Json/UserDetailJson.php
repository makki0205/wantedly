<?php
namespace App\Http\Json;

trait UserDetailJson
{
    private function TopicAndAspiringIndustry($topic, $aspiringIndustry)
    {
        return [
            "code" => "200",
            "topic" => $topic,
            "aspiringIndustry" => $aspiringIndustry,
        ];
    }
    private function unauthorized()
    {
        return [
            "code" => "401",
            "errors" => "不正なアクセス"
        ];
    }
}

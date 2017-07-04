<?php
namespace App\Service;

use \App\AspiringIndustry;
use \App\Topic;
use \App\UserDetail;
class UserDetailService
{
    public function getTopicAll(){
        $topic = Topic::get()->toArray();
        return $topic;
    }
    public function getAspiringIndustryAll(){
        $aspiringIndustry = AspiringIndustry::get()->toArray();
        return $aspiringIndustry;
    }
    public function findUserDetailFromNickname($nickname){
        $user_detail_data = UserDetail::where('nickname', $nickname)->first();
        if (!$user_detail_data) {
            return false;
        }
        return $user_detail_data;
    }
}

<?php

namespace App\Libs;

use App\AspiringIndustry;
use App\Event;
use App\Entry;
use App\Topic;
use App\UserDetail;
use App\UserDetailAward;
use App\UserDetailCareerHistory;
use Illuminate\Http\Request;

class Validation
{
    public function existsUserId($attribute, $value, $parameters)
    {
        $flg = false;
        $data = UserDetail::where('user_id', $value)->first();
        if ($data) {
            $flg = true;
        }
        return $flg;
    }

    public function existsEvent($attribute, $value, $parameters)
    {
        $flg = false;
        $data = Event::find($value);
        if ($data) {
            $flg = true;
        }
        return $flg;
    }

    public function existsEntry($attribute, $value, $parameters)
    {
        $flg = false;
        $data = Entry::find($value);
        if ($data) {
            $flg = true;
        }
        return $flg;
    }


    public function existsParticipant($attribute, $value, $parameters, $data)
    {
        $d = $data->getData();
        $entry = Entry::where('id', $d['entry_id'])->first();
        return $entry->participants->where('user_id', $value)->first();
    }

    public function issetNickname($attribute, $value, $parameters, $data)
    {
        $user_id = $data->getData();
        if (isset($user_id['user_id'])) {
            $user_detail = UserDetail::where('user_id', $user_id['user_id'])->first();
            if ($user_detail['nickname'] == $value) {
                return true;
            }
        }
        return !UserDetail::where('nickname', $value)->first();
    }


    public function existsCareerHistory($attribute, $value, $parameters)
    {
        $flg = false;
        $data = UserDetailCareerHistory::where('id', $value)->first();
        if ($data) {
            $flg = true;
        }
        if (!$value) {
            $flg = true;
        }
        // return $flg;
        return $flg;
    }


    public function existsAspiringIndustries($attribute, $value, $parameters)
    {
        $flg = false;
        $data = AspiringIndustry::where('id', $value)->first();
        if ($data) {
            $flg = true;
        }
        return $flg;
    }
    public function existsAward($attribute, $value, $parameters)
    {
        $flg = false;
        $data = UserDetailAward::where('id', $value)->first();
        if ($data) {
            $flg = true;
        }
        if (!$value) {
            $flg = true;
        }
        return $flg;
    }

    public function existsTopic($attribute, $value, $parameters)
    {
        $flg = false;
        $data = Topic::where('id', $value)->first();
        if ($data) {
            $flg = true;
        }
        return $flg;
    }

    public function alphaNum($attribute, $value, $parameters)
    {
        if (preg_match('/^[a-zA-Z0-9]+$/', $value)) {
            return true;
        }
        return false;
    }
    public function defaultValidation($attribute, $value, $parameters)
    {
        // xss対策
        if ($value != htmlspecialchars($value, ENT_QUOTES, 'UTF-8')) {
            return false;
        }
        //nullバイト対策
        if ($value != str_replace("\\0", "", $value)) {
            return false;
        }
        //その他特殊記号対策
        $cntlChars = [
            ';'
        ];
        foreach ($cntlChars as $key) {
            if (strpos($value, $key)) {
                return false;
            }
        }
        return true;
    }
}

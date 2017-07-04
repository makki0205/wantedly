<?php
namespace App\Service;

use App\UserDetail;

class WaveScoreService
{
    private $user_detail = null;

    public function update($user_id){
        $score = 0;
        $this->user_detail = UserDetail::where('user_id', $user_id)->first();
        
        $score = $score + $this->countUserDetail();
        $score = $score + $this->countEvent();

        $this->updateUserDetail($score);
    }
    private function updateUserDetail($score){
        $this->user_detail->wave_point = $score;
        $this->user_detail->save();
    }
    private function countEvent(){
        return $this->user_detail->number_participate * 5 + $this->user_detail->number_build * 15;
    }
    private function countUserDetail(){
        $score = 0;
        if($this->user_detail->description != ""){
            $score += 5;
        }
        if($this->user_detail->introduction != ""){
            $score += 5;
        }
        if($this->user_detail->cover_image != "defaultcover.png"){
            $score += 5;
        }

        if($this->user_detail->icon != "defaulticon.png"){
            $score += 5;
        }
        if($this->user_detail->school_name != ""){
            $score += 5;
        }
        if($this->user_detail->undergraduate != ""){
            $score += 5;

        }
        if($this->user_detail->graduate != ""){
            $score += 5;

        }
        if($this->user_detail->address != 1){
            $score += 5;

        }
        if($this->user_detail->topic_id != ""){
            $score += 5;

        }
        if($this->user_detail->aspiring_industrie_id != "0"){
            $score += 5;

        }
        return $score;
    }

}

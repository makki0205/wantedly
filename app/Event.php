<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'catch_image', 'place', 'day', 'genre', 'tag', 'content'];

    /**
     * イベントに紐付いている主催者情報を取得
     */
    public function organizers()
    {
        return $this->hasMany('App\Organizer');
    }

    /**
     * イベントに紐付いている参加枠情報を取得
     */
    public function entries()
    {
        return $this->hasMany('App\Entry');
    }

    /**
     * イベントに紐付いているタイムスケジュール情報を取得
     */
    public function time_schedules()
    {
        return $this->hasMany('App\TimeSchedule');
    }

}

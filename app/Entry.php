<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = ['event_id', 'event_entry_name', 'event_entry_max_num', 'event_entry_now_num'];
    public $timestamps = false;    // タイムスタンプを無効

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function participants()
    {
        return $this->hasMany('App\Participant');
    }
}

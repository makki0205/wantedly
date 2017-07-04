<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    //

    public $timestamps = false;    // タイムスタンプを無効
    protected $fillable = ['event_id', 'user_id', 'comment', 'priority_ranking'];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}

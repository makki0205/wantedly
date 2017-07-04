<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['event_id', 'user_id', 'entry_id', 'event_evaluate'];

    public function entry()
    {
        return $this->belongsTo('App\Entry');
    }
}

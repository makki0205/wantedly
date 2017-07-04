<?php
/**
 * Created by PhpStorm.
 * User: nappannda
 * Date: 2017/02/18
 * Time: 1:45
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSchedule extends Model
{
    protected $fillable = ['event_id', 'time', 'content'];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
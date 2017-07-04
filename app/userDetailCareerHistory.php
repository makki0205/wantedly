<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetailCareerHistory extends Model
{
    //
    protected $fillable = [
        'title',
        'user_id',
        'Contents',
        'start_time',
        'end_time'
    ];
    public $timestamps = false;    // タイムスタンプを無効

}

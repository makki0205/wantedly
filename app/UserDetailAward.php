<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetailAward extends Model
{
    //
    protected $fillable = ['award','date','user_id'];
    public $timestamps = false;    // タイムスタンプを無効


}

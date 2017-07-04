<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //
    public $timestamps = false;    // タイムスタンプを無効
    protected $fillable = ['genre'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $fillable = ['topic'];
    public $timestamps = false;    // タイムスタンプを無効
    
}

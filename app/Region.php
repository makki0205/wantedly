<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    public $timestamps = false;    // タイムスタンプを無効
    protected $fillable = ['region'];  // Mass Assignment 無効化
}

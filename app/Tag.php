<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = ['tag', 'spell1', 'spell2', 'spell3', 'Score'];  // Mass Assignment 無効化

}

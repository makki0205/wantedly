<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvRegisterMail extends Model
{
    protected $fillable = ['email','hash'];
}

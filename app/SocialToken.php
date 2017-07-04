<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialToken extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'twitter_token', 'facebook_token'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}

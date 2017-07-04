<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    //
    protected $fillable = [
        'user_id',
        'nickname',
        'display_name',
        'sex',
        'cover_image',
        'icon',
        'description',
        'introduction',
        'school_name',
        'undergraduate',
        'graduate',
        'address',
        'facebook',
        'twitter',
        'topics_id',
        'aspiring_industrie_id',
        'number_participate',
        'number_build',
        'wave_point'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function award(){
        return $this->hasMany('App\UserDetailAward','user_id','user_id');
    }
    public function careerHistory(){
        return $this->hasMany('App\UserDetailCareerHistory','user_id','user_id');
    }
}

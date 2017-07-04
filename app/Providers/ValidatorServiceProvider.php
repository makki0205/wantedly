<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('exists_user_id','App\Libs\Validation@existsUserId');
        Validator::extend('career_history_id','App\Libs\Validation@existsCareerHistory');
        Validator::extend('aspiring_industry_id','App\Libs\Validation@existsAspiringIndustries');
        Validator::extend('award_id','App\Libs\Validation@existsAward');
        Validator::extend('topic_id','App\Libs\Validation@existsTopic');
        Validator::extend('isset_nickname','App\Libs\Validation@issetNickname');
        Validator::extend('exists_event', 'App\Libs\Validation@existsEvent');
        Validator::extend('exists_entry', 'App\Libs\Validation@existsEntry');
        Validator::extend('exitst_participant', 'App\Libs\Validation@existsParticipant');
        Validator::extend('no_ctrl_chars', 'App\Libs\Validation@defaultValidation');
        Validator::extend('regex_alpha_num', 'App\Libs\Validation@alphaNum');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

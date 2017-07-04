<?php
/**
 * Created by PhpStorm.
 * User: nappannda
 * Date: 2017/02/15
 * Time: 20:22
 */

namespace App\Service;
use App\Event;

class EventService
{

    public function checkUserDetailColumn($user_detail)
    {
        if ($user_detail->introduction == "" || $user_detail->school_name == "" || $user_detail->undergraduate == "" ||
            $user_detail->graduate == "") {
            return false;
        }
        return true;
    }
    public function getEvent($event_id)
    {
        return Event::find($event_id);
    }

}

<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $table = 'saas_user_activities';

    public $timestamps = false;

    /**
     * Add user activity
     *
     * @param $data
     */
    public static function add_activity($data)
    {
        $current_time = Carbon::now();
        $user_activity = new UserActivity();
        $user_activity->user_id = $data['user_id'];
        $user_activity->user_action = $data['user_action'];
        $user_activity->ip_address = $data['ip_address'];
        $user_activity->created_at = $current_time->toDateTimeString();
        $user_activity->save();
    }
}

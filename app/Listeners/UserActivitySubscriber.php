<?php

namespace App\Listeners;

use App\UserActivity;
use Illuminate\Http\Request;

class UserActivitySubscriber
{
    /**
     * Handle user login events.
     *
     * @param $event
     */
    public function onUserLogin($event)
    {
        $data['ip_address'] = $this->getUserIP();
        $data['user_id'] = $event->user['id'];
        $data['user_action'] = 'Logged In';
        UserActivity::add_activity($data);
    }

    /**
     * Handle user logout events.
     *
     * @param $event
     */
    public function onUserLogout($event)
    {
        $data['ip_address'] = $this->getUserIP();
        $data['user_id'] = $event->user['id'];
        $data['user_action'] = 'Logged Out';
        UserActivity::add_activity($data);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserActivitySubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserActivitySubscriber@onUserLogout'
        );
    }

    /**
     * Return User IP
     *
     * @return string
     */
    private function getUserIP()
    {
        $request = new Request();
        $ip_address = $request->ip();
        if(empty($ip_address))
            $ip_address = $_SERVER['REMOTE_ADDR'];

        return $ip_address;
    }
}


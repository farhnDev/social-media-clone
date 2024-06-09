<?php

namespace App\Listeners;

use App\Events\UserCreating;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleUserCreating
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreating  $event
     * @return void
     */
    public function handle(UserCreating $event)
    {
        $user = $event->user;
        $username = urlencode($user->name);
        $defaultProfileUrl = "https://avatar.iran.liara.run/username?username=$username";
        $user->profile_photo_url = $defaultProfileUrl;
        $user->save();

        
    }
}

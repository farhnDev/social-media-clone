<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCreating
{
    use Dispatchable, SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        $username = urlencode($this->user->name);
        $defaultProfileUrl = "https://avatar.iran.liara.run/username?username=$username";
        $this->user->profile_photo_url = $defaultProfileUrl;
        $this->user->save(); // Simpan perubahan ke dalam database
    }
    
}

<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\UserSignedUp;

use App\Jobs\SendWelcomeEmail;

use Illuminate\Support\Facades\Log;

class SetUpNewUser
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
     * @param  object  $event
     * @return void
     */
    public function handle(UserSignedUp $event)
    {
        // Send validation e-mail
        SendWelcomeEmail::dispatch($event->user);

        // Add user invite code
        $event->user->invite_code = str_random(10);
        $event->user->save();

        // Add user settings
        collect(['TEXTNOTIFICATIONS', 'EMAILNOTIFICATIONS', 'WEBCAL'])->each(

            function($key) use ($event) {
                
                $setting = $event->user->setting($key);

                $setting->value = true;
                $setting->save();

                return true;
            }
        );

        // Create user profile

        $profile = new \App\Profile;
        $event->user->profile()->save($profile);
    }
}

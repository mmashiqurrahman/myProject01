<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('ch.{fromuser}.{touser}', function ($user, $fromuser, $touser) {
        if($user->id == $fromuser || $user->id == $touser) {
                Log::info('User: '.$user->id.' tried to access Channel: ch.'.$fromuser.'.'.$touser);
                return true;
        } else {
                return false;
        }
});

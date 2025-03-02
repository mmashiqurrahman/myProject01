<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\BroadcastEvent;
use App\Models\Channel;

class BroadcastController extends Controller
{
    public function centralMessages() {
        return view('index');
    }

    public function chat(Request $request) {
        $ch1 = Channel::where('name', 'ch.'.$request->fromuser.'.'.$request->touser)->first();
        $ch2 = Channel::where('name', 'ch.'.$request->touser.'.'.$request->fromuser)->first();
        $channelName = '';

        if($ch1) {
            $channelName = $ch1->name;
        } elseif($ch2) {
            $channelName = $ch2->name;
        } else {
            try {
                $ch3 = Channel::create([
                    'name' => 'ch.'.$request->fromuser.'.'.$request->touser,
                ]);
                $channelName = $ch3->name;
            } catch(\Exception $e) {
                dd($e);
            } 
        }

        return view('index', ['channelname' => $channelName]);
    }

    public function broadcast(Request $request ) {
        broadcast(new BroadcastEvent($request->message, $request->user_name, $request->channelname))->toOthers();
        return view('broadcast', ['message' => $request->message, 'user_name' => $request->user_name]);
    }

    public function receive(Request $request ) {
        return view('receive', ['message' => $request->message, 'user_name' => $request->user_name]);
    }
}
